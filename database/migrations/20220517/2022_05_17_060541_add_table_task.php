<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableTask extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Task', function (Blueprint $table) {
            $table->id();
            $table->string('name')
                ->nullable()
                ->comment('任務名稱');
            $table->integer('projectId')
                ->default(0)
                ->comment('對應Project.id');
            $table->integer('owner')
                ->default(0)
                ->comment('擁有者');
            $table->date('start')
                ->nullable()
                ->comment('任務開始日期');
            $table->date('end')
                ->nullable()
                ->comment('任務結束日期');
            $table->integer('hours')
                ->default(0)
                ->comment('耗費時數');
            $table->integer('minutes')
                ->default(0)
                ->comment('耗費分鐘數');
            $table->mediumText('desc')
                ->nullable()
                ->comment('描述');
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
        Schema::dropIfExists('Task');
    }
}
