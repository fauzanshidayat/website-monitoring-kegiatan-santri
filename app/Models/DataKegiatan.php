<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataKegiatan extends Model
{
    use HasFactory;

    protected $table = 'data_kegiatan';
    protected $fillable = [
        'kegiatan',
        'hari',
        'jam',
        'pengurus_id'
    ];

    public function pengurus()
    {
        return $this->belongsTo(Pengurus::class);
    }
    public function hafalan()
    {
        return $this->hasMany(Hafalan::class);
    }
}
