<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function readAll()
    {
        $promos = Promo::with('shop')->get();

        return response()->json([
            'data' => $promos
        ], 200);
    }

    public function readLimit()
    {
        $promos = Promo::with('shop')->orderBy('created_at', 'desc')->limit(5)->get();

        if (count($promos) > 0) {
            return response()->json([
                'data' => $promos
            ], 200);
        } else {
            return response()->json([
                'data' => $promos,
                'message' => 'Not Found'
            ], 404);
        }
    }
}
