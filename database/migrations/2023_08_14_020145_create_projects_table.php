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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('nama_project');
            $table->string('detail_project');
            $table->unsignedBigInteger('vendor_id');
            $table->string('platform');
            $table->unsignedBigInteger('prioritas_id');
            $table->string('pic');
            $table->string('target');
            $table->unsignedBigInteger('status_progress_id');
            $table->unsignedBigInteger('status_id')->nullable();
            // $table->unsignedBigInteger('owner_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
