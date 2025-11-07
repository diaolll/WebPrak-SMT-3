<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jenishewan;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.Administrator.Dashboard_admin');
    }
}
