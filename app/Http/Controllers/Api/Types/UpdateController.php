<?php

namespace App\Http\Controllers\Api\Types;

use App\Actions\Types\UpdateType;
use App\Factories\TypeFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Types\UpdateRequest;
use App\Http\Resources\Api\TypeResource;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\Api\Types\UpdateRequest  $request
     * @param string $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(UpdateRequest $request, string $uuid): JsonResponse
    {
        $type = Type::where('identification', $uuid)->firstOrFail();

        /** @var array<string, mixed> */
        $validatedData = $request->validated();

        UpdateType::handle($type, $validatedData);

        return new JsonResponse(data: new TypeResource($type), status: Response::HTTP_OK);
    }
}