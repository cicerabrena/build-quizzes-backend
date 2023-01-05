<?php

namespace App\Http\Middleware;

use App\Enums\ValidationError;
use App\Models\User;
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
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $uuid = $request->route('uuid');

        if (empty($uuid)) {
            return new JsonResponse(data: ['message' => ValidationError::EMPTY_UUID->value], status: Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = User::where('identification', $uuid)->first();

        if (!isset($user)) {
            return new JsonResponse(data: ['message' => ValidationError::UUID_NOT_VALID->value], status: Response::HTTP_NOT_FOUND);
        }

        return $next($request);
    }
}
