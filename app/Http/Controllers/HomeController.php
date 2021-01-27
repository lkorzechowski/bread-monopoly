<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function deleteUser(){
        $id = Auth::id();
        Auth::logout();
        DB::table('users')->where('id', '=', $id)->delete();
        DB::table('user_ledger')->where('user_id', '=', $id)->delete();
        DB::table('store')->where('user_id', '=', $id)->delete();
        DB::table('field')->where('user_id', '=', $id)->delete();
        return Redirect::route('index');
    }

    public function renameUser(){
        $id = Auth::id();
    }
}
