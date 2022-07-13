<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'amount'];
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function transmitters()
    {
        return $this->hasMany(Transfer::class,'account_id1');
    }

    public function recievers()
    {
        return $this->hasMany(Transfer::class,'account_id2');
    }
}
