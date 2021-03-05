<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\RegionResource;
use App\Models\Region;

class RegionController extends Controller
{
    public function index()
    {
        $region = Region::all();

        return response()->json([
            'region' => RegionResource::collection($region),
        ], 200);
    }
}