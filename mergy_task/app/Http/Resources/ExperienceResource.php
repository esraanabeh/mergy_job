<?php

namespace App\Http\Resources;
use Carbon\Carbon;

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
            'start_date' =>Carbon::parse( $this->start_date)->format('d/m/Y') ,
            'end_date' => Carbon::parse($this->end_date)->format('d/m/Y') , 
        ];
    }
}
