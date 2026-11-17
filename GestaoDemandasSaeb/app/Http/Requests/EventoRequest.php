<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EventoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'color' => ['nullable', 'in:#64ee64,#e9a558,#e94b4b'],
            'start' => ['required', 'date'],
            'end' => ['nullable', 'date', 'after:start'],
        ];
    }

    public function messages(): array
    {
        return[
            'title.required' => 'O Campo título é obrigatório',
            'title.max' => 'O Campo título deve ter no máximo 255 caracteres',
            'color.in' => 'Prioridade inválida',
            'start.required' => 'O Campo início é obrigatório',
            'start.date' => 'O Campo início deve ser uma data válida',
            'end.date' => 'O Campo término deve ser uma data válida',
            'end.after' => 'O Campo término deve ser uma data posterior à data de início'
        ];
    }
}
