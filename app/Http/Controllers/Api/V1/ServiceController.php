<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\ServiceResource;
use App\Models\Service;

class ServiceController extends Controller
{
    public function serviceDescription()
    {
        $description = Service::all()->sortByDesc("id");

        return response()->json([
            'description' => ServiceResource::collection($description),
        ], 200);
    }

    public function serviceProcedure()
    {
        $procedure = Service::all()->sortByDesc("id");

        return response()->json([
            'procedure' => ServiceResource::collection($procedure),
        ], 200);
    }
}