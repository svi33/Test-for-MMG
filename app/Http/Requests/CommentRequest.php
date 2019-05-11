<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Author_Rule;

class CommentRequest extends FormRequest
{

    public function rules()
    {
        return [
            'author' => ['required' ,'string', new Author_Rule],
            'content'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'author.required' => 'Author field required and must been two word, first letter in Uppercase',
            'content.required' => 'Message must be required',
        ];
    }
}
