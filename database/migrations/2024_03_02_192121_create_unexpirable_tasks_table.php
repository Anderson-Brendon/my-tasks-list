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
        Schema::create('unexpirable_tasks', function (Blueprint $table) {
            $table->id('id_unexpirable_task');
            $table->timestamps();
            $table->date('completed_at')->nullable();
            $table->string('task_title');
            $table->string('task_description')->default('Task with no description');
            $table->boolean('is_completed')->default(false);
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
        Schema::dropIfExists('unexpirable_tasks');
    }
};
