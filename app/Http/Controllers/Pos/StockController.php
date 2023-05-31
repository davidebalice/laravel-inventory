<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use Auth;
use Illuminate\Support\Carbon;
 
class StockController extends Controller
{
    public function StockReport(){
        $allData = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        return view('admin.stock.stock_report',compact('allData'));
    }

    public function StockReportPdf(){
        $allData = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        return view('admin.pdf.stock_report_pdf',compact('allData'));
    }

    public function StockSupplierWise(){
        $supppliers = Supplier::all();
        $category = Category::all();
        return view('admin.stock.supplier_product_wise_report',compact('supppliers','category'));
    }

    public function SupplierWisePdf(Request $request){
        $allData = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->where('supplier_id',$request->supplier_id)->get();
        return view('admin.pdf.supplier_wise_report_pdf',compact('allData'));
    }

    public function ProductWisePdf(Request $request){
        $product = Product::where('category_id',$request->category_id)->where('id',$request->product_id)->first();
        return view('admin.pdf.product_wise_report_pdf',compact('product'));
    }
}
 