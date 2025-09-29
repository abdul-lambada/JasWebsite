<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimoni extends Model
{
    protected $primaryKey = 'TestimoniID';
    protected $fillable = [
        'ProyekID',
        'Nama',
        'Jabatan',
        'Isi',
        'Rating',
        'TanggalDiberikan'
    ];

    /**
     * Mendapatkan proyek yang diberi testimoni
     */
    public function proyek(): BelongsTo
    {
        return $this->belongsTo(Proyek::class, 'ProyekID', 'ProyekID');
    }
}
