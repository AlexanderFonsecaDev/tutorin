<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Comment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id'        => $this->user_id,
            'body'           => $this->body,
            'type'           => $this->commentable_type,
            'commentable_id' => $this->commentable_id,
            'created'        => $this->created_at->diffForHumans(),
            'created_at'     => $this->created_at->format('d-m-y'),
        ];
    }
}
