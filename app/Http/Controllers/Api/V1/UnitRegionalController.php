<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\UnitRegionalResource;
use App\Models\UniteRegional;

class UnitRegionalController extends Controller
{
    public function index()
    {
        $region = UniteRegional::all();

        return response()->json([
            'region' => UnitRegionalResource::collection($region),
        ], 200);
    }
}