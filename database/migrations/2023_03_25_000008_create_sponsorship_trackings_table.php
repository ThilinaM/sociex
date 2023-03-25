<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorshipTrackingsTable extends Migration
{
    public function up()
    {
        Schema::create('sponsorship_trackings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('display_status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
