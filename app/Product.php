<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    protected $table = 'products';
    protected $primaryKey = 'id_barang';
    protected $fillable = ['id_kategori','nama_barang','harga','spesifikasi','qty'];

    public function category()
    {
        return $this->belongsTo(Category::class,'id_kategori');
    }

    public function stockin()
    {
        return $this->hasMany(Stockin::class, 'id_barang');
    }

    public function stockout()
    {
        return $this->hasMany(Stockout::class, 'id_barang');
    }

}
