<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FarmController extends Controller
{
    public $tiles = array();

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id = Auth::id();
        $rows = DB::table('field')->where('user_id', $id)->get();
        $count = 0;
        foreach($rows as $row) {
            $goal = $count + 5;
            for (; $count < $goal; $count++) {
                if($count == 0) $count++;
                $mod = $count%4;
                if($mod == 0) $mod = 1;
                $tile = 'tile' . $mod;
                if (mt_rand(1, 3) == 2) {
                    if ($row->$tile === 'empty') {
                        DB::table('field')->where('user_id', $id)->where('id', $row->id)->update([$tile => 'green']);
                    }
                    if ($row->$tile === 'green') {
                        DB::table('field')->where('user_id', $id)->where('id', $row->id)->update([$tile => 'yellow']);
                    }
                }
            }
        }
        $goal = 1;
        $fields = array();
        array_push($fields, 'null');
        foreach($rows as $row) {
            array_push($fields, $row->tile1, $row->tile2, $row->tile3, $row->tile4);
            $goal = $goal + 4;
        }
        unset($fields[0]);
        $row = DB::table('user_ledger')->where('user_id', $id)->first();
        return view('farm', [ "fields" => $fields, "tiles" => $this->tiles, "grain" => $row->grain]);
    }

    public function harvest($tile)
    {
        $id = Auth::id();
        $row = DB::table('user_ledger')->where('user_id', $id)->first();
        $updatedGrain = $row->grain + 1;
        DB::table('user_ledger')->where('user_id', $id)->update(['grain' => $updatedGrain]);
        if($tile < 5) {
            $string = 'tile'.$tile;
            $field = DB::table('field')->where('user_id', $id)->first();
            DB::table('field')->where('user_id', $id)->where('id', $field->id)->update([$string => 'empty']);
        } else {
            $skip = 0;
            while($tile > 4){
                $tile = $tile - 4;
                $skip++;
            }
            $string = 'tile'.$tile;
            $field = DB::table('field')->where('user_id', $id)->skip($skip)->first();
            DB::table('field')->where('user_id', $id)->where('id', $field->id)->update([$string => 'empty']);
        }
        return back();
    }
}
