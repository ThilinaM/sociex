<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', 'UsersApiController');

    // Faq Question
    Route::post('faq-questions/media', 'FaqQuestionApiController@storeMedia')->name('faq-questions.storeMedia');
    Route::apiResource('faq-questions', 'FaqQuestionApiController');

    // Sponsorship Tracking
    Route::post('sponsorship-trackings/media', 'SponsorshipTrackingApiController@storeMedia')->name('sponsorship-trackings.storeMedia');
    Route::apiResource('sponsorship-trackings', 'SponsorshipTrackingApiController');

    // Sponsorship Type
    Route::apiResource('sponsorship-types', 'SponsorshipTypeApiController');

    // Event Type
    Route::apiResource('event-types', 'EventTypeApiController');

    // Event
    Route::post('events/media', 'EventApiController@storeMedia')->name('events.storeMedia');
    Route::apiResource('events', 'EventApiController');

    // Event Registration
    Route::apiResource('event-registrations', 'EventRegistrationApiController');

    // Event Attendance
    Route::apiResource('event-attendances', 'EventAttendanceApiController');

    // Event Feedback
    Route::apiResource('event-feedbacks', 'EventFeedbackApiController');

    // Event Setting
    Route::apiResource('event-settings', 'EventSettingApiController');
});
