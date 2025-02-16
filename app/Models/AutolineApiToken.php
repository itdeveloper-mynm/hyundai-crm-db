<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutolineApiToken extends Model
{
    use HasFactory;

    protected $fillable = ['token', 'expires_at'];

    public function isValid()
    {
        return now()->lessThan($this->expires_at);
    }
}
