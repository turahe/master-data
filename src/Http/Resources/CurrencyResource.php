<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string priority
 * @property string iso_code
 * @property string symbol
 * @property string disambiguate_symbol
 * @property string alternate_symbols
 * @property string subunit
 * @property string subunit_to_unit
 * @property string symbol_first
 * @property string decimal_mark
 * @property string thousands_separator
 * @property string iso_numeric
 * @property string smallest_denomination
 * @property string html_entity
 * @property string exchange_rate
 * @property string name
 * @property mixed id
 */
class CurrencyResource extends JsonResource
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
            'priority' => $this->priority,
            'iso_code' => $this->iso_code,
            'name' => $this->name,
            'symbol' => $this->symbol,
            'disambiguate_symbol' => $this->disambiguate_symbol,
            'alternate_symbols' => $this->alternate_symbols,
            'subunit' => $this->subunit,
            'subunit_to_unit' => $this->subunit_to_unit,
            'symbol_first' => $this->symbol_first,
            'html_entity' => $this->html_entity,
            'decimal_mark' => $this->decimal_mark,
            'thousands_separator' => $this->thousands_separator,
            'iso_numeric' => $this->iso_numeric,
            'smallest_denomination' => $this->smallest_denomination,
            'exchange_rate' => $this->exchange_rate,
        ];
    }
}
