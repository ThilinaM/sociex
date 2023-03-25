<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventFeedbacksTable extends Migration
{
    public function up()
    {
        Schema::create('event_feedbacks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('feedback')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
