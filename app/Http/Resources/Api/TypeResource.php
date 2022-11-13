<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

class TypeResource extends JsonApiResource
{
    /**
     * @param Request $request
     * @return string
     */
    protected function toType(Request $request): string
    {
        return 'type';
    }

    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    protected function toAttributes(Request $request): array
    {
        return [
            'name' => $this->name
        ];
    }

}
