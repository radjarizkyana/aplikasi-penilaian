<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    use HasFactory;

    protected $fillable = [
        'NIPP', 'nama', 'perusahaan', 'jabatan', 'email', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function penilaianPeserta()
    {
        return $this->hasMany(PenilaianPeserta::class, 'penilaian_id');
    }

    public function penilaianPesertaDetails()
    {
        return $this->hasMany(PenilaianPesertaDetail::class, 'penilaian_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($peserta) {
            if ($peserta->user) {
                $peserta->user->delete();
            }
        });
    }
}
