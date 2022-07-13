<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable=['account_id1','account_id2','amount'];

    public function accountTransferer()
    {
        return $this->belongsTo(Account::class,'account_id1');
    }

    public function accountReciever()
    {
        return $this->belongsTo(Account::class,'account_id2');
    }
}
