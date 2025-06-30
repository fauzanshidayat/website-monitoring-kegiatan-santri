<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelanggaran extends Model
{
    use HasFactory;

    protected $table = 'pelanggaran';
    protected $fillable = [
        'santri_id',
        'data_pelanggaran_id',
        'keterangan',
        'tanggal_melanggar'
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function dataPelanggaran()
    {
        return $this->belongsTo(DataPelanggaran::class);
    }
}
