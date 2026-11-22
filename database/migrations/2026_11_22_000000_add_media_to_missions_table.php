<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Misi dinamis: admin bisa meng-upload gambar target AR (yang dipindai kamera),
     * lebar cetaknya, dan gambar sampul (thumbnail di aplikasi).
     */
    public function up(): void
    {
        Schema::table('missions', function (Blueprint $table) {
            $table->string('target_image_path')->nullable()->after('target_image_name');
            $table->decimal('target_width', 5, 2)->nullable()->after('target_image_path');
            $table->string('cover_image_path')->nullable()->after('target_width');
        });
    }

    public function down(): void
    {
        Schema::table('missions', function (Blueprint $table) {
            $table->dropColumn(['target_image_path', 'target_width', 'cover_image_path']);
        });
    }
};
