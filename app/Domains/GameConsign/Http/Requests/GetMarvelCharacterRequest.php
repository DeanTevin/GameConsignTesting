<?php

namespace App\Domains\GameConsign\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class GetMarvelCharacterRequest extends FormRequest
{
    /**
     * @var Validator
     */
    public $validator = null;

    /**
     * for return response message from custom request
     *
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
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

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "sometimes|string",
            "nameStartsWith" => "sometimes|string",
            "modifiedSince" => "sometimes|date",
            "comics" => "sometimes|integer",
            "series" => "sometimes|integer",
            "events" => "sometimes|integer",
            "stories" => "sometimes|integer",
            "orderBy" => "sometimes|string|in:name,modified,-name,-modified",
            "limit" => "sometimes|integer",
            "offset" => "sometimes|integer",
        ];
    }
}
