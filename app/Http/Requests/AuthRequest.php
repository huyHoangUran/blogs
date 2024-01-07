<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'name'  => 'required|unique:users|max:' . config('length.max_name'),
            'email' => 'required|unique:users|email|max:' . config('length.max_length'),
            'password' => 'required|confirmed|min:' . config('length.min_length') . '|max:' . config('length.max_length'),
        ];
    }
}
