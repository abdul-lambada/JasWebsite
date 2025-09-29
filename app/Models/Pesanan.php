<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pesanan extends Model
{
    protected $primaryKey = 'PesananID';
    protected $fillable = [
        'KlienID',
        'PaketID',
        'TanggalPesanan',
        'Status'
    ];

    /**
     * Mendapatkan klien yang membuat pesanan
     */
    public function klien(): BelongsTo
    {
        return $this->belongsTo(Klien::class, 'KlienID', 'KlienID');
    }

    /**
     * Mendapatkan paket yang dipesan
     */
    public function paket(): BelongsTo
    {
        return $this->belongsTo(Paket::class, 'PaketID', 'PaketID');
    }

    /**
     * Mendapatkan proyek dari pesanan ini
     */
    public function proyek(): HasOne
    {
        return $this->hasOne(Proyek::class, 'PesananID', 'PesananID');
    }
}
