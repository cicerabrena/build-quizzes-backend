<?php

namespace App\Http\Controllers\Api\Types;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class DestroyController extends Controller
{
    public function __invoke(\Illuminate\Http\Request $request, string $uuid): \Illuminate\Http\JsonResponse
    {
        $type = Type::where('identification', $uuid)->firstOrFail();

        $type->delete();

        return new JsonResponse(data: [], status: Response::HTTP_OK);
    }
}
