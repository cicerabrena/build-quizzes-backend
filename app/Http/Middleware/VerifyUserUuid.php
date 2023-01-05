<?php

namespace App\Http\Middleware;

use App\Enums\ValidationError;
use App\Models\User;
use App\ValueObjects\ErrorValueObject;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VerifyUserUuid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $uuid = $request->route('uuid');

        if (empty($uuid)) {
            $errors = new ErrorValueObject(ValidationError::EMPTY_UUID->value);

            return new JsonResponse(data: $errors->toArray(), status: Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = User::where('identification', $uuid)->first();

        if (!isset($user)) {
            $errors = new ErrorValueObject(ValidationError::UUID_NOT_VALID->value);

            return new JsonResponse(data: $errors->toArray(), status: Response::HTTP_NOT_FOUND);
        }

        return $next($request);
    }
}
