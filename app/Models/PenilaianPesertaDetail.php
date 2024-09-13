<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianPesertaDetail extends Model
{
    use HasFactory;

    protected $fillable = ['penilaian_id', 'peserta_id', 'nilai_pretest', 'nilai_posttest'];

    public function penilaianPeserta()
    {
        return $this->belongsTo(PenilaianPeserta::class, 'penilaian_id');
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'peserta_id');
    }

    public function pengajar()
    {
        return $this->hasOneThrough(Pengajar::class, PenilaianPeserta::class, 'id', 'id', 'penilaian_id', 'pengajar_id');
    }
    
    
    
}
