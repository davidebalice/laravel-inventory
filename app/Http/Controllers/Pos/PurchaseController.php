<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Purchase;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth As Auth;

class PurchaseController extends Controller
{
    public function Purchases() {
        $purchases = Purchase::latest()->orderby('date','DESC')->paginate(20);
        return view('admin.purchase.purchase',compact('purchases'));
    }

    public function Add() {
        $suppliers = Supplier::all();
        $categories = Category::all();
        $units = Unit::all();
        return view('admin.purchase.add',compact('suppliers','categories','units'));
    }

    public function Store(Request $request){
        /*
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required'
        ],[
            'name.required' => 'Name is required',
            'category_id.required' => 'Category is required',
            'supplier_id.required' => 'Supplier_id is required'
        ]);
        */

        if($request->category_id == null){
            $notification = array(
                'message' => 'Category not selected',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        else{
            $count_category = count($request->category_id);
            for($i=0;$i < $count_category; $i++){
                $purchase = new Purchase();
                $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
                $purchase->product_id = $request->product_id[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->description = $request->description[$i];
                $purchase->created_by = Auth::user()->id;
                $purchase->status = 0;
                $purchase->save();
            }
        }

        /*
        Purchase::insert([
            'name' => $request->name,
            'sub_name' => $request->sub_name,
            'code' => $request->code,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);
        */

        $notification = array(
            'message' => 'Purchase saved',
            'alert-type' => 'success'
        );

        return redirect()->route('purchases')->with($notification);
    }

    public function Edit($id){
        $purchase = Purchase::findOrFail($id);
        $suppliers = Supplier::all();
        $categories = Category::all();
       
        return view('admin.purchase.edit',compact('purchase','suppliers','categories','units'));
    }
 
    public function Update(Request $request){
        
        $id = $request->id;
        $purchase = Purchase::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required'
        ],[
            'name.required' => 'Name is required',
            'category_id.required' => 'Category is required',
            'supplier_id.required' => 'Supplier_id is required'
        ]);

        Purchase::findOrFail($id)->update([
           
            'name' => $request->name,
            'sub_name' => $request->sub_name,
            'code' => $request->code,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Purchase updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function Delete ($id){
        $purchase = Purchase::findOrFail($id);
       
        Purchase::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Purchase deleted',
            'alert-type' => 'error'
        );
        session()->flash('message','Purchase deleted');
        return redirect()->route('purchases')->with($notification);
    }

    public function Details ($id){
        $purchase = Purchase::findOrFail($id);
        return view('frontend.purchase_details',compact('purchase'));
    }

    public function Pending() {
        $purchases = Purchase::latest()->orderby('date','DESC')->where('status','0')->paginate(20);
        return view('admin.purchase.pending',compact('purchases'));
    }

    public function Approve ($id){
        $purchase = Purchase::findOrFail($id);
        $product = Product::where('id',$purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->quantity));
        $product->quantity = $purchase_qty;

        if($product->save()){
            Purchase::findOrFail($id)->update([
                'status' => 1,
                'updated_at' => Carbon::now()
            ]);
        }


        $notification = array(
            'message' => 'Purchase approved successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('purchase.pending')->with($notification);
    }

    public function DailyPurchaseReport(){
        return view('admin.purchase.daily_purchase_report');
    }

    public function DailyPurchasePdf(Request $request){
        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $allData = Purchase::whereBetween('date',[$sdate,$edate])->where('status','1')->get();

        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        return view('admin.pdf.daily_purchase_report_pdf',compact('allData','start_date','end_date'));
    }
}
