<?php

namespace App\Http\Controllers\Api;

use App\Actions\User\RegisterUser;
use App\Factories\UserFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\Api\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $request->merge(['password' => bcrypt(strval($request->input('password')))]);

        $requestData = $request->all();

        $user = RegisterUser::handle(UserFactory::make($requestData));

        return new JsonResponse(data: new UserResource($user), status: Response::HTTP_CREATED);
    }
}
