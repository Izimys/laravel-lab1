<?php
namespace App\Http\Controllers;
use App\Http\Requests\BookingRequest;
class BookingController extends Controller
{
    public function showForm()
    {
        $roomTypes = ['Стандартний', 'Напівлюкс', 'Люкс', 'Президентський'];
        return view('booking.form', compact('roomTypes'));
    }

    public function processForm(BookingRequest $request)
    {
        return view('booking.confirm', $request->validated());
    }
}
