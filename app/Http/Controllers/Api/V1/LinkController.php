<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\LinkResource;
use App\Models\Link;

class LinkController extends Controller
{
    public function index()
    {
        $links = Link::all()->sortByDesc("id");

        return response()->json([
            'links' => LinkResource::collection($links),
        ], 200);  
    }
}