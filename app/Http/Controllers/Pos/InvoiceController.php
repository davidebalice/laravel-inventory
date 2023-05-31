<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Unit;
use App\Models\Purchase;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth As Auth;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function Invoices() {
        $invoices = Invoice::latest()->orderby('date','DESC')->orderby('id','DESC')->where('status','1')->paginate(20);
        return view('admin.invoice.invoices',compact('invoices'));
    }

    public function Add() {
        $categories = Category::all();
        $customers = Customer::orderBy('surname','asc')->get();
        $invoice = Invoice::orderBy('id','desc')->first()->invoice_no ?? null;
        if($invoice == null) {
            $invoice_no = 1;
        } else {
            $invoice_no = $invoice+1;
        }
        $date = date('Y-m-d');
        return view('admin.invoice.add',compact('invoice_no','categories','date','customers'));
    }

    public function Store(Request $request) {
        if($request->category_id == null){
            $notification = array(
                'message' => 'Select category',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } 
        else {
            if($request->paid_amount > $request->estimated_amount){
                $notification = array(
                    'message' => 'Paid amount is maximum of total price',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
            else {

                $invoice = new Invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('Y-m-d',strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status = '0';
                $invoice->created_by = Auth::user()->id;
                DB::transaction(function () use($request,$invoice){
                    if($invoice->save()) {
                        $count_category = count($request->category_id);
                        for ($i=0; $i < $count_category; $i++) {
                            $invoice_detail = new InvoiceDetail();
                            //$invoice_detail->date = date('Y-m-d',strtotime($request->date));
                            $invoice_detail->invoice_id = $invoice->id;
                            $invoice_detail->category_id = $request->category_id[$i];
                            $invoice_detail->product_id = $request->product_id[$i];
                            $invoice_detail->selling_qty = $request->selling_qty[$i];
                            $invoice_detail->selling_price = $request->selling_price[$i];
                            $invoice_detail->unit_price = $request->unit_price[$i];
                            $invoice_detail->status = '0';
                            $invoice_detail->save();
                        }
                    }
                });

                if($request->customer_id == '0') {
                    $customer = new Customer();
                    $customer->name = $request->name;
                    $customer->surname = $request->surname;
                    $customer->mobile_no = $request->mobile_no;
                    $customer->email = $request->email;
                    $customer->save();
                    $customer_id = $customer->id;
                }
                else {
                    $customer_id = $request->customer_id;
                }

                $payment = new Payment();
                $payment_details = new PaymentDetail();

                $payment->invoice_id = $invoice->id;
                $payment->customer_id = $customer_id;
                $payment->paid_status = $request->paid_status;
                $payment->discount_amount = $request->discount_amount;
                $payment->total_amount = $request->estimated_amount;

                if($request->paid_status == 'full_paid') {
                    $payment->paid_amount = $request->estimated_amount;
                    $payment->due_amount = 0;
                    $payment_details->current_paid_amount = $request->estimated_amount;
                }
                elseif($request->paid_status == 'full_due') {
                    $payment->paid_amount = 0;
                    $payment->due_amount = $request->estimated_amount;
                    $payment_details->current_paid_amount = 0;
                }
                elseif($request->paid_status == 'partial_paid') {
                    $payment->paid_amount = $request->paid_amount;
                    $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                    $payment_details->current_paid_amount =  $request->paid_amount;
                }
                $payment->save();

                $payment_details->invoice_id = $invoice->id;
                $payment_details->date = date('Y-m-d',strtotime($request->date));
                $payment_details->save();
            }
            $notification = array(
                'message' => 'Invoice inserted',
                'alert-type' => 'success'
            );
            return redirect()->route('invoice.pending')->with($notification);
        }
    }

    public function Pending() {
        $invoices = Invoice::latest()->orderby('date','DESC')->orderby('id','DESC')->where('status','0')->paginate(20);
        return view('admin.invoice.pending',compact('invoices'));
    }
    
    public function Delete ($id){
        $invoice = Invoice::findOrFail($id);
        Invoice::findOrFail($id)->delete();
        InvoiceDetail::where('invoice_id',$invoice->id)->delete();
        Payment::where('invoice_id',$invoice->id)->delete();
        PaymentDetail::where('invoice_id',$invoice->id)->delete();

        $notification = array(
            'message' => 'Invoice deleted',
            'alert-type' => 'error'
        );

        session()->flash('message','Invoice deleted');
        return redirect()->back()->with($notification);
    }

    public function Approve($id) {
        $invoice = Invoice::with('invoice_details')->findOrFail($id);
        return view('admin.invoice.approve',compact('invoice'));
    }

    public function ApproveStore(Request $request, $id) {
        foreach($request->selling_qty as $key => $val) {
            $invoice_details = InvoiceDetail::where('id',$key)->first();
            $invoice_details->status = '1';
            $invoice_details->save();
            $product = Product::where('id',$invoice_details->product_id)->first();
            if($product->quantity < $request->selling_qty[$key]) {
                $notification = array(
                'message' => 'Sorry you approve Maximum Value', 
                'alert-type' => 'error'
                );
                return redirect()->back()->with($notification); 
            }
        } 

        $invoice = Invoice::findOrFail($id);
        $invoice->updated_by = Auth::user()->id;
        $invoice->status = '1';
        
        DB::transaction(function() use($request,$invoice,$id){
            foreach($request->selling_qty as $key => $val){
             $invoice_details = InvoiceDetail::where('id',$key)->first();
             $product = Product::where('id',$invoice_details->product_id)->first();
             $product->quantity = ((float)$product->quantity) - ((float)$request->selling_qty[$key]);
             $product->save();
            } // end foreach
            $invoice->save();
        });

        $notification = array(
            'message' => 'Invoice Approve Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('invoice.pending')->with($notification);  
    }

    public function Print() {
        $invoices = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
        return view('admin.invoice.print',compact('invoices'));
    } 
 
 
    public function Pdf($id){
         $invoice = Invoice::with('invoice_details')->findOrFail($id);
         return view('admin.invoice.pdf',compact('invoice'));
    }

    public function DailyReport(){
        return view('admin.invoice.daily_report');
    }

    public function DailyInvoicePdf(Request $request){
        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $allData = Invoice::whereBetween('date',[$sdate,$edate])->where('status','1')->get();
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        return view('admin.invoice.daily_report_pdf',compact('allData','start_date','end_date'));
    }
}