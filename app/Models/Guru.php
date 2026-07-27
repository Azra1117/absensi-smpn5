<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable = [

        'nip',

        'nama',

        'mapel',

        'jenis_kelamin',

        'no_hp',

        'alamat'

    ];
}