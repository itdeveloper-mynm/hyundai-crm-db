<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\NameSearchableTrait;

class Source extends Model
{
    use HasFactory, NameSearchableTrait;

    protected $fillable = [
        'name',
        'status',
        'page_type',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function scopeSearch($query, $conditions)
    {

        return $query->where(function ($query) use ($conditions) {
            // Add your where conditions here based on $conditions array
            if (isset($conditions['search']['value'])) {
                $search = $conditions['search']['value'];
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            }

            if (isset($conditions['status'])) {
                $query->where(function ($query) use ($conditions) {
                    $query->where('status', $conditions['status']);
                });
            }

            if (isset($conditions['from']) &&  isset($conditions['to'])) {
                $query->where(function ($query) use ($conditions) {
                    $startDate = $conditions['from'].' 00:00:00';
                    $endDate = $conditions['to'].' 23:59:59';
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                });
            }

        });

    }
}
