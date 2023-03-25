<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSponsorshipTrackingsTable extends Migration
{
    public function up()
    {
        Schema::table('sponsorship_trackings', function (Blueprint $table) {
            $table->unsignedBigInteger('sponsorship_type_id')->nullable();
            $table->foreign('sponsorship_type_id', 'sponsorship_type_fk_8232896')->references('id')->on('sponsorship_types');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_8232857')->references('id')->on('users');
        });
    }
}
