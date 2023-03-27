<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $dateArr = explode('/', $this->date);
        $date = "$dateArr[2]/$dateArr[1]/$dateArr[0]";

        return [
            'id' => $this->id,
            'competition' => $this->competition,
            'hometeam' => $this->hometeam,
            'awayteam' => $this->awayteam,
            'titlelong' => $this->titlelong,
            'score' => new ScoreResource($this->whenLoaded('score')),
            'date' => Carbon::parse($date)->format('d M Y'),
            'section' => $this->section
        ];
    }
}
