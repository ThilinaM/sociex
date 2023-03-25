<?php

namespace App\Http\Requests;

use App\Models\SponsorshipType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSponsorshipTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sponsorship_type_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
