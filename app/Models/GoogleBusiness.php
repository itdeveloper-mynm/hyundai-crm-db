<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleBusiness extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'branch_id',
        'greviews',
        'greplied',
        'gsearchlisting',
        'gmapslisting',
        'gwebsite',
        'gdirection',
        'gcalls',
        'gtype',
        'month',
        'year',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
