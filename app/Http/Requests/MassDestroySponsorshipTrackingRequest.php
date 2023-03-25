<?php

namespace App\Http\Requests;

use App\Models\SponsorshipTracking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySponsorshipTrackingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sponsorship_tracking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sponsorship_trackings,id',
        ];
    }
}
