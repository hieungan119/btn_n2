<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class NhienController extends Controller
{
   public function index() 
{   
    $data = DB::table('san_pham')->limit(20)->get();
    return view("laptop.index", compact("data"));
}
public function detail($id)

{
    $data = DB::table('san_pham')->where('id', $id)->first();
    if (!$data) {
        return "Không tìm thấy loại laoptop này ";
    }
    return view("laptop.detail", compact("data"));
}
public function cartadd(Request $request)
{
    $request->validate([
        "id" => ["required", "numeric"],
        "num" => ["required", "numeric"]
    ]);

    $id = $request->id;
    $num = $request->num;
    $cart = session()->get("cart", []);

    // Cập nhật giỏ hàng
    if (isset($cart[$id])) {
        $cart[$id] += $num;
    } else {
        $cart[$id] = $num;
    }

    session()->put("cart", $cart);
    return response()->json([
        'total_items' => count($cart)
    ]);
}
}