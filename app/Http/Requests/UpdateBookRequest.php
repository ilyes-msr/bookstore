<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $bookId = $this->route('book');
        return [
            'title' => 'required|max:255',
            'number_of_pages' => 'required|integer',
            'isbn' => ['required', 'alpha_num', Rule::unique('books', 'isbn')->ignore($bookId)],
            'category' => 'sometimes|exists:categories,id',
            'publisher' => 'sometimes|exists:publishers,id',
            'number_of_copies' => 'required|integer',
            'price' => 'required|numeric',
            'cover_image' => 'image|max:8192',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
        ];
    }
}
