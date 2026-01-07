<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Update kuis table
        Schema::table('kuis', function (Blueprint $table) {
            $table->foreignId('pertemuan_id')->nullable()->after('mapel_id')->constrained('pertemuans')->onDelete('set null');
            $table->integer('kkm')->default(75)->after('status');
            $table->integer('durasi_menit')->default(60)->after('kkm'); // Optional: Duration
        });

        // Create soals table
        Schema::create('soals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kuis_id')->constrained('kuis')->onDelete('cascade');
            $table->text('pertanyaan');
            $table->string('opsi_a');
            $table->string('opsi_b');
            $table->string('opsi_c');
            $table->string('opsi_d');
            $table->char('jawaban', 1); // 'a', 'b', 'c', 'd'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('soals');
        
        Schema::table('kuis', function (Blueprint $table) {
            $table->dropForeign(['pertemuan_id']);
            $table->dropColumn(['pertemuan_id', 'kkm', 'durasi_menit']);
        });
    }
};
