<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DestroyController extends Controller
{
    public function __invoke(Request $request, string $uuid): JsonResponse
    {
        $user = User::where('identification', $uuid)->firstOrFail();

        $user->delete();

        return new JsonResponse(data: [], status: Response::HTTP_NO_CONTENT);
    }
}
