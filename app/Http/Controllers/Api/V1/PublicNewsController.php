<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\PublicNewsResource;
use App\Models\PublicNews;

class PublicNewsController extends Controller
{
    public function index()
    {
        $public_news = PublicNews::all()->sortByDesc("id");

        return response()->json([
            'public_news' => PublicNewsResource::collection($public_news),
        ], 200);
    }
}