<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\Helper;

class UnitRegionalResource extends JsonResource
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
            'tel_1' => $this->tel_1,
            'tel_2' => $this->tel_2,
            'email' => $this->email,
            'email_personnel' => $this->email_personnel,
            'region_id' => $this->region_id,
            'province_id' => $this->province_id,
            'fix' => $this->fix,
            'profession_id' => $this->profession_id,
        ];
    }
}

