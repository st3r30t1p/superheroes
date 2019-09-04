<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeroRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nickname' => 'required|max:30',
            'real_name' => 'max:50',
            'origin_description' => 'nullable|string',
            'superpowers' => 'max:255',
            'catch_phrase' => 'max:255',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
