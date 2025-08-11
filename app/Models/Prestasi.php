<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';
    protected $fillable = [
        'santri_id',
        'jenis_prestasi',
        'nama_prestasi',
        'tingkat',
        'keterangan',
        'tanggal_prestasi'
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }
}
