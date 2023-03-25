<?php

namespace App\Http\Requests;

use App\Models\SponsorshipTracking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSponsorshipTrackingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sponsorship_tracking_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
