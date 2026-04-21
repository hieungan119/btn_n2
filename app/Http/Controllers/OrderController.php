<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendEmail;
use App\Models\User;

class OrderController extends Controller
{
    public function order()
{
    $cart = [];
    $data = [];
    $quantity = [];
    if (session()->has('cart')) {
        $cart = session("cart");
        $ids = array_keys($cart);
        if (!empty($ids)) {
            $quantity = $cart;
            $data = DB::table("san_pham")
                      ->whereIn("id", $ids)
                      ->get();
        }
    }
    return view("laptop.order", compact("quantity", "data"));
}
    public function cartdelete(Request $request)
    {
    $request->validate([
    "id"=>["required","numeric"]
    ]);
    $id = $request->id;
    $total = 0;
    $cart = [];
    if(session()->has('cart'))
    {
    $cart = session()->get("cart");
    unset($cart[$id]);
    }
    session()->put("cart",$cart);
    return redirect()->route('order');
    }
public function ordercreate(Request $request)
{
    $request->validate([
        "hinh_thuc_thanh_toan" => ["required", "numeric"]
    ]);

    if (session()->has('cart')) {
        $cart = session("cart");
        $ids = array_keys($cart);

        if (!empty($ids)) {
            $data = [];
            $quantity = $cart; 

            DB::transaction(function () use ($request, $cart, $ids, &$data) {
                $id_don_hang = DB::table("don_hang")->insertGetId([
                    "ngay_dat_hang" => now(),
                    "tinh_trang" => 1,
                    "hinh_thuc_thanh_toan" => $request->hinh_thuc_thanh_toan,
                    "user_id" => Auth::id() 
                ]);

                $data = DB::table("san_pham")->whereIn("id", $ids)->get();

                $detail = [];
                foreach ($data as $row) {
                    $detail[] = [
                        "ma_don_hang" => $id_don_hang,
                        "id_san_pham" => $row->id, 
                        "so_luong"    => $cart[$row->id],
                        "don_gia"     => $row->gia_ban
                    ];
                }
                DB::table("chi_tiet_don_hang")->insert($detail);

                session()->forget('cart');
            });

            $user = Auth::user(); 
            if ($user) {
                Notification::send($user, new SendEmail($data, $quantity));
            }

            return redirect()->route('order')->with('success', 'Đặt hàng thành công');
        }
    }
    return redirect()->route('home');
}
public function testemail()
{
    $user = User::find(2);
    if ($user) {
        Notification::send($user, new SendEmail([], [])); 
        
        return "Đã gửi email thành công đến: " . $user->email;
    }
    return "Không tìm thấy người dùng có ID là 2";
}
}