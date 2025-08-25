<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
   public function rules(): array
{
    return [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $this->user()->id],
        'username' => ['required', 'string', 'max:30', 'unique:users,username,' . $this->user()->id],
        'bio' => ['nullable', 'string', 'max:1000'],
        'profile_photo' => ['nullable', 'image', 'max:2048'],
        'cover_photo' => ['nullable', 'image', 'max:4096'],
    ];
}

}
