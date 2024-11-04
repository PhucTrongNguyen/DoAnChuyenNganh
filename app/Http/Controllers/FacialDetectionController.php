<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacialDetectionController extends Controller
{
    public function detectFaces(Request $request) {
        
        ini_set('max_execution_time', 3600);
        //dd($request->input('image_path'));
        $imagePath = $request->input('image_path');
        if ($imagePath) {
            $pythonScript = public_path('python/tryon.py');
            $command = escapeshellcmd("python \"$pythonScript\" \"$imagePath\" > /dev/null 2>&1 &");
            shell_exec($command);

            return response()->noContent();
        }
        session()->flash('error', 'No image uploaded');
        return redirect()->back();

    }
}
