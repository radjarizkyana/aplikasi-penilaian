<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianPeserta extends Model
{
    use HasFactory;

    protected $fillable = ['pelatihan_id', 'bulan_penilaian', 'tahun_penilaian', 'tanggal_penilaian', 'pengajar_id'];

    public function pengajar()
    {
        return $this->belongsTo(Pengajar::class, 'pengajar_id');
    }

    public function penilaianDetails()
    {
        return $this->hasMany(PenilaianPesertaDetail::class, 'penilaian_id');
    }

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class, 'pelatihan_id');
    }

}
