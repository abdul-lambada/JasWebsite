<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proyek extends Model
{
    protected $primaryKey = 'ProyekID';
    protected $fillable = [
        'PesananID',
        'NamaProyek',
        'URLGambar',
        'URLWebsite'
    ];

    /**
     * Mendapatkan pesanan yang terkait dengan proyek
     */
    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'PesananID', 'PesananID');
    }

    /**
     * Mendapatkan semua tim yang mengerjakan proyek ini
     */
    public function tims(): BelongsToMany
    {
        return $this->belongsToMany(Tim::class, 'proyek_tim', 'ProyekID', 'TimID');
    }

    /**
     * Mendapatkan semua testimoni untuk proyek ini
     */
    public function testimonis(): HasMany
    {
        return $this->hasMany(Testimoni::class, 'ProyekID', 'ProyekID');
    }
}
