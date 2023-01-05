<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UsersCollection;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IndexController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $page = $request->query(key: 'page', default: 1);
        $limit = $request->query(key: 'limit', default: 15);

        $skip = (int) $page * $limit;

        $users = User::skip($skip)->orderBy('name')->paginate($limit);

        return new JsonResponse(data: new UsersCollection($users), status: Response::HTTP_OK);
    }
}
