<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagementController extends Controller
{
    //

    public function list_laptop()
{
    $ds_sanpham = DB::table('san_pham')->where("status", 1)->get();
    
    return view('laptop.list_laptop', compact('ds_sanpham'));
}
    public function delete_laptop($id)
    {
        DB::table('san_pham')->where('id', $id)->update(["status" => 0]);
        return redirect()->back();
    }
}