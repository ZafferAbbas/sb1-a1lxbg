<?php

namespace App\Http\Requests;

use App\Models\Booking;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'service_id' => ['required', 'exists:services,id'],
            'booking_time' => ['required', 'date', 'after:now'],
            'notes' => ['nullable', 'string'],
        ];

        if ($this->isMethod('PATCH') || $this->isMethod('PUT')) {
            $rules['status'] = ['required', Rule::in([
                Booking::STATUS_PENDING,
                Booking::STATUS_CONFIRMED,
                Booking::STATUS_CANCELLED,
                Booking::STATUS_COMPLETED,
            ])];
        }

        return $rules;
    }
}