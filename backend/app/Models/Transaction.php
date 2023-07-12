<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    // protected $guarded = [];
    protected $primaryKey = 'customer_id';
    public $incrementing = false;

    public function User() {
        return $this->belongsTo(User::class);
    }

    // public function Customer() {
    //     return $this->belongsTo(Customer::class, 'customer_id', 'nisn');
    // }
}
