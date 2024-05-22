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
        Schema::create('random_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_system_task_id')->constrained('users_system_tasks');
            $table->boolean('is_complete')->default(false);
            $table->integer('rerandom_count')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('random_tasks');
    }
};