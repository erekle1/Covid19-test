<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'country'    => $this->name,
            'id'         => $this->id,
            'code'       => $this->code,
            'statistics' => StatisticResource::collection($this->whenLoaded('statistics')),
        ];
    }
}
