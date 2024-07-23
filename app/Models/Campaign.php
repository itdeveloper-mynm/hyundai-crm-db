<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\NameSearchableTrait;

class Campaign extends Model
{
    use HasFactory, NameSearchableTrait;

    protected $fillable = [
        'name',
        'status',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

}
