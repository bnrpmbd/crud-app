<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'email'];

    public function matakuliahs()
    {
        return $this->hasMany(Matakuliah::class);
    }
}
