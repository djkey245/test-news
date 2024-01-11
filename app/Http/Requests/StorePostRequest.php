<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
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
            '*.title' => ['required', 'min:7'],
            '*.description' => ['required', 'min:7'],
            '*.content' => ['nullable'],
            '*.language' => [Rule::exists('languages', 'prefix'), 'required', 'distinct'],
        ];
    }
}
