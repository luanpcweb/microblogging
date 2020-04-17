<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TweetStoreRequest extends FormRequest
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

        \Validator::extend('space', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });

        return [
            'username' => 'required|space|regex:/^[@].*$/u',
            'body' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username é necessário para publicação!',
            'username.space' => 'Username com formato inválido! Evite espaços.',
            'username.regex' => 'Username com formato inválido! Comece com @.',
            'body.required' => 'Tweet é necessário para publicação.',
        ];
    }

    public function filters()
    {
        return [
            'username' => 'trim|lowercase',
            'body' => 'trim|escape'
        ];
    }
}
