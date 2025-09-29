<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimoni extends Model
{
    protected $primaryKey = 'TestimoniID';
    protected $fillable = [
        'KlienID',
        'ProyekID',
        'IsiTestimoni',
        'TanggalDiberikan'
    ];

    /**
     * Mendapatkan klien yang memberikan testimoni
     */
    public function klien(): BelongsTo
    {
        return $this->belongsTo(Klien::class, 'KlienID', 'KlienID');
    }

    /**
     * Mendapatkan proyek yang diberi testimoni
     */
    public function proyek(): BelongsTo
    {
        return $this->belongsTo(Proyek::class, 'ProyekID', 'ProyekID');
    }
}
