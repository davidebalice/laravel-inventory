<?php

namespace App\Http\Controllers\Pos;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth As Auth;

class CategoryController extends Controller
{
    public function Category() {
        $categories = Category::latest()->orderby('name','ASC')->paginate(15);
        return view('admin.category.category',compact('categories'));
    }

    public function Add() {
        return view('admin.category.add');
    }

    public function Store(Request $request){

        $request->validate([
            'name' => 'required'
        ],[
            'name.required' => 'Name is required'
        ]);

        Category::insert([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Category added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('categories')->with($notification);
    }

    public function Edit($id){
        $category = Category::findOrFail($id);
        return view('admin.category.edit',compact('category'));
    }
 
    public function Update(Request $request){
        
        $id = $request->id;
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required'
        ],[
            'name.required' => 'Name is required'
        ]);

       
        Category::findOrFail($id)->update([
            'name' => $request->name,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()
        
        ]);

        $notification = array(
            'message' => 'Category updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function Delete ($id){
        $category = Category::findOrFail($id);
       
        Category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category deleted',
            'alert-type' => 'error'
        );
        session()->flash('message','Category deleted');
        return redirect()->route('categories')->with($notification);
    }

    public function Details ($id){
        $category = Category::findOrFail($id);
        return view('frontend.category_details',compact('category'));
    }

}
