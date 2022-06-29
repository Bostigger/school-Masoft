<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_marks', function (Blueprint $table) {
            $table->id();
            $table->String('grade_name');
            $table->String('grade_point');
            $table->String('start_marks');
            $table->String('end_marks');
            $table->String('start_point');
            $table->String('end_point');
            $table->String('remarks');
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
        Schema::dropIfExists('grade_marks');
    }
};
