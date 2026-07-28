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
        Schema::table('scores', function (Blueprint $table) {
            $table->integer('attendence')->default(0);
            $table->integer('assigment')->default(0);
            $table->integer('mid_exam')->default(0);
            $table->integer('final_exam')->default(0);
        });

        Schema::table('students', function (Blueprint $table) {
            $table->boolean('prediction')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->dropColumn('attendence');
            $table->dropColumn('assigment');
            $table->dropColumn('mid_exam');
            $table->dropColumn('final_exam');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('prediction');
        });
    }
};
