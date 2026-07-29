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
    Schema::create('absensis', function (Blueprint $table) {

        $table->id();

        $table->date('tanggal');

        $table->enum('shift', [
            'Pagi',
            'Siang'
        ]);

        $table->foreignId('kelas_id')
              ->constrained('kelas')
              ->cascadeOnUpdate()
              ->restrictOnDelete();

        $table->foreignId('siswa_id')
              ->constrained('siswas')
              ->cascadeOnUpdate()
              ->cascadeOnDelete();

        $table->enum('status', [
            'Sakit',
            'Izin',
            'Alpha'
        ]);

        $table->foreignId('user_id')
              ->constrained('users')
              ->cascadeOnUpdate()
              ->restrictOnDelete();

        $table->timestamps();

        $table->unique([
            'tanggal',
            'shift',
            'siswa_id'
        ]);
    });
}
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
