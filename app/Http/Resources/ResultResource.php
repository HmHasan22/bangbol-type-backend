<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'league'=>$this->league->name,
            'date'=>$this->date,
            'home_team'=>$this->home_team,
            'away_team'=>$this->away_team,
            'result_one'=>$this->result_one,
            'result_two'=>$this->result_two,
        ];
    }
}
