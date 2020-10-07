<?php

namespace Turahe\Master\Http\Requests\District;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Turahe\Master\Models\District;

class DistrictStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['required', 'max:8', Rule::unique((new District())->getTable())->ignore($this->previous_id, 'id')],
            'name' => ['required'],
            'city_id' => ['required'],
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
