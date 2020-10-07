<?php

namespace Turahe\Master\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Turahe\Master\Models\City;

class CityStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['required', 'max:4', Rule::unique((new City())->getTable())->ignore($this->previous_id, 'id')],
            'name' => ['required'],
            'province_id' => ['required'],
            'meta' => 'nullable',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
