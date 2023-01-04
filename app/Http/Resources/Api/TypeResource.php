<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Type;

class TypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>|\Illuminate\Contracts\Support\Arrayable<string, mixed>|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Type */
        $type = $this;

        return [
            'uuid' => $type->identification,
            'name' => $type->name
        ];
    }
}
