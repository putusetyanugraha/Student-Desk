<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function(Blueprint $table){
            $table->id(); // id, integer, primary_key, auto_increment
            $table->string('name'); // string isinya sama seperti varchar
            $table->string('nim', 12); 
            $table->timestamps(); 
        });

        Schema::create('courses', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->timestamps();
        });

        Schema::create('scores', function(Blueprint $table){
            $table->id();
            $table->foreignId('student_id');
            $table->foreignId('course_id');
            $table->integer('score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('scores');
    }
};
