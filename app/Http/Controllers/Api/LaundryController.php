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

    public function claim(Request $request)
    {
        $laundry = Laundry::where([
            ['id', '=', $request->id],
            ['claim_code', '=', $request->claim_code]
        ])->first();

        if (!$laundry) {
            return response()->json([
                'message' => 'Not Found'
            ], 404);
        }

        if ($laundry->user_id != 0) {
            return response()->json([
                'message' => 'Laundry has been Claimed'
            ], 400);
        }

        $laundry->user_id = $request->user_id;
        $updated = $laundry->save();

        if ($updated) {
            return response()->json([
                'data' => $updated
            ], 200);
        } else {
            return response()->json([
                'message' => "Can't be Updated"
            ], 500);
        }
    }
}
