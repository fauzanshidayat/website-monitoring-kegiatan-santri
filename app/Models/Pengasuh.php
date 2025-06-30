<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengasuh extends Model
{
    use HasFactory;

    protected $table = 'pengasuh';
    protected $fillable = [
        'user_id',
        'photo',
        'nama_lengkap',
        'nip',
        'jenis_kelamin',
        'tanggal_lahir',
        'telepon'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dataPelanggaran()
    {
        return $this->hasMany(DataPelanggaran::class);
    }

    public function perizinanDisetujui()
    {
        return $this->hasMany(PerizinanPulang::class);
    }
}
