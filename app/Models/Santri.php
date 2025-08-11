<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Santri extends Model
{
    use HasFactory;

    protected $table = 'santri';
    protected $fillable = [
        'user_id',
        'photo',
        'nama_lengkap',
        'nis',
        'nisn',
        'kelas_id',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'wali_santri',
        'no_hp_wali_santri'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function hafalan()
    {
        return $this->hasMany(Hafalan::class);
    }
    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class);
    }

    public function perizinanPulang()
    {
        return $this->hasMany(PerizinanPulang::class);
    }
}
