<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengurus extends Model
{
    use HasFactory;

    protected $table = 'pengurus';
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

    public function dataKegiatan()
    {
        return $this->hasMany(DataKegiatan::class);
    }
}
