<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('store');
    }

    public function purchaseFields()
    {
        $id = Auth::id();
        $row = DB::table('user_ledger')->where('user_id', $id)->first();
        if($row->balance > 49){
            DB::table('field')->insert([
                'user_id' => $row->id
            ]);
            $newBalance = $row->balance - 50;
            DB::table('user_ledger')->where('user_id', $id)->update(['balance' => $newBalance]);
        }
        return back();
    }
}
