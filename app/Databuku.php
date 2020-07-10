<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Databuku extends Model
{
    protected $guarded = [];

    protected $table = 'databukus';
    protected $primaryKey = 'id_buku';
    protected $fillable = ['id_kategori','cover','nama_barang','harga','qty','doc_pdf'];


    public function category()
    {
        return $this->belongsTo(Category::class,'id_kategori');
    }

    public function produkmasuk()
    {
        return $this->hasMany(Produkmasuk::class, 'id_buku');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_buku');
    }

}
