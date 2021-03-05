<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\HelpCaseResource;
use App\Models\HelpCase;

class HelpCaseController extends Controller
{
    public function CaseList()
    {
        $caseList = HelpCase::where('type','cas')->get()->sortByDesc("id");

        return response()->json([
            'caseList' => HelpCaseResource::collection($caseList),
        ], 200);
    }

    public function HelpList()
    {
        $articleList = HelpCase::where('type','article')->get()->sortByDesc("id");

        return response()->json([
            'articleList' => HelpCaseResource::collection($articleList),
        ], 200);
    }
}