<?php

namespace App\Http\Controllers\Api\Subjects;

use App\Enums\ValidationError;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\ValueObjects\ErrorValueObject;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeleteController extends Controller
{
    public function __invoke(Request $request, string $uuid): JsonResponse
    {
        try {

            $subject = Subject::query()->where('identification', $uuid)->firstOrFail();

            $subject->delete();

        } catch (ModelNotFoundException $e) {
            $errors = new ErrorValueObject(ValidationError::SUBJECT_NOT_VALID->value);

            return new JsonResponse(data: $errors->toArray(), status: Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(data: [], status: Response::HTTP_NO_CONTENT);
    }
}
