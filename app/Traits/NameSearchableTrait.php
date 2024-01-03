<?php

namespace App\Traits;

trait NameSearchableTrait
{
    public function scopeSearch($query, $conditions)
    {
        return $query->where(function ($query) use ($conditions) {
            // Add your where conditions here based on $conditions array
            if (isset($conditions['search']['value'])) {
                $search = $conditions['search']['value'];
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
                if (method_exists($this, 'city')) {
                    $query->orwhereHas('city', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
                }
            }
        });
    }
}
