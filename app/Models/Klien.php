<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Klien extends Model
{
    protected $primaryKey = 'KlienID';
    protected $fillable = [
        'Nama',
        'Email',
        'NoTelepon',
        'JenisKlien',
        'TanggalRegistrasi'
    ];

    /**
     * Mendapatkan semua pesanan dari klien
     */
    public function pesanans(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'KlienID', 'KlienID');
    }

    /**
     * Mendapatkan semua testimoni dari klien
     */
    public function testimonis(): HasMany
    {
        return $this->hasMany(Testimoni::class, 'KlienID', 'KlienID');
    }
}
