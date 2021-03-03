<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'name_complet' => $this->name_complet,
            'email' => $this->email,
            'token' => $this->getToken(),
            'UKey' => $this->UKey,
        ];
    }
}
