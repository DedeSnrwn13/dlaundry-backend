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
}
