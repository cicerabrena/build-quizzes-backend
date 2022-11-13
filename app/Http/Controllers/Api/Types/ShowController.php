<?php

namespace App\Http\Controllers\Api\Types;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, string $uuid): JsonResponse
    {
        $type = Type::where('identification', $uuid)->firstOrFail();

        return new JsonResponse(data: $type, status: Response::HTTP_OK);
    }
}
