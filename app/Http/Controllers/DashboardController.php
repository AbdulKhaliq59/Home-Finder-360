<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    function index(Request $request)
    {
        $selectedNavItem = $request->get("navItem");
        return view("pages.dashboard.index", compact("selectedNavItem"));
    }

}