<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\User;

class LandlordController extends Controller
{
    //
    public function getLandlords()
    {
        $landlords = User::where('role', 'landlord')->get();
        return view('pages.dashboard.landlord', compact('landlords'));
    }
}
