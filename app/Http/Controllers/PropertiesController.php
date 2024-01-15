<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\House;

class PropertiesController extends Controller
{
    //
    public function showPropertiesList()
    {
        return view("pages.properties");
    }

    public function showSingleProperty($id)
    {
        $house = House::findOrFail($id);

        return view("pages.single-property", compact('house'));
    }
}
