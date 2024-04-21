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
        Schema::create('daily_tasks', function (Blueprint $table) {
            $table->id('id_daily_task');
            $table->timestamps();
            $table->date('last_completed')->nullable();
            $table->string('task_title');
            $table->integer('number_of_completions')->default(0);
            $table->string('task_description')->default('Task with no description');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_task_level');
            $table->foreign('id_user')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('id_task_level')->references('id_task_level')->on('task_levels')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_tasks');
    }
};
