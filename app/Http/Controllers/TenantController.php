<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{

    public function getTenants()
    {
        $tenants = User::where('role', 'tenant')->get();
        return view('pages.dashboard.tenant', compact('tenants'));
    }
}