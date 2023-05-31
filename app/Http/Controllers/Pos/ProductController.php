<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth As Auth;
use Intervention\Image\Facades\Image As Image;

class ProductController extends Controller
{
    public function Product() {
        $products = Product::latest()->orderby('name','ASC')->paginate(20);
        return view('admin.product.product',compact('products'));
    }

    public function Add() {
        $suppliers = Supplier::all();
        $categories = Category::all();
        $units = Unit::all();
        return view('admin.product.add',compact('suppliers','categories','units'));
    }

    public function Store(Request $request){

        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required'
        ],[
            'name.required' => 'Name is required',
            'category_id.required' => 'Category is required',
            'supplier_id.required' => 'Supplier_id is required'
        ]);

        $save_url="";
       
        if($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'. $image->getClientOriginalExtension();
            Image::make($image)->resize(600, null, function ($constraint) {$constraint->aspectRatio();})->save('upload/product/'.$name_gen);
            $save_url = 'upload/product/'.$name_gen;
        } 

        Product::insert([
            'name' => $request->name,
            'sub_name' => $request->sub_name,
            'code' => $request->code,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'image' => $save_url,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Product added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('products')->with($notification);
    }

    public function Edit($id){
        $product = Product::findOrFail($id);
        $suppliers = Supplier::all();
        $categories = Category::all();
        $units = Unit::all();
        return view('admin.product.edit',compact('product','suppliers','categories','units'));
    }
 
    public function Update(Request $request){
        
        $id = $request->id;
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required'
        ],[
            'name.required' => 'Name is required',
            'category_id.required' => 'Category is required',
            'supplier_id.required' => 'Supplier_id is required'
        ]);

        $save_url=$product->image;
        //$save_url_home=$product->image_home;

        if($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'. $image->getClientOriginalExtension();
            Image::make($image)->resize(600, null, function ($constraint) {$constraint->aspectRatio();})->save('upload/product/'.$name_gen);
            $save_url = 'upload/product/'.$name_gen;
        } 

        /*
        if($request->file('image_home')) {
            $image = $request->file('image_home');
            $name_gen_home = hexdec(uniqid()).'_home.'. $image->getClientOriginalExtension();
            Image::make($image)->resize(1020,519)->save('upload/product/'.$name_gen_home);
            $save_url_home = 'upload/product/'.$name_gen_home;
        } 
        */

        Product::findOrFail($id)->update([
           
            'name' => $request->name,
            'sub_name' => $request->sub_name,
            'code' => $request->code,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'image' => $save_url,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Product updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function Delete ($id){
        $product = Product::findOrFail($id);
        /*
        $img = $product->image;
        if (file_exists($img)){
            @unlink($img);
        }
        $img_home = $product->image_home;
        if (file_exists($img_home)){
            @unlink($img_home);
        }
        */
        Product::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Product deleted',
            'alert-type' => 'error'
        );
        session()->flash('message','Product deleted');
        return redirect()->route('products')->with($notification);
    }

    public function Details ($id){
        $product = Product::findOrFail($id);
        return view('frontend.product_details',compact('product'));
    }
}
