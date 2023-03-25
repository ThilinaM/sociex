<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSponsorshipTypesTable extends Migration
{
    public function up()
    {
        Schema::table('sponsorship_types', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_8232889')->references('id')->on('users');
        });
    }
}
