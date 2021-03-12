<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\Helper;

class RegionalPartnerResource extends JsonResource
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
            'nom' => $this->nom,
            'tel_1' => $this->tel_1,
            'adresse' => $this->adresse,
            'description' => $this->description,
            'responsable' => $this->responsable,
            'email' => $this->email,
            'tel_2' => $this->tel_2,
            'image' => $this->imagesUrls,
        ];
    }
}
   