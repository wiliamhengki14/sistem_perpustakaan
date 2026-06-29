<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow_Detail extends Model
{
    //
    protected $table = 'borrow_details';
    protected $fillable = [
        'borrow_id',
        'book_id',
        'qty'
    ];
    public function borrow() {
        return $this->belongsTo(Borrow::class);
    }
    public function book() {
        return $this->belongsTo(Book::class);
    }
}
