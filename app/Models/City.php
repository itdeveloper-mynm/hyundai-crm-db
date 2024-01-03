<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\NameSearchableTrait;

class City extends Model
{
    use HasFactory, NameSearchableTrait;

    protected $fillable = [
        'id',
        'name',
        'status',
    ];
}
