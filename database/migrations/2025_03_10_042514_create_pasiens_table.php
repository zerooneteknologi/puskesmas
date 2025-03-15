<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('pasien_nomor')->unique();
            $table->string('pasien_name');
            $table->integer('pasien_age');
            $table->text('pasien_address');
            $table->enum('pasien_status', [1, 2]); //1. umum 2. BPJS
            $table->date('pasien_in');
            $table->date('pasien_out')->nullable();
            $table->integer('pasien_sum')->nullable();
            $table->string('pasien_room')->nullable();
            $table->string('pasien_diagnoses')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
