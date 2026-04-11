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
        Schema::create('email_requests', function (Blueprint $table) {
            $table->id();

            $table->string('nomor_tiket')->unique();

            // Relasi
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('opd_id')->constrained('opd')->cascadeOnDelete();

            // Data pemohonan
            $table->string('nama_lengkap');
            $table->string('nip');
            $table->string('jabatan');
            $table->string('no_hp');
            $table->string('email_pribadi')->nullable();

            // Data email
            $table->string('nama_email_diusulkan');
            $table->string('domain');

            // Detail permohonan
            $table->text('alasan_permohonan');
            $table->string('surat_permohonan');

            // Status workflow
            $table->enum('status', [
                'draft',
                'diajukan',
                'diverifikasi',
                'ditolak',
                'disetujui',
                'selesai'
            ])->default('draft');

            $table->text('catatan_admin')->nullable();

            // Diproses oleh admin
            $table->foreignId('diproses_oleh')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Waktu proses
            $table->timestamp('tanggal_verifikasi')->nullable();
            $table->timestamp('tanggal_selesai')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_requests');
    }
};
