<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pertemuans', function (Blueprint $table) {
            $table->text('materi')->nullable()->after('pembahasan');
            $table->string('video_url')->nullable()->after('materi');
        });
    }

    public function down(): void
    {
        Schema::table('pertemuans', function (Blueprint $table) {
            $table->dropColumn(['materi', 'video_url']);
        });
    }
};
