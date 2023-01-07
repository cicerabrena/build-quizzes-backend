<?php

namespace App\Http\Controllers\Api\Subjects;

use App\Actions\Subject\CreateSubject;
use App\Factories\SubjectFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Subject\StoreRequest;
use App\Http\Resources\Api\SubjectResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): JsonResponse
    {
        $subject = CreateSubject::handle(SubjectFactory::make($request->validated()));

        return new JsonResponse(data: new SubjectResource($subject), status: Response::HTTP_CREATED);
    }
}
