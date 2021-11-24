<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use \Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AppealPostRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:20'],
            'surname' => ['required', 'string', 'max:40'],
            'patronymic' => ['nullable', 'string', 'max:20'],
            'age' => ['required', 'integer', 'between:14, 123'],
            'gender' => ['required', 'integer', Rule::in([Gender::MALE, Gender::FEMALE])],
            'phone' => ['nullable', 'string', 'required_without:email', 'regex:/^((\+7)|7|8)\(\d{3}\)\d{2}-\d{2}-\d{3}$/'],
            'email' => ['nullable', 'string', 'required_without:phone', 'max:100', 'email'],
            'message' => ['required', 'string', 'max:100'],
        ];
    }
}
