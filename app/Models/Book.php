<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'tb_buku';
    protected $fillable = [
        "path_buku",
        "judul_buku",
        "tahun_terbit",
        "isbn",
        "id_pengarang",
        "id_kategori"
    ];
}
