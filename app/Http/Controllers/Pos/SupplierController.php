<?php
namespace App\Http\Controllers\Pos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Intervention\Image\Facades\Image As Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth As Auth;

class SupplierController extends Controller
{
    public function Supplier() {
        $suppliers = Supplier::latest()->orderby('surname','ASC')->paginate(15);
        return view('admin.supplier.supplier',compact('suppliers'));
    }

    public function Add() {
        return view('admin.supplier.add');
    }

    public function Store(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ],[
            'name.required' => 'Name is required',
            'email.required' => 'Title is required'
        ]);

        Supplier::insert([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Supplier added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('suppliers')->with($notification);
    }

    public function Edit($id){
        $supplier = Supplier::findOrFail($id);
        return view('admin.supplier.edit',compact('supplier'));
    }
 
    public function Update(Request $request){
        
        $id = $request->id;
        $supplier = Supplier::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ],[
            'name.required' => 'Name is required',
            'email.required' => 'Email is required'
        ]);

        Supplier::findOrFail($id)->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'address' => $request->address,
            'email' => $request->email,
            'updated_by' => Auth::user()->id,
            'mobile_no' => $request->mobile_no,
            'updated_at' => Carbon::now()
        
        ]);

        $notification = array(
            'message' => 'Supplier updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function Delete ($id){
        $supplier = Supplier::findOrFail($id);
        /*
        $img = $supplier->image;
        if (file_exists($img)){
            @unlink($img);
        }
        $img_home = $supplier->image_home;
        if (file_exists($img_home)){
            @unlink($img_home);
        }
        */
        Supplier::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Supplier deleted',
            'alert-type' => 'error'
        );
        session()->flash('message','Supplier deleted');
        return redirect()->route('suppliers')->with($notification);
    }

    public function Details ($id){
        $supplier = Supplier::findOrFail($id);
        return view('frontend.supplier_details',compact('supplier'));
    }
    
}
