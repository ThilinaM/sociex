<?php

namespace App\Http\Requests;

use App\Models\SponsorshipType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySponsorshipTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sponsorship_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sponsorship_types,id',
        ];
    }
}
