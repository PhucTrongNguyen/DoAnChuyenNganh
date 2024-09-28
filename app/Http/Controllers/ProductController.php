<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        // Sử dụng cột `name` để tìm kiếm
        $products = Product::where('name', 'LIKE', '%' . $keyword . '%')
            ->whereNull('deleted_at') // Nếu bạn sử dụng soft deletes
            ->get();

        return view('products.search_results', compact('products')); // Gọi view tìm kiếm
    }




}
