<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'required',
                'string',
                'max:2000',
            ],
        ];

        if ($this->route('task')->due_date !== $this->get('dueDate')) {
            $rules['dueDate'] = [
                'required',
                'date',
                'date_format:Y-m-d',
                'after_or_equal:today',
            ];
        }

        return $rules;
    }
}
