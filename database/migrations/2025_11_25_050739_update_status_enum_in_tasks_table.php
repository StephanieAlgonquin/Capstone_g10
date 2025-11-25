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
        // First, update existing tasks to have a status
        \DB::statement("UPDATE tasks SET status = CASE 
            WHEN is_completed = 1 THEN 'completed'
            WHEN due_date IS NOT NULL AND due_date > NOW() THEN 'upcoming'
            ELSE 'pending'
        END WHERE status IS NULL OR status = ''");

        // Drop the old enum and create new one
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->enum('status', ['pending', 'draft', 'completed', 'upcoming'])->default('pending')->after('priority');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->enum('status', ['todo', 'in_progress', 'done'])->default('todo')->after('priority');
        });
    }
};
