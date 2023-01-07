<?php

namespace App\Http\Controllers\Api\Subjects;

use App\Actions\Subject\UpdateSubject;
use App\Enums\ValidationError;
use App\Factories\SubjectFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Subject\UpdateRequest;
use App\Http\Resources\Api\SubjectResource;
use App\Models\Subject;
use App\ValueObjects\ErrorValueObject;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, string $uuid): JsonResponse
    {
        $hasKeys = (bool) $request->input('show_errors_input', true);

        try {

            $oldSubject = Subject::query()->where('identification', $uuid)->firstOrFail();

            $subject = UpdateSubject::handle($oldSubject, SubjectFactory::make(attributes: $request->validated()));

        } catch (ModelNotFoundException $e) {
            $errors = new ErrorValueObject(ValidationError::SUBJECT_NOT_VALID->value);

            $errors->setHasKeys($hasKeys);

            return new JsonResponse(data: $errors->toArray(), status: Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            $errors = new ErrorValueObject($e->getMessage());

            $errors->setHasKeys($hasKeys);

            return new JsonResponse(data: $errors->toArray(), status: Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return new JsonResponse(data: new SubjectResource($subject), status: Response::HTTP_OK);
    }
}
