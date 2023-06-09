<?php

Route::get('/', 'HomecontrollerController@index');
Route::post('/file', 'HomecontrollerController@store');
Route::get('/file', 'HomecontrollerController@index');
Route::post('/feedback', 'HomecontrollerController@feedbackstore');
Route::get('/feedback', 'HomecontrollerController@feedback');

Route::resource('attend', 'HomecontrollerController');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::post('faq-questions/media', 'FaqQuestionController@storeMedia')->name('faq-questions.storeMedia');
    Route::post('faq-questions/ckmedia', 'FaqQuestionController@storeCKEditorImages')->name('faq-questions.storeCKEditorImages');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Sponsorship Tracking
    Route::delete('sponsorship-trackings/destroy', 'SponsorshipTrackingController@massDestroy')->name('sponsorship-trackings.massDestroy');
    Route::post('sponsorship-trackings/media', 'SponsorshipTrackingController@storeMedia')->name('sponsorship-trackings.storeMedia');
    Route::post('sponsorship-trackings/ckmedia', 'SponsorshipTrackingController@storeCKEditorImages')->name('sponsorship-trackings.storeCKEditorImages');
    Route::resource('sponsorship-trackings', 'SponsorshipTrackingController');

    // Sponsorship Type
    Route::delete('sponsorship-types/destroy', 'SponsorshipTypeController@massDestroy')->name('sponsorship-types.massDestroy');
    Route::resource('sponsorship-types', 'SponsorshipTypeController');

    // Event Type
    Route::delete('event-types/destroy', 'EventTypeController@massDestroy')->name('event-types.massDestroy');
    Route::resource('event-types', 'EventTypeController');

    // Event
    Route::delete('events/destroy', 'EventController@massDestroy')->name('events.massDestroy');
    Route::post('events/media', 'EventController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::resource('events', 'EventController');

    // Event Registration
    Route::delete('event-registrations/destroy', 'EventRegistrationController@massDestroy')->name('event-registrations.massDestroy');
    Route::resource('event-registrations', 'EventRegistrationController');

    // Event Attendance
    Route::delete('event-attendances/destroy', 'EventAttendanceController@massDestroy')->name('event-attendances.massDestroy');
    Route::resource('event-attendances', 'EventAttendanceController');

    // Event Feedback
    Route::delete('event-feedbacks/destroy', 'EventFeedbackController@massDestroy')->name('event-feedbacks.massDestroy');
    Route::resource('event-feedbacks', 'EventFeedbackController');

    // Event Setting
    Route::delete('event-settings/destroy', 'EventSettingController@massDestroy')->name('event-settings.massDestroy');
    Route::resource('event-settings', 'EventSettingController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::post('faq-questions/media', 'FaqQuestionController@storeMedia')->name('faq-questions.storeMedia');
    Route::post('faq-questions/ckmedia', 'FaqQuestionController@storeCKEditorImages')->name('faq-questions.storeCKEditorImages');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Sponsorship Tracking
    Route::delete('sponsorship-trackings/destroy', 'SponsorshipTrackingController@massDestroy')->name('sponsorship-trackings.massDestroy');
    Route::post('sponsorship-trackings/media', 'SponsorshipTrackingController@storeMedia')->name('sponsorship-trackings.storeMedia');
    Route::post('sponsorship-trackings/ckmedia', 'SponsorshipTrackingController@storeCKEditorImages')->name('sponsorship-trackings.storeCKEditorImages');
    Route::resource('sponsorship-trackings', 'SponsorshipTrackingController');

    // Sponsorship Type
    Route::delete('sponsorship-types/destroy', 'SponsorshipTypeController@massDestroy')->name('sponsorship-types.massDestroy');
    Route::resource('sponsorship-types', 'SponsorshipTypeController');

    // Event Type
    Route::delete('event-types/destroy', 'EventTypeController@massDestroy')->name('event-types.massDestroy');
    Route::resource('event-types', 'EventTypeController');

    // Event
    Route::delete('events/destroy', 'EventController@massDestroy')->name('events.massDestroy');
    Route::post('events/media', 'EventController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::resource('events', 'EventController');

    // Event Registration
    Route::delete('event-registrations/destroy', 'EventRegistrationController@massDestroy')->name('event-registrations.massDestroy');
    Route::resource('event-registrations', 'EventRegistrationController');

    // Event Attendance
    Route::delete('event-attendances/destroy', 'EventAttendanceController@massDestroy')->name('event-attendances.massDestroy');
    Route::resource('event-attendances', 'EventAttendanceController');

    // Event Feedback
    Route::delete('event-feedbacks/destroy', 'EventFeedbackController@massDestroy')->name('event-feedbacks.massDestroy');
    Route::resource('event-feedbacks', 'EventFeedbackController');

    // Event Setting
    Route::delete('event-settings/destroy', 'EventSettingController@massDestroy')->name('event-settings.massDestroy');
    Route::resource('event-settings', 'EventSettingController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
