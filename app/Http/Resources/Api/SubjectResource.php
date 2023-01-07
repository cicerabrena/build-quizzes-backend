<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var \App\Models\Subject */
        $subject = $this;

        return [
            'uuid' => $subject->identification,
            'name' => $subject->name,
            'slug' => $subject->slug,
            'description' => $subject->description,
            'creator' => $subject->user ? $subject->user->name : null
        ];
    }
}
