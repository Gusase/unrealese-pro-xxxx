<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateUserRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        $rules = [
            'fullname' => 'required|regex:/^[a-zA-Z\s]+$/|min:5',
            'username' => strtolower($this->user()->username) == strtolower($this->input('username')) ? 'required|max:39|regex:/^(?!.*[-]{2})(?!.*[-_]$)(?!.*__)(?!.*[-_][-_])[a-zA-Z0-9]+([-_][a-zA-Z0-9]+)*$/' : 'required|min:5|max:39|unique:users|regex:/^(?!.*[-]{2})(?!.*[-_]$)(?!.*__)(?!.*[-_][-_])[a-zA-Z0-9]+([-_][a-zA-Z0-9]+)*$/',
            'email' => strtolower($this->user()->email) == strtolower($this->input('email')) ? 'required' : 'required|email|unique:users',
        ];

        if ($this->file('pp')) {
            $rules['pp'] = 'max:2048|mimes:png,jpg,jpeg,gif';
        } else {
            if ($this->input('password') || Hash::check($this->input('password'), $this->user()->password)) {
                $rules['password'] = 'required|min:6';
            }
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'fullname.required' => 'Mohon masukkan nama lengkap Anda; kami tidak dapat melanjutkan tanpa itu!',
            'fullname.regex' => 'Hanya huruf yang diizinkan dalam nama lengkap, tanpa karakter khusus!',
            'fullname.min' => 'Nama lengkap Anda harus mengandung minimal 5 karakter!',
            'username.required' => 'Harap berikan username pilihan Anda, ini adalah kolom wajib!',
            'username.min' => 'Username Anda harus memiliki setidaknya 5 karakter; sedikit lebih kreatif, tolong!',
            'username.max' => 'Username terlalu panjang (maksimum 39 karakter). Username hanya boleh mengandung karakter alfanumerik atau tanda hubung tunggal, dan tidak boleh dimulai atau diakhiri dengan tanda hubung.',
            'username.unique' => 'Ups! Username ini sudah digunakan; silakan pilih yang lain!',
            'username.regex' => 'Username hanya boleh mengandung karakter alfanumerik atau tanda hubung tunggal, dan tidak boleh dimulai atau diakhiri dengan tanda hubung',
            'email.required' => 'Alamat email diperlukan; silakan isi kolom penting ini!',
            'email.email' => 'Format email tampaknya salah, harap periksa kembali!',
            'email.unique' => 'Alamat email ini sudah terkait dengan sebuah akun!',
            'password.required' => 'Kolom password tidak boleh kosong!',
            'password.min' => 'Password Anda harus memiliki setidaknya 6 karakter!',
            'password.confirmed' => 'Konfirmasi password tidak cocok dengan password yang dimasukkan!',
            'pp.mimes' => 'Kami hanya mendukung file GIF, JPEG, JPG, atau PNG!',
            'pp.max' => 'Silakan unggah gambar dengan ukuran kurang dari 2 MB.',
        ];
    }
}
