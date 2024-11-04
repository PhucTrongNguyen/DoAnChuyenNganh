<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {
        // Lưu ngôn ngữ vào session
        $locale = $request->language;
        session(['locale' => $locale]);

        // Quay trở lại trang trước đó
        return redirect()->back();
    }
}
