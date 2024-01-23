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
            session()->flash('isNewAvatar', true);
        } else {
            session()->flash('isNewAvatar', false);

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
            'fullname.required' => 'Please enter your full name; we can\'t proceed without it!',
            'fullname.regex' => 'Only letters are allowed in the full name, no special characters!',
            'fullname.min' => 'Your full name must contain a minimum of 5 characters!',
            'username.required' => 'Kindly provide your chosen username, it\'s a required field!',
            'username.min' => 'Your username must be at least 5 characters long; a bit more creativity, please!',
            'username.max' => 'Username is too long (maximum is 39 characters). Username may only contain alphanumeric characters or single hyphens, and cannot begin or end with a hyphen.',
            'username.unique' => 'Oops! This username is already in use; please choose another one!',
            'username.regex' => 'Username may only contain alphanumeric characters or single hyphens, and cannot begin or end with a hyphen',
            'email.required' => 'An email address is required; please fill in this essential field!',
            'email.email' => 'The email format seems to be incorrect, please double-check!',
            'email.unique' => 'This email address is already associated with an account!',
            'password.required' => 'The password field cannot be left empty!',
            'password.min' => 'Your password must be at least 6 characters long!',
            'password.confirmed' => 'The password confirmation does not match the entered password!',
            'pp.mimes' => 'We only support GIF, JPEG, JPG, or PNG file!',
            'pp.max' => 'Please upload an image smaller than 2 MB.',
        ];
    }
}
