<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BakeryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id = Auth::id();
        $row = DB::table('user_ledger')->where('user_id', $id)->first();
        return view('bakery', ["flour" => $row->flour, "bread" => $row->bread, "balance" => $row->balance]);
    }

    public function bake()
    {
        $id = Auth::id();
        $row = DB::table('user_ledger')->where('user_id', $id)->first();
        if($row->flour > 1) {
            $newFlour = $row->flour - 2;
            $newBread = $row->bread + 1;
            DB::table('user_ledger')->where('user_id', $id)->update(['bread' => $newBread]);
            DB::table('user_ledger')->where('user_id', $id)->update(['flour' => $newFlour]);
        }
        return back();
    }

    public function sell()
    {
        $id = Auth::id();
        $row = DB::table('user_ledger')->where('user_id', $id)->first();
        if($row->bread > 0) {
            $newBalance = $row->balance + 1;
            $newBread = $row->bread - 1;
            DB::table('user_ledger')->where('user_id', $id)->update(['bread' => $newBread]);
            DB::table('user_ledger')->where('user_id', $id)->update(['balance' => $newBalance]);
        }
        return back();
    }
}
