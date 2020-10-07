<?php

namespace Turahe\Master\Http\Requests\Village;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Turahe\Master\Models\Village;

class VillageStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['required', 'max:10', Rule::unique((new Village())->getTable())->ignore($this->previous_id, 'id')],
            'name' => ['required'],
            'district_id' => ['required'],
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
