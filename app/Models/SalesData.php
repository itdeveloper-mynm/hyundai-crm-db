<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesData extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'inv_date',
        'year',
        's',
        'chass',
        'vehicle_id',
        'department',
    ];

        // Define a scope for searching with conditions
        public function scopeSearch($query, $conditions)
        {
            return $query->where(function ($query) use ($conditions) {
                // Add your where conditions here based on $conditions array
                if (isset($conditions['search']['value'])) {
                    $search = $conditions['search']['value'];
                    $query->where(function ($query) use ($search) {
                        $query->whereHas('customer', function ($query) use ($search) {
                            $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $search . '%'])
                                ->orWhere('mobile', $search)
                                ->orWhere('email', $search);
                        })
                        // Add the condition for inv_date here
                        ->orWhere('inv_date', 'like', '%' . $search . '%')
                        ->orWhere('year', 'like', '%' . $search . '%')
                        ->orWhere('s', 'like', '%' . $search . '%')
                        ->orWhere('chass', 'like', '%' . $search . '%')
                        ->orWhere('model', 'like', '%' . $search . '%')
                        ->orWhere('department', 'like', '%' . $search . '%');
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

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    static function updateData($request,$id) {

        $salesdata = self::findorFail($id);

        $customer = Customer::findorFail($salesdata->customer_id);

        $salesdata->update([
                'inv_date' => request('inv_date'),
                'year' => request('year'),
                's' => request('s'),
                'chass' => request('chass'),
                'vehicle_id' => request('vehicle_id'),
                'department' => request('department'),
                // Add other columns as needed
            ]);

        $customer->save();

        return $customer;
    }


}
