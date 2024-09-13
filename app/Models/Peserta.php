<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'NIPP',
        'nama',
        'jenis_kelamin',
        'terminal_id',
        'jabatan',
        'user_id'
    ];

    public function terminal()
    {
        return $this->belongsTo(Terminal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function penilaianPesertaDetails()
    {
        return $this->hasMany(PenilaianPesertaDetail::class, 'peserta_id');
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
