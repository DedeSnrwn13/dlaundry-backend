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

    public function readRecommendationLimit()
    {
        $shops = Shop::orderBy('rate', 'desc')->limit(5)->get();

        if (count($shops) > 0) {
            return response()->json([
                'data' => $shops
            ], 200);
        } else {
            return response()->json([
                'data' => $shops,
                'message' => 'Not Found'
            ], 404);
        }
    }
}
