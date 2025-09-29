<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArtikelBlog extends Model
{
    protected $primaryKey = 'ArtikelID';
    protected $fillable = [
        'PenulisID',
        'Judul',
        'Konten',
        'TanggalPublikasi'
    ];

    /**
     * Mendapatkan penulis artikel
     */
    public function penulis(): BelongsTo
    {
        return $this->belongsTo(Tim::class, 'PenulisID', 'TimID');
    }
}
