<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'email',
        'bank_id',
        'city_id',
    ];

    public function bank(){
        return $this->belongsTo(Bank::class,'bank_id');
    }

}
