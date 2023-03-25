<?php

namespace App\Http\Controllers;

use App\Models\homecontroller;
use Illuminate\Http\Request;
use App\Models\EventAttendance;
use App\Models\Event;
use App\Models\EventFeedback;
use Textit;

class HomecontrollerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('welcome', compact('events'));
        
    }

    public function feedback()
    {
        //
        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('feedback', compact('events'));
        
    }

    public function feedbackstore(Request $request)
    {
        //
        $eventFeedback = EventFeedback::create($request->all());
        
        return view('response');
        // return redirect()->route('HomecontrollerController.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $eventAttendance = EventAttendance::create($request->all());
        Textit::sms($request->mobile, 'Thank You for attend the Digital Innovation & Entrepreneurship Forum By CSH'); // using facade
        return view('response');
        // return redirect()->route('HomecontrollerController.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\homecontroller  $homecontroller
     * @return \Illuminate\Http\Response
     */
    public function show(homecontroller $homecontroller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\homecontroller  $homecontroller
     * @return \Illuminate\Http\Response
     */
    public function edit(homecontroller $homecontroller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\homecontroller  $homecontroller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, homecontroller $homecontroller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\homecontroller  $homecontroller
     * @return \Illuminate\Http\Response
     */
    public function destroy(homecontroller $homecontroller)
    {
        //
    }
}
