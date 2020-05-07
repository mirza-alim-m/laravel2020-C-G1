<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    protected $table = 'categories';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['nama_kategori'];

    public function databuku()
    {
        return $this->hasMany(Databuku::class, 'id_buku');
    }
}
