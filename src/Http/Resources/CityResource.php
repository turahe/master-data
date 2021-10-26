<?php

namespace Turahe\Master\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int id
 * @property int province_id
 * @property string name
 * @property string type
 * @property string postal_code
 * @property string latitude
 * @property string longitude
 */
class CityResource extends JsonResource
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
            'province_id' => $this->province_id,
            'name' => $this->name,
            'type' => $this->type,
            'postal_code' => $this->postal_code,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,

        ];
    }
}
