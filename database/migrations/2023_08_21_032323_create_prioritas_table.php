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
        Schema::create('prioritas', function (Blueprint $table) {
            $table->id();
            $table->string("prioritas");
            $table->timestamps();
        });

        DB::table('prioritas')->insert([
            ['prioritas' => 'High'],
            ['prioritas' => 'Medium'],
            ['prioritas' => 'Low'],
            ['prioritas' => 'Pending']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prioritas');
    }
};
