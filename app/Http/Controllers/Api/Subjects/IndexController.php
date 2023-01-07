<?php

namespace App\Http\Controllers\Api\Subjects;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SubjectCollection;
use App\Models\Subject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IndexController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $subjects = Subject::query()->get();

        return new JsonResponse(data: new SubjectCollection($subjects), status: Response::HTTP_OK);
    }
}
