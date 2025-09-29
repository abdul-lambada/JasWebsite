<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tim extends Model
{
    protected $primaryKey = 'TimID';
    protected $fillable = [
        'Nama',
        'Jabatan',
        'URLFoto',
        'LinkLinkedin',
        'Keahlian'
    ];

    /**
     * Mendapatkan semua proyek yang dikerjakan oleh tim ini
     */
    public function proyeks(): BelongsToMany
    {
        return $this->belongsToMany(Proyek::class, 'proyek_tim', 'TimID', 'ProyekID');
    }

    /**
     * Mendapatkan semua artikel yang ditulis oleh anggota tim
     */
    public function artikelBlogs(): HasMany
    {
        return $this->hasMany(ArtikelBlog::class, 'PenulisID', 'TimID');
    }
}
