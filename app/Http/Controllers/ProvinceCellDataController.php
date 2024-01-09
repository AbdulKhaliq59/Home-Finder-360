<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProvinceCellDataController extends Controller
{
    //
    public function getProvinceCellData()
    {
        $filePath = public_path('provinces_cells.json');

        if (File::exists($filePath)) {
            $contents = File::get($filePath);

            // Process $contents as needed

            return response()->json([$contents]);
        } else {
            return response()->json(['error' => 'File not found']);
        }
    }
}
