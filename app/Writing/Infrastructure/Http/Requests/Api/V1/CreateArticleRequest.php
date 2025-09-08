<?php

namespace Writing\Infrastructure\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Aquí iría la lógica de autorización. Por ejemplo, verificar si el usuario
        // autenticado tiene permiso para crear artículos. Por ahora, lo dejamos en true.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Movemos las reglas de validación que teníamos en el controlador aquí.
        return [
            'author_id' => ['required', 'uuid'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ];

    }
}
