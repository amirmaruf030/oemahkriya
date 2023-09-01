<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function provinces(Request $request)
    {
        return Province::all();
    }

    public function regencies(Request $request, $provinces_id)
    {
        return Regency::where('province_id', $provinces_id)->get();
    }
    public function provincesid(Request $request)
    {
        return Cart::with(['user'])->get();
    }

    public function regenciesid(Request $request, $provinces_id)
    {
        return Regency::where('province_id', $provinces_id)->get();
    }
}
