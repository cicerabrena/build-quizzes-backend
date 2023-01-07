<?php

namespace App\Http\Controllers\Api\Subjects;

use App\Enums\ValidationError;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SubjectResource;
use App\Models\Subject;
use App\ValueObjects\ErrorValueObject;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShowController extends Controller
{
    public function __invoke(Request $request, string $uuid): JsonResponse
    {
        try {

            $subject = Subject::query()->where('identification', $uuid)->firstOrFail();

        } catch (ModelNotFoundException $e) {
            $errors = new ErrorValueObject(ValidationError::SUBJECT_NOT_VALID->value);

            return new JsonResponse(data: $errors->toArray(), status: Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(data: new SubjectResource($subject), status: Response::HTTP_OK);
    }
}
