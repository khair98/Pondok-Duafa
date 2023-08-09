<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggalangan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function panti()
    {
        return $this->belongsTo(Panti::class, 'id_panti');
    }
    public function donasi()
    {
        return $this->hasMany(Donasi::class, 'id_penggalangan')->where('donasis.verif', 2);
    }
    public function user()
    {
        return $this->hasManyThrough(Panti::class, User::class, 'id', 'id');
    }
    public function berita()
    {
        return $this->hasMany(Berita::class, 'id_penggalangan');
    }
    public function penarikan()
    {
        return $this->hasMany(PenarikanDana::class, 'id_penggalangan')->where('penarikan_danas.status', 2);
    }

}
?>
