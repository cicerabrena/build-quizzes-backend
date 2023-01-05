<?php

namespace App\Http\Controllers\Api\Users;

use App\Actions\User\UpdateUser;
use App\Enums\ValidationError;
use App\Exceptions\EmailRegisteredException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UpdateRequest;
use App\Http\Resources\Api\UsersResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UpdateController extends Controller
{

    public function __invoke(UpdateRequest $request, string $uuid): JsonResponse
    {
        try {
            $request->merge(['password' => bcrypt(strval($request->input('password')))]);

            $requestData = $request->all();

            $user = User::query()->where('identification', $uuid)->firstOrFail();

            $userUpdated = UpdateUser::handle($user, $requestData);

        } catch (ModelNotFoundException $e) {
            return new JsonResponse(data: ['message' => ValidationError::USER_NOT_REGISTERED->value], status: Response::HTTP_NOT_FOUND);
        } catch (EmailRegisteredException $e) {
            return new JsonResponse(data: ['message' => $e->getMessage()], status: Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return new JsonResponse(data: new UsersResource($userUpdated), status: Response::HTTP_OK);
    }
}
