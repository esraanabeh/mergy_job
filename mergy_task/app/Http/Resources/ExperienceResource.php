<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExperienceResource extends JsonResource
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
            'job_id' => $this->job_id,
            'job_title' => $this->job_title,
            'location' => $this->location ,
            'start_date' => $this->start_date ,
            'end_date' => $this->end_date , 
        ];
    }
}
