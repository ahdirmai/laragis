<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDestinationRequest extends FormRequest
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
            //
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'description' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'village_code' => 'required',
            'category' => 'required|exists:categories,id',
            'imageInput' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
