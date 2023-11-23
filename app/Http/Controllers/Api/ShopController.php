<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function readAll()
    {
        $shops = Shop::all();

        return response()->json([
            'data' => $shops
        ], 200);
    }
}
