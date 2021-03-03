<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\PrivateNewsResource;
use App\Models\PrivateNews;

class PrivateNewsController extends Controller
{
    public function index()
    {
        $private_news = PrivateNews::all()->sortByDesc("id");

        return response()->json([
            'private_news' => PrivateNewsResource::collection($private_news),
        ], 200);
    }
}