<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Profile extends JsonResource
{

    public function toArray($request)
    {
        return [
            'dni'           => $this->dni,
            'description'   => $this->description,
            'valoration'    => $this->valoration,
        ];
    }
}
