<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
       return view('register');
    }

    public function getUserById(Request $request)
    {

    }
}
