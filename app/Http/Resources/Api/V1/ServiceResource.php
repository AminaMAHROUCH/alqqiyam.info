<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\Helper;

class ServiceResource extends JsonResource
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
            'title' => $this->title,
            'procedure' => $this->procedure,
            'video_procedure' => $this->video_procedure,
            'description' => $this->description,
            'video_description' => $this->video_description
        ];
    }
}



