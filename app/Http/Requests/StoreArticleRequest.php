<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'nullable|min:5',
            'status' => 'required|numeric',
            'article_type_id' => 'required|numeric',
            'volume' => 'required',
            'number' => 'required',
            'abstract' => 'required|min:4',
            'keyword' => 'required',
            'meta_title' => 'required',
            'sec_rev_email' => 'nullable|email',
            'upload_pdf' => 'nullable|max:52428800|mimes:pdf,PDF',
            'f_name.*' => 'required',
            'email.*' => 'nullable|email',
            'affiliation.*' => 'nullable|numeric',
            'mobile.*' => 'nullable|numeric|digits_between:10,12',
            'tel.*' => 'nullable|numeric|digits_between:5,16',
            'fax.*' => 'nullable|max:16',
            'pincode.*' => 'nullable|numeric',
            'aid.*' => 'nullable|numeric|max:10',
        ];
    }
}
