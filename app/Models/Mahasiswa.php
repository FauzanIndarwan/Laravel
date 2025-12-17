<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'nama',
        'nim',
        'email',
        'foto'
    ];

    public function proyek()
    {
        return $this->hasOne(Proyek::class);
    }
}
