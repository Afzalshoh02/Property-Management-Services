<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin_dashboard(Request $request)
    {
        return view('admin.dashboard.index');
    }
    public function user_dashboard(Request $request)
    {
        return view('user.dashboard.index');
    }
    public function vendor_dashboard(Request $request)
    {
        return view('vendor.dashboard.index');
    }
}
