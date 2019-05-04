<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function showAdminPanel()
    {
        return view('auth.admin.panel');
    }
}
