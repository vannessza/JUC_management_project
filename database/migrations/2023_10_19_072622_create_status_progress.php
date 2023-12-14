<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('status_progress', function (Blueprint $table) {
            $table->id();
            $table->string("status_progress");
            $table->timestamps();
        });

        DB::table('status_progress')->insert([
            ['status_progress' => 'New'],
            ['status_progress' => 'Progress'],
            ['status_progress' => 'Completed']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_progress');
    }
};
