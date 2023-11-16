<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'tb_transaksi';
    protected $fillable = [
        "id_buku",
        "id_peminjam",
        "tanggal_peminjaman",
        "tanggal_pengembalian"
    ];

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Book::class, "id_buku");
    }

    public function peminjam(): BelongsTo
    {
        return $this->belongsTo(Peminjam::class, "id_peminjam");
    }}
