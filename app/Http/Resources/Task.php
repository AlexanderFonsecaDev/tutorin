<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Task extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'user_id'     => $this->user_id,
            'category_id' => $this->category_id,
            'excerpt'     => $this->excerpt,
            'body'        => $this->body,
            'price'       => $this->price,
            'price'       => $this->price,
            'delivery'    => $this->delivery,
            'status'      => $this->status,
            'created'     => $this->created_at->diffForHumans(),
            'created_at'  => $this->created_at->format('d-m-y'),
        ];
    }
}
