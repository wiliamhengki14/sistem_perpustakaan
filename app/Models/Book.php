<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $fillable = [
        'categorie_id',
        'author',
        'title',
        'publisher',
        'publish_year',
        'description',
        'cover_image',
        'isbn',
        'stock'
    ];
    public function categorie() {
        return $this->belongsTo(Categorie::class);
    }
    public function borrow_details() {
        return $this->hasMany(Borrow_Detail::class);
    }

}
