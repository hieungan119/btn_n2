<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MnhuController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        if (empty($keyword)) {
            $laptops = collect();
        } else {
            $laptops = DB::table('san_pham')
                ->where('tieu_de', 'LIKE', "%{$keyword}%")
                ->orWhere('ten', 'LIKE', "%{$keyword}%")
                ->get();
        }

        return view('laptop.search', compact('laptops', 'keyword'));
    }
}