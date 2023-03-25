<?php

namespace App\Http\Controllers;

use App\Models\TrackController;
use Illuminate\Http\Request;

class TrackControllerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('welcome');

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
        // $this->sendMessages($session,'HCPLibrary','Thank you for giving in the details Stay Safe.',array($userDetail->mobile),1); // 1 for promotional messages, 0 for normal message 
        return view('response');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TrackController  $trackController
     * @return \Illuminate\Http\Response
     */
    public function show(TrackController $trackController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TrackController  $trackController
     * @return \Illuminate\Http\Response
     */
    public function edit(TrackController $trackController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TrackController  $trackController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrackController $trackController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TrackController  $trackController
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrackController $trackController)
    {
        //
    }
}
