<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    protected $rules = [
        'name' => 'required',
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // todo: maybe something like request()->user()->hasPermission('permission');

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case "POST":

                break;

            case "PATCH":

                break;

            case "PUT":

                break;

            default:

        }

        return $this->rules;
    }
}
