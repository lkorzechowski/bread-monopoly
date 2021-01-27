<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ScoreboardController extends Controller
{
    public function index()
    {
        $rows = DB::table('user_ledger')->orderByRaw('balance')->get();
        foreach($rows as $row){
            $found = DB::table('users')->where('id', $row->user_id)->first();
            $row->name = $found->name;
        }
        return view('scoreboard', ['rows'=>$rows]);
    }
}
