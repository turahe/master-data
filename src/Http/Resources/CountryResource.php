<?php

namespace Turahe\Master\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int id
 * @property string capital
 * @property string citizenship
 * @property string country_code
 * @property string currency
 * @property string currency_code
 * @property string currency_sub_unit
 * @property string currency_symbol
 * @property string full_name
 * @property string iso_3166_2
 * @property string iso_3166_3
 * @property string name
 * @property string region_code
 * @property string sub_region_code
 * @property string eea
 * @property string calling_code
 * @property string flag
 */
class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'capital' => $this->capital,
            'citizenship' => $this->citizenship,
            'country_code' => $this->country_code,
            'currency' => $this->currency,
            'currency_code' => $this->currency_code,
            'currency_sub_unit' => $this->currency_sub_unit,
            'currency_symbol' => $this->currency_symbol,
            'full_name' => $this->full_name,
            'iso_3166_2' => $this->iso_3166_2,
            'iso_3166_3' => $this->iso_3166_3,
            'name' => $this->name,
            'region_code' => $this->region_code,
            'sub_region_code' => $this->sub_region_code,
            'eea' => $this->eea,
            'calling_code' => $this->calling_code,
            'flag' => $this->flag,
        ];
    }
}
