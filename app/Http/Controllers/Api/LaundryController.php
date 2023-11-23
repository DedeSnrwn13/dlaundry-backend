<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laundry;
use Illuminate\Http\Request;

class LaundryController extends Controller
{
    public function readAll()
    {
        $laundries = Laundry::with('user', 'shop')->get();

        return response()->json([
            'data' => $laundries
        ], 200);
    }

    public function whereUserId($id)
    {
        $laundries = Laundry::with('shop', 'user')->where('user_id', '=', $id)
            ->orderBy('created_at', 'desc')->get();

        if (count($laundries) > 0) {
            return response()->json([
                'data' => $laundries
            ], 200);
        } else {
            return response()->json([
                'data' => $laundries,
                'message' => 'Not Found'
            ], 404);
        }
    }
}
