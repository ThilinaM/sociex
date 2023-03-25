<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('event_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('event_reminder_sms')->default(0)->nullable();
            $table->string('event_remind_sms')->nullable();
            $table->boolean('event_attend_form_sms')->default(0)->nullable();
            $table->string('event_attend_form_filling_message')->nullable();
            $table->boolean('event_attend_thank_sms')->default(0)->nullable();
            $table->string('event_attend_thank_message')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
