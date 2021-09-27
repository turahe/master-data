<?php

namespace Turahe\Master\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int country_id
 * @property string name
 * @property string region
 * @property string iso_3166_2
 * @property string region_code
 * @property string calling_code
 * @property string latitude
 * @property string longitude
 * @property int id
 */
class StateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'country_id' => $this->country_id,
            'name' => $this->name,
            'region' => $this->region,
            'iso_3166_2' => $this->iso_3166_2,
            'region_code' => $this->region_code,
            'calling_code' => $this->calling_code,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
