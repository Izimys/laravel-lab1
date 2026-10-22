<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'room_number' => ['required', 'string', 'max:10'],
            'type' => ['required', 'string', 'max:50'],
            'price' => ['required', 'integer', 'min:0'],
            'capacity' => ['required', 'integer', 'min:1'],
            'is_available' => ['boolean'],
        ];
    }
}
