<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id = Auth::id();
        $row = DB::table('user_ledger')->where('user_id', $id)->first();
        return view('mill', ["flour" => $row->flour, "grain" => $row->grain]);
    }

    public function spin()
    {
        $id = Auth::id();
        $row = DB::table('user_ledger')->where('user_id', $id)->first();
        if($row->grain > 1) {
            $newGrain = $row->grain - 2;
            $newFlour = $row->flour + 1;
            DB::table('user_ledger')->where('user_id', $id)->update(['grain' => $newGrain]);
            DB::table('user_ledger')->where('user_id', $id)->update(['flour' => $newFlour]);
        }
        return back();
    }

}
