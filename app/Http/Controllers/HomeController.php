<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        
        $query = DB::table('san_pham');

    
        if ($request->has('brand_id') && $request->brand_id != '') {
            $query->where('id_danh_muc', $request->brand_id);
        } else {
            $query->take(20);
        }

        
        if ($request->sort == 'asc') {
            $query->orderBy('gia', 'asc');
        } elseif ($request->sort == 'desc') {
            $query->orderBy('gia', 'desc');
        } else {
           
            $query->latest('id');
        }

        
        $laptops = $query->get();

   
        $brands = DB::table('danh_muc_laptop')->get();

      
        return view('laptop.index', compact('laptops', 'brands'));
    }


    public function detail($id)
    {
        $laptop = DB::table('san_pham')->where('id', $id)->first();

        if (!$laptop) {
            abort(404);
        }

      
        $brands = DB::table('danh_muc_laptop')->get();

        return view('laptop.detail', compact('laptop', 'brands'));
    }
}