<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PerizinanPulang extends Model
{
    use HasFactory;

    protected $table = 'perizinan_pulang';
    protected $fillable = [
        'santri_id',
        'alasan',
        'tanggal_pulang',
        'tanggal_kembali',
        'status',
        'pengasuh_id'
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function pengasuh()
    {
        return $this->belongsTo(Pengasuh::class);
    }
}
