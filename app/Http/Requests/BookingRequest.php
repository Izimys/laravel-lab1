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
            'room_type' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'check_in' => ['required', 'date', 'after_or_equal:today'],
            'check_out' => ['required', 'date', 'after:check_in'],
            'message' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'room_type.required' => 'Будь ласка, оберіть категорію номера.',
            'name.required' => 'Будь ласка, вкажіть ваше ім\'я.',
            'email.required' => 'Будь ласка, вкажіть email для зв\'язку.',
            'email.email' => 'Некоректний формат електронної пошти.',
            'check_in.required' => 'Будь ласка, оберіть дату заїзду.',
            'check_in.date' => 'Неправильний формат дати.',
            'check_in.after_or_equal' => 'Дата заїзду не може бути у минулому.',
            'check_out.required' => 'Будь ласка, оберіть дату виїзду.',
            'check_out.date' => 'Неправильний формат дати.',
            'check_out.after' => 'Дата виїзду повинна бути пізніше за дату заїзду.',
            'message.required' => 'Напишіть ваші побажання або кількість осіб.',
        ];
    }
}
