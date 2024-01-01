<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Dokter extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $table = 'dokter';

    protected $fillable = [
        'nama', 'alamat', 'no_hp', 'id_poli', 'password'
    ];

    public function poli(): BelongsTo
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    public function jadwal(): HasMany
    {
        return $this->hasMany(JadwalPeriksa::class, 'id_dokter');
    }

    public function daftarPoli(): HasManyThrough
    {
        return $this->hasManyThrough(
            DaftarPoli::class,
            JadwalPeriksa::class,
            'id_dokter',
            'id_jadwal',
            'id',
            'id'
        );
    }
}
