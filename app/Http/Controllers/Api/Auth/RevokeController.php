<?php

namespace App\Http\Controllers\Api\Auth;

use App\Enums\ValidationError;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RevokeRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RevokeController extends Controller
{
    public function __invoke(RevokeRequest $request, string $uuid): JsonResponse
    {
        try {

            $user = User::where('identification', $uuid)->firstOrFail();

            $user->tokens()->where('token', $request->token)->delete();

        } catch (ModelNotFoundException $e) {
            return new JsonResponse(data: ['message' => ValidationError::USER_NOT_REGISTERED->value], status: Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(data: [], status: Response::HTTP_NO_CONTENT);
    }
}