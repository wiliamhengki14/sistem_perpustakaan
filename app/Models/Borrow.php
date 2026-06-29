<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    //
    protected $fillable = [
        'user_id',
        'borrow_code',
        'borrow_date',
        'dua_date',
        'return_date',
        'status',
        'fine_amount'
    ];
    public function borrow_details() {
        return $this->hasMany(Borrow_Detail::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
