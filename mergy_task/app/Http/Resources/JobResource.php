<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->uid,
            'name' => $this->name,
            'email' => $this->email ,
            'job' => $this->job ,
            'image' => $this->getFirstMediaUrl('image'),
            'cv' => $this->getFirstMediaUrl('cv'),
            
         
        ];
    }
}
