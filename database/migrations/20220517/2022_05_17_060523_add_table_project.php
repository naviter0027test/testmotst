<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Project', function (Blueprint $table) {
            $table->id();
            $table->string('title')
                ->nullable()
                ->comment('標題');
            $table->mediumText('requirement')
                ->nullable()
                ->comment('需求');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Project');
    }
}
