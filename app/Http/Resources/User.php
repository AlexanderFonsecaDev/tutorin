<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Profile as ProfileResource;
use App\Http\Resources\Location as LocationResource;
use App\Http\Resources\CategoryCollection;

class User extends JsonResource
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
            'id'          => $this->id,
            'name'        => $this->name,
            'email'       => $this->email,
            'gender'      => $this->gender,
            'birthday'    => $this->birthday,
            'mobile'      => $this->mobile,
            'phonenumber' => $this->phonenumber,
            'active'      => $this->active,
            'admin'       => $this->admin,
            'created'     => $this->created_at->diffForHumans(),
            'created_at'  => $this->created_at->format('d-m-y'),
            'update_at'   => $this->updated_at->format('d-m-y'),
            'image'       => $this->image->url,
            'profile'     => new ProfileResource($this->profile),
            'location'    => new LocationResource($this->profile->location),
            'categories'  => new CategoryCollection($this->profile->categories),
        ];
    }
}
