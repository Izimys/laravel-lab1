<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class BookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Дозволяємо всім відправляти форму
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'message' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Будь ласка, вкажіть ваше ім\'я.',
            'email.required' => 'Будь ласка, вкажіть email для зв\'язку.',
            'email.email' => 'Некоректний формат електронної пошти.',
            'message.required' => 'Напишіть ваші побажання або дати заїзду.',
        ];
    }
}
