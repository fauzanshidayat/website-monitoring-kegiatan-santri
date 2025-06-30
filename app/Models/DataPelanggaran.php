<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataPelanggaran extends Model
{
    use HasFactory;

    protected $table = 'data_pelanggaran';
    protected $fillable = [
        'pelanggaran',
        'jenis_pelanggaran',
        'hukuman',
        'pengasuh_id'
    ];

    public function pengasuh()
    {
        return $this->belongsTo(Pengasuh::class);
    }
    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class);
    }
}
