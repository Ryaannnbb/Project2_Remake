<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function author(): BelongsTo  // return type data
    {
        return $this->belongsTo(Pengarang::class, "id_pengarang");
    }

    public function kategori(): BelongsTo // return type data
    {
        return $this->belongsTo(Kategori::class, "id_kategori");
    }

}
