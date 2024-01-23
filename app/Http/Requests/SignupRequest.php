<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'fullname' => 'required|regex:/^[a-zA-Z\s]+$/|min:5|string',
            'username' => 'required|min:5|max:39|unique:users|regex:/^(?!.*[-]{2})(?!.*[-_]$)(?!.*__)(?!.*[-_][-_])[a-zA-Z0-9]+([-_][a-zA-Z0-9]+)*$/',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'fullname.required' => 'Ups! Jangan lupa mengisi nama Anda!',
            'fullname.string' => 'Hmm... nama Anda tidak boleh mengandung angka atau simbol!',
            'fullname.min' => 'Oh tidak! Nama Anda harus minimal 5 karakter!',
            'fullname.regex' => 'Tunggu, apakah nama Anda benar-benar mengandung huruf?',
            'username.required' => 'Hai! Anda perlu mengisi username Anda!',
            'username.min' => 'Oops! Username Anda harus minimal 5 karakter!',
            'username.max' => 'Username terlalu panjang (maksimum 39 karakter). Username hanya boleh mengandung karakter alfanumerik atau tanda hubung tunggal, dan tidak boleh diawali atau diakhiri dengan tanda hubung.',
            'username.unique' => 'Oh tidak! Username ini sudah digunakan!',
            'username.regex' => 'Username hanya boleh mengandung karakter alfanumerik atau tanda hubung tunggal, dan tidak boleh diawali atau diakhiri dengan tanda hubung.',
            'email.required' => 'Tunggu! Anda harus mengisi email Anda!',
            'email.email' => 'Hmm... format email sepertinya agak salah!',
            'email.unique' => 'Oops! Email ini sudah digunakan!',
            'password.required' => 'Uh-oh! Jangan lupa mengisi password Anda!',
            'password.min' => 'Oopsie daisy! Password Anda harus minimal 6 karakter!',
            'password.confirmed' => 'Whoopsie! Konfirmasi password tidak cocok!',
        ];
    }
}
