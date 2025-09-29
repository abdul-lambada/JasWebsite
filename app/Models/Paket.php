<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paket extends Model
{
    protected $primaryKey = 'PaketID';
    protected $fillable = [
        'NamaPaket',
        'Deskripsi',
        'HargaDasar',
        'EstimasiWaktu',
        'IsPopuler'
    ];

    /**
     * Mendapatkan semua pesanan untuk paket ini
     */
    public function pesanans(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'PaketID', 'PaketID');
    }
}
