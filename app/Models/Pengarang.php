<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengarang extends Model
{
    use HasFactory;
    protected $table = 'tb_pengarang';
    protected $fillable = [
        "nama_pengarang",
        "tahun_kelahiran"
    ];

}
