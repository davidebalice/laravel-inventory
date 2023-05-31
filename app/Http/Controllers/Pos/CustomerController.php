<?php
namespace App\Http\Controllers\Pos;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image As Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth As Auth;
use App\Models\Payment;
use App\Models\PaymentDetail;

class CustomerController extends Controller
{
    public function Customer() {
        $customers = Customer::latest()->orderby('name','ASC')->paginate(15);
        return view('admin.customer.customer',compact('customers'));
    }

    public function Add() {
        return view('admin.customer.add');
    }

    public function Store(Request $request){

        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required'
        ],[
            'name.required' => 'Name is required',
            'surname.required' => 'Surname is required',
            'email.required' => 'Title is required'
        ]);

        $save_url="";
       
        if($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'. $image->getClientOriginalExtension();
            Image::make($image)->resize(600, null, function ($constraint) {$constraint->aspectRatio();})->save('upload/customer/'.$name_gen);
            $save_url = 'upload/customer/'.$name_gen;
        } 

        Customer::insert([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'image' => $save_url,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Customer added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('customers')->with($notification);
    }

    public function Edit($id){
        $customer = Customer::findOrFail($id);
        return view('admin.customer.edit',compact('customer'));
    }
 
    public function Update(Request $request){
        
        $id = $request->id;
        $customer = Customer::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required'
        ],[
            'name.required' => 'Name is required',
            'surname.required' => 'Surname is required',
            'email.required' => 'Email is required'
        ]);

        
        $save_url=$customer->image;
        //$save_url_home=$customer->image_home;

        if($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'. $image->getClientOriginalExtension();
            Image::make($image)->resize(600, null, function ($constraint) {$constraint->aspectRatio();})->save('upload/customer/'.$name_gen);
            $save_url = 'upload/customer/'.$name_gen;
        } 

        /*
        if($request->file('image_home')) {
            $image = $request->file('image_home');
            $name_gen_home = hexdec(uniqid()).'_home.'. $image->getClientOriginalExtension();
            Image::make($image)->resize(1020,519)->save('upload/customer/'.$name_gen_home);
            $save_url_home = 'upload/customer/'.$name_gen_home;
        } 
        */

        Customer::findOrFail($id)->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'address' => $request->address,
            'email' => $request->email,
            'updated_by' => Auth::user()->id,
            'mobile_no' => $request->mobile_no,
            'image' => $save_url,
            'updated_at' => Carbon::now()
        
        ]);

        $notification = array(
            'message' => 'Customer updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function Delete ($id){
        $customer = Customer::findOrFail($id);
        /*
        $img = $customer->image;
        if (file_exists($img)){
            @unlink($img);
        }
        $img_home = $customer->image_home;
        if (file_exists($img_home)){
            @unlink($img_home);
        }
        */
        Customer::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Customer deleted',
            'alert-type' => 'error'
        );
        session()->flash('message','Customer deleted');
        return redirect()->route('customers')->with($notification);
    }

    public function Details ($id){
        $customer = Customer::findOrFail($id);
        return view('frontend.customer_details',compact('customer'));
    }

    public function CreditCustomer(){
        $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('admin.customer.customer_credit',compact('allData'));
    }

    public function CreditCustomerPrintPdf(){
        $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('admin.pdf.customer_credit_pdf',compact('allData'));
    }

    public function CustomerEditInvoice($invoice_id){
        $payment = Payment::where('invoice_id',$invoice_id)->first();
        return view('admin.customer.edit_customer_invoice',compact('payment'));
    }

    public function CustomerUpdateInvoice(Request $request,$invoice_id){
        if ($request->new_paid_amount < $request->paid_amount) {

            $notification = array(
            'message' => 'Sorry You Paid Maximum Value', 
            'alert-type' => 'error'
            );
            return redirect()->back()->with($notification); 
            } else {
                $payment = Payment::where('invoice_id',$invoice_id)->first();
                $payment_details = new PaymentDetail();
                $payment->paid_status = $request->paid_status;
    
                if ($request->paid_status == 'full_paid') {
                     $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->new_paid_amount;
                     $payment->due_amount = '0';
                     $payment_details->current_paid_amount = $request->new_paid_amount;
    
                } elseif ($request->paid_status == 'partial_paid') {
                    $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->paid_amount;
                    $payment->due_amount = Payment::where('invoice_id',$invoice_id)->first()['due_amount']-$request->paid_amount;
                    $payment_details->current_paid_amount = $request->paid_amount;
    
                }
    
                $payment->save();
                $payment_details->invoice_id = $invoice_id;
                $payment_details->date = date('Y-m-d',strtotime($request->date));
                $payment_details->updated_by = Auth::user()->id;
                $payment_details->save();
    
                  $notification = array(
                'message' => 'Invoice Update Successfully', 
                'alert-type' => 'success'
            );
            return redirect()->route('credit.customer')->with($notification); 
        }
    }

    public function CustomerInvoiceDetails($invoice_id){
        $payment = Payment::where('invoice_id',$invoice_id)->first();
        return view('admin.pdf.invoice_details_pdf',compact('payment'));
    }

    public function PaidCustomer(){
        $allData = Payment::where('paid_status','!=','full_due')->get();
        return view('admin.customer.customer_paid',compact('allData'));
    }

    public function PaidCustomerPrintPdf(){
        $allData = Payment::where('paid_status','!=','full_due')->get();
        return view('admin.pdf.customer_paid_pdf',compact('allData'));
    }

    public function CustomerWiseReport(){
        $customers = Customer::all();
        return view('admin.customer.customer_wise_report',compact('customers'));
    }

    public function CustomerWiseCreditReport(Request $request){
        $allData = Payment::where('customer_id',$request->customer_id)->whereIn('paid_status',['full_due','partial_paid'])->get();
       return view('admin.pdf.customer_wise_credit_pdf',compact('allData'));
   }

   public function CustomerWisePaidReport(Request $request){
        $allData = Payment::where('customer_id',$request->customer_id)->where('paid_status','!=','full_due')->get();
        return view('admin.pdf.customer_wise_paid_pdf',compact('allData'));
    }
}
