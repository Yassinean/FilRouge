<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatejobsRequest extends FormRequest
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
            'title' => 'required|min:5|max:50',
            'category_id' => 'required',
            'jobType' => 'required',
            'vacancy' => 'required',
            'location' => 'required|max:70',
            'description' => 'required:',
            'company_name' => 'required|min:3|max:50',
            'experiences' => 'required',
            "salary" => "sometimes",
            "keywords" => "sometimes",
            "responsibility" => "sometimes",
            "qualifications" => "sometimes",
            "company_location" => "sometimes",
            "company_website" => "sometimes"
        ];
    }
}
