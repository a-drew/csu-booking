<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest
{

    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'createBookingRequest';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'room_id' => ['required', 'integer'],

            'reservations' => ['required'],
            'reservations.*.start' => [ 'required', 'date'],
            'reservations.*.end' => ['required', 'date'],

            'onsite_contact.name' => ['required_with:onsite_contact.phone,onsite_contact.email','string', 'max:255'],
            'onsite_contact.phone' => ['required_with:onsite_contact.name,onsite_contact.email','string'],
            'onsite_contact.email' => ['required_with:onsite_contact.name,onsite_contact.phone','email'],

            'event.start' => [
                'required',
                'date_format:H:i',
                //'after_or_equal:reservations.0.start_time',
            ],
            'event.end' => [
                'required',
                'date_format:H:i',
                'after:event.start',
                //'before_or_equal:reservations.0.end_time',
            ],
            'event.title' => ['required','string', 'max:100'],
            'event.type' => ['required','string', 'max:50'],
            'event.description' => ['required','string', 'max:500'],
            'event.guest_speakers' => ['required','string', 'max:255'],
            'event.attendees' => ['required','numeric'],

            'event.fee' => ['string', 'max:50'],
            'event.music' => ['string', 'max:75'],
            'event.food.low_risk' => ['boolean'],
            'event.food.high_risk' => ['boolean'],
            'event.food.self_catered' => ['required_if:event.food.high_risk,true','boolean'],
            'event.food.caterer' => ['required_if:event.food.self_catered,false','string', 'max:100'],
            'event.alcohol' => ['boolean'],
            'event.children' => ['boolean'],
            'event.appliances' => ['boolean'],
            'event.av' => ['boolean'],
            'event.furniture' => ['boolean'],
            'event.bake_sale' => ['boolean'],
            'event.internal_meeting' => ['boolean'],

            'notes' => ['string', 'max:500'],
            'files' => [
                'required_if:event.food.high_risk,true',
                'required_if:event.alcohol,true',
                //'mimes:pdf,doc,docx',
                'max:50000', // 50Mb
            ],
        ];
    }
}
