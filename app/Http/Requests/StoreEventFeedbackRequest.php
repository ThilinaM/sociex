<?php

namespace App\Http\Requests;

use App\Models\EventFeedback;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEventFeedbackRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_feedback_create');
    }

    public function rules()
    {
        return [];
    }
}
