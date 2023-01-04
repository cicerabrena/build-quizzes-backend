<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>|\Illuminate\Contracts\Support\Arrayable<string, mixed>|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var \App\Models\User */
        $user = $this;

        return [
            'uuid' => $user->identification,
            'name' => $user->name,
            'email' => $user->email,
            'token' => $user->getAttribute('token')
        ];
    }
}
