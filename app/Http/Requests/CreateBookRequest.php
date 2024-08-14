<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateBookRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'number_of_pages' => 'required|integer',
            'isbn' => ['required', 'alpha_num', Rule::unique('books', 'isbn')],
            'category' => 'sometimes|exists:categories,id',
            'publisher' => 'sometimes|exists:publishers,id',
            'number_of_copies' => 'required|integer',
            'number_of_pages' => 'required|integer',
            'price' => 'required|numeric',
            'cover_image' => 'required|image|max:8192',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
        ];
    }
}
