<?php

namespace Writing\Infrastructure\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class AddCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'author' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
        ];
    }
}
