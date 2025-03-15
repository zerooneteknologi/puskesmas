<?php

use App\Models\Pasien;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /**
         * 1. ugd/emergency
         * 2. perawatan/room
         * 3. laoratorium/laboratory
         * 4. tindakan/action
         * 5. penunjang/suport
         * 6. alat/tools
         * 7. obat/medicine
         */
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pasien::class);
            $table->enum('note_category', [1, 2, 3, 4, 5, 6, 7]);
            $table->string('note_name');
            $table->integer('note_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
