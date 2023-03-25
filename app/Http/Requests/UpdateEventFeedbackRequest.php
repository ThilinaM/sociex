<?php

namespace App\Http\Requests;

use App\Models\EventFeedback;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventFeedbackRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_feedback_edit');
    }

    public function rules()
    {
        return [];
    }
}
