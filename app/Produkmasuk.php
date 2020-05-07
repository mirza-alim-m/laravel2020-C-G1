<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produkmasuk extends Model
{
    protected $guarded = [];

    protected $table = 'produkmasuks';
    protected $primaryKey = 'id_masuk';
    protected $fillable = ['id_buku','qty'];

    public function databuku()
    {
        return $this->belongsTo(Databuku::class,'id_buku');
    }
}
