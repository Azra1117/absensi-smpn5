<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = [
        'tanggal',
        'shift',
        'kelas_id',
        'siswa_id',
        'status',
        'user_id',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
