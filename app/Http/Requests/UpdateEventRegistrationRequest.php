<?php

namespace App\Http\Requests;

use App\Models\EventRegistration;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventRegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_registration_edit');
    }

    public function rules()
    {
        return [
            'first_name' => [
                'string',
                'required',
            ],
            'last_name' => [
                'string',
                'required',
            ],
            'email' => [
                'string',
                'nullable',
            ],
            'mobile' => [
                'string',
                'nullable',
            ],
            'whatsup' => [
                'string',
                'nullable',
            ],
        ];
    }
}
