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

class DefaultController extends Controller
{
    public function GetCategory(Request $request) {
        $category=Product::with(['category'])->select('category_id')->where('supplier_id',$request->supplier_id)
        ->groupBy('category_id')->get();
        return response()->json($category);
    }

    public function GetProduct(Request $request) {
        $product=Product::where('category_id',$request->category_id)->get();
        return response()->json($product);
    }

    public function GetProductStock(Request $request) {
        $product=Product::where('id',$request->product_id)->first()->quantity;
        return response()->json($product);
    }
}
