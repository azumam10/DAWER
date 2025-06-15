<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim', 20);
            $table->unsignedBigInteger('fakultas_id'); // ✅ WAJIB seperti ini
            $table->year('tahun_lulus');
            $table->string('pekerjaan')->nullable();
            $table->string('email')->nullable();
            $table->string('no_telepon', 15)->nullable();
            $table->text('alamat')->nullable();
            $table->string('status_pekerjaan');
            $table->timestamps();

            // Foreign key harus sesuai
            $table->foreign('fakultas_id')
                ->references('id')
                ->on('fakultas')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};