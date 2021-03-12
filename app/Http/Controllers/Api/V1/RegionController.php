<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\RegionResource;
use App\Http\Resources\Api\V1\RegionalPartnerResource;
use App\Http\Resources\Api\V1\ProvinceResource;
use App\Models\Region;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::all();

        return response()->json([
            'regions' => RegionResource::collection($regions),
        ], 200);
    }

    public function uniteRegionals($regionId)
    {
        $region = Region::findOrFail($regionId);
        $uniteRegionals = $region->uniteRegionals;

        return response()->json([
            'uniteRegionals' => UnitRegionalResource::collection($uniteRegionals),
        ], 200);
    }

    public function province($regionId)
    {
        $region = Region::findOrFail($regionId);
        $provinces = $region->provinces;

        return response()->json([
            'provinces' => ProvinceResource::collection($provinces),
        ], 200);
    }

    public function PartnersRegionals($regionId)
    {
        $region = Region::findOrFail($regionId);
        $partnersRegionals = $region->partnersRegionals;

        return response()->json([
            'partnersRegionals' => RegionalPartnerResource::collection($partnersRegionals),
        ], 200);
    }
}