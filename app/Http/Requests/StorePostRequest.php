<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'title' => 'required|string|min:5|max:200|unique:posts',
        'content' => 'required|string|min:50',
        'category_id' => 'required|exists:categories,id',
        'tags' => 'array|min:1|max:5',
        'tags.*' => 'exists:tags,id',
        'published_at' => 'nullable|date|after:today',
    ];
    }
    public function messages()
    {
    return [
        'attachments.max' => 'No puedes subir más de 5 archivos',
        'attachments.*.max' => 'Cada archivo no debe superar 5MB',
        'attachments.*.mimes' => 'Solo se aceptan JPG, PNG, PDF, DOC, DOCX',
    ];
    }
}
