<?php

namespace App\Http\Controllers\Api\Types;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\TypeResource;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;

class IndexController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        $types = Type::where('user_id', $user->id)->get();

        return new JsonResponse(data: TypeResource::collection($types), status: Response::HTTP_OK);
    }
}
