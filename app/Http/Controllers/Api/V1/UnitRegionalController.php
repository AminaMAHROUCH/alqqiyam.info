<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\UnitRegionalResource;
use App\Models\UniteRegional;

class UnitRegionalController extends Controller
{ 
    public function index()
    {
        $unitRegion = UniteRegional::all();

        return response()->json([
            'unitRegion' => UnitRegionalResource::collection($unitRegion),
        ], 200);
    }
} 