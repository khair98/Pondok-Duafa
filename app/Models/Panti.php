<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panti extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function foto()
    {
        return $this->hasMany(FotoPanti::class, 'id_panti');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
?>
