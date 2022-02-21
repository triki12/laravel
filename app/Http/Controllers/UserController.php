<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $usertype=Auth::user()->user_type;
        return response()->json($usertype);
    }
}
