<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function penggalangan()
    {
        return $this->hasOne(Penggalangan::class, 'id');
    }

}
?>
