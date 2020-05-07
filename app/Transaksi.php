<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = [];

    protected $table = 'transaksis';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = ['id_buku','nama_pembeli','qty','email'];

    public function databuku()
    {
        return $this->belongsTo(Databuku::class,'id_buku');
    }
}
