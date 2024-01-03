<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\NameSearchableTrait;


class Vehicle extends Model
{
    use HasFactory, NameSearchableTrait;

    protected $fillable = [
        'name',
        'status',
    ];
}
