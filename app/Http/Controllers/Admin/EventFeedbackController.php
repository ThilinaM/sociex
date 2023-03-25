<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventFeedbackRequest;
use App\Http\Requests\StoreEventFeedbackRequest;
use App\Http\Requests\UpdateEventFeedbackRequest;
use App\Models\Event;
use App\Models\EventFeedback;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EventFeedbackController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('event_feedback_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EventFeedback::with(['event', 'created_by'])->select(sprintf('%s.*', (new EventFeedback)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'event_feedback_show';
                $editGate      = 'event_feedback_edit';
                $deleteGate    = 'event_feedback_delete';
                $crudRoutePart = 'event-feedbacks';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('event_title', function ($row) {
                return $row->event ? $row->event->title : '';
            });

            $table->editColumn('feedback', function ($row) {
                return $row->feedback ? $row->feedback : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'event']);

            return $table->make(true);
        }

        return view('admin.eventFeedbacks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('event_feedback_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.eventFeedbacks.create', compact('events'));
    }

    public function store(StoreEventFeedbackRequest $request)
    {
        $eventFeedback = EventFeedback::create($request->all());

        return redirect()->route('admin.event-feedbacks.index');
    }

    public function edit(EventFeedback $eventFeedback)
    {
        abort_if(Gate::denies('event_feedback_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eventFeedback->load('event', 'created_by');

        return view('admin.eventFeedbacks.edit', compact('eventFeedback', 'events'));
    }

    public function update(UpdateEventFeedbackRequest $request, EventFeedback $eventFeedback)
    {
        $eventFeedback->update($request->all());

        return redirect()->route('admin.event-feedbacks.index');
    }

    public function show(EventFeedback $eventFeedback)
    {
        abort_if(Gate::denies('event_feedback_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventFeedback->load('event', 'created_by');

        return view('admin.eventFeedbacks.show', compact('eventFeedback'));
    }

    public function destroy(EventFeedback $eventFeedback)
    {
        abort_if(Gate::denies('event_feedback_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventFeedback->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventFeedbackRequest $request)
    {
        $eventFeedbacks = EventFeedback::find(request('ids'));

        foreach ($eventFeedbacks as $eventFeedback) {
            $eventFeedback->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
