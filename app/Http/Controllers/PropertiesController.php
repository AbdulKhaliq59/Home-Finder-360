<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    //
    public function showPropertiesList()
    {
        return view("pages.properties");
    }
    public function showSingleProperty()
    {
        return view("pages.single-property");
    }
}
