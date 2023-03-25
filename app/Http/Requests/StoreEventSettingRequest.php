<?php

namespace App\Http\Requests;

use App\Models\EventSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEventSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_setting_create');
    }

    public function rules()
    {
        return [
            'event_remind_sms' => [
                'string',
                'nullable',
            ],
            'event_attend_form_filling_message' => [
                'string',
                'nullable',
            ],
            'event_attend_thank_message' => [
                'string',
                'nullable',
            ],
        ];
    }
}
