<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hafalan extends Model
{
    use HasFactory;

    protected $table = 'hafalan';
    protected $fillable = [
        'santri_id',
        'data_kegiatan_id',
        'jenis_hafalan',
        'nama_kitab_surah',
        'bab_juz',
        'progres_belajar',
        'keterangan',
        'tanggal_menghafal'
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function dataKegiatan()
    {
        return $this->belongsTo(DataKegiatan::class);
    }
}
