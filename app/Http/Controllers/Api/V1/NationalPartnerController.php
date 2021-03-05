<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\NationalPartnerResource;
use App\Models\NationalPartner;

class NationalPartnerController extends Controller
{
    public function index()
    {
        $nationalPartner = NationalPartner::all()->sortByDesc("id");

        return response()->json([
            'nationalPartner' => NationalPartnerResource::collection($nationalPartner),
        ], 200);
    }
}