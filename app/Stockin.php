<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stockin extends Model
{
    protected $guarded = [];

    protected $table = 'stockins';
    protected $primaryKey = 'id_stockin';
    protected $fillable = ['id_barang','qty'];

    public function product()
    {
        return $this->belongsTo(Product::class,'id_barang');
    }
}
