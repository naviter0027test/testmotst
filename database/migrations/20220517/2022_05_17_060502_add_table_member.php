<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Member', function (Blueprint $table) {
            $table->id();
            $table->string('account')
                ->nullable()
                ->comment('帳號');
            $table->string('pass')
                ->nullable()
                ->comment('密碼');
            $table->string('name')
                ->nullable()
                ->comment('名稱');
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
        Schema::dropIfExists('Member');
    }
}
