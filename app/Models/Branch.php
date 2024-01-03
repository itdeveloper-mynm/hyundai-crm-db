<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\NameSearchableTrait;

class Branch extends Model
{
    use HasFactory, NameSearchableTrait;

    protected $fillable = [
        'name',
        'city_id',
        'status',
    ];

    public function city(){
        return $this->belongsTo(City::class);
    }


}
