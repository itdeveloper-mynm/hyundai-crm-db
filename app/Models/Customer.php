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
        'gender',
        'national_id',
    ];

        // Define a scope for searching with conditions
        public function scopeSearch($query, $conditions)
        {
            return $query->where(function ($query) use ($conditions) {
                // Add your where conditions here based on $conditions array
                if (isset($conditions['search']['value'])) {
                    $search = $conditions['search']['value'];
                    $query->where(function ($query) use ($search) {
                        $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $search . '%'])
                                ->orWhere('mobile', $search)
                                ->orWhere('email', $search);
                    });
                    $query->orwhereHas('bank', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
                }
                if (isset($conditions['from']) &&  isset($conditions['to'])) {
                    $query->where(function ($query) use ($conditions) {
                        $startDate = $conditions['from'].' 00:00:00';
                        $endDate = $conditions['to'].' 23:59:59';
                        $query->whereBetween('created_at', [$startDate, $endDate]);
                    });
                }
                // Add more conditions as needed...
            });
        }

    public function bank(){
        return $this->belongsTo(Bank::class,'bank_id');
    }

}
