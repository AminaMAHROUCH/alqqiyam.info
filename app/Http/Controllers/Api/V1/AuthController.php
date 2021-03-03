<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\RestTokenHelper;
use App\Http\Resources\Api\V1\UserResource;

class AuthController extends Controller
{
    public function login()
    {
        $user = RestTokenHelper::login(request()->get('email'), request()->get('password'));

        if ($user) {
            return response()->json([
                'user' => UserResource::make($user),
            ], 200);
        }

        return response()->json([
            'error' => 'Unauthorized',
        ], 401);
    }
}