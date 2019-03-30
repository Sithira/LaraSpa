<?php

namespace App\Http\Requests\v1\admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8'
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
        switch (strtoupper($this->method())) {
            case "POST":
            case "PUT":

                break;

            case "PATCH":

                $user = $this->user();

                // add the ignore validation rule.
                $this->rules['email'] .= ',' . $user->id;

                if (!$this->has('password')) {
                    $this->rules['password'] = null;
                    unset($this->rules['password']);
                }

                break;

            default:

        }

        return $this->rules;
    }
}
