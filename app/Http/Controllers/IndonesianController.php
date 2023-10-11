<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Province;
use App\Models\Village;
use Illuminate\Http\Request;

class IndonesianController extends Controller
{
    public function city($province_code)
    {
        try {
            if ($province_code) {
                // $province = Province::where('name', $request->province_name)->first();
                $city = City::where('province_code', $province_code)->get();
            }
            return response()->json([
                'status' => 'success',
                'data' => $city,
            ]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function district($city_code)
    {
        try {
            if ($city_code) {
                // $province = Province::where('name', $request->province_name)->first();
                $district = District::where('city_code', $city_code)->get();
            }
            return response()->json([
                'status' => 'success',
                'data' => $district,
            ]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function village($district_code)
    {
        try {
            if ($district_code) {
                // $province = Province::where('name', $request->province_name)->first();
                $village = Village::where('district_code', $district_code)->get();
            }
            return response()->json([
                'status' => 'success',
                'data' => $village,
            ]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function villageDetail($village_code)
    {
        try {
            if ($village_code) {
                // $province = Province::where('name', $request->province_name)->first();
                $village = Village::where('code', $village_code)->first();
            }
            return response()->json([
                'status' => 'success',
                'data' => $village,
            ]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
