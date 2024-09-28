<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Tìm kiếm sản phẩm trong cơ sở dữ liệu
        $products = Product::where('tensp', 'LIKE', '%' . $query . '%')->get();

        // Trả về kết quả dưới dạng JSON
        return response()->json($products);
    }

}
