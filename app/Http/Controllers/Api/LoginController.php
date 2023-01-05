<?php

namespace App\Http\Controllers\Api;

use App\Actions\User\Login;
use App\Factories\UserFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\Api\UserResource;
use App\ValueObjects\ErrorValueObject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request): JsonResponse
    {
        try {

            $user = Login::handle(UserFactory::make($request->validated()));

        } catch (Throwable $e) {
            $errors = new ErrorValueObject(['password' => $e->getMessage()]);

            return new JsonResponse(data: $errors->toArray(), status: Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return new JsonResponse(data: new UserResource($user), status: Response::HTTP_OK);
    }
}
