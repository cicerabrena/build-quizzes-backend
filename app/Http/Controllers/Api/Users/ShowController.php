<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UsersResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShowController extends Controller
{
    public function __invoke(Request $request, string $uuid): JsonResponse
    {
        $user = User::where('identification', $uuid)->first();

        return new JsonResponse(new UsersResource($user), Response::HTTP_OK);
    }
}
