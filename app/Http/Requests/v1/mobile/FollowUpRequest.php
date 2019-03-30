<?php

namespace App\Http\Requests\v1\mobile;

use Illuminate\Foundation\Http\FormRequest;

class FollowUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'optician_id' => 'required|integer',
            'date' => 'required|date',
            'note' => 'required'
        ];
    }
}
