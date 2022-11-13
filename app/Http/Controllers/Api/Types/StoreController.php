<?php

namespace App\Http\Controllers\Api\Types;

use App\Actions\Types\CreateNewType;
use App\Factories\TypeFactory;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Api\Types\StoreRequest;
use App\Http\Resources\Api\TypeResource;
use Illuminate\Http\Response;

class StoreController extends Controller
{
    /**
     * @param  \App\Http\Requests\Api\Types\StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(StoreRequest $request): JsonResponse
    {
        $type = CreateNewType::handle(TypeFactory::make($request->validated()));

        return new JsonResponse(data: new TypeResource($type), status: Response::HTTP_CREATED);
    }
}
