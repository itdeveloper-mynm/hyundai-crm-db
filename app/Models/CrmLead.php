<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'city_id',
        'branch_id',
        'vehicle_id',
        'source_id',
        'campaign_id',
        'yearr',
        'intention',
        'monthly_salary',
        'category',
        'sub_category',
        'preferred_time',
        'kyc',
        'comments',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    public function source(){
        return $this->belongsTo(Source::class);
    }

    static function storeData($request) {

        $customer = addCustomer($request);

        $application = new self;
        $application->city_id = $request->input('city_id');
        $application->branch_id = $request->input('branch_id');
        $application->vehicle_id = $request->input('vehicle_id');
        $application->source_id = $request->input('source_id');
        $application->campaign_id = $request->input('campaign_id');
        $application->purchase_plan = $request->input('purchase_plan');
        $application->monthly_salary = $request->input('monthly_salary');
        $application->preferred_appointment_time = $request->input('preferred_appointment_time');
        $application->category = $request->input('category');
        $application->sub_category = $request->input('sub_category');
        $application->yearr = $request->input('yearr');
        $application->kyc = $request->input('kyc');
        $application->comments = $request->input('comments');
        $application->customer_id= $customer->id;

        $application->save();

        return $application;

    }

    static function updateData($request,$id) {

        $application = self::findorFail($id);
        $customer = updCustomer($request,$application->customer_id);

        //$customer = Customer::findorFail($application->customer_id);

        $application->city_id = $request->input('city_id');
        $application->branch_id = $request->input('branch_id');
        $application->vehicle_id = $request->input('vehicle_id');
        $application->source_id = $request->input('source_id');
        $application->campaign_id = $request->input('campaign_id');
        $application->purchase_plan = $request->input('purchase_plan');
        $application->monthly_salary = $request->input('monthly_salary');
        $application->preferred_appointment_time = $request->input('preferred_appointment_time');
        $application->category = $request->input('category');
        $application->sub_category = $request->input('sub_category');
        $application->yearr = $request->input('yearr');
        $application->kyc = $request->input('kyc');
        $application->comments = $request->input('comments');
        //$application->customer_id= $customer->id;

        $application->save();

        return $application;
    }

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
                        });
                    });
                }

                if (isset($conditions['city_id'])) {
                    $query->where(function ($query) use ($conditions) {
                        $query->whereHas('city', function ($query) use ($conditions) {
                            $query->where('id', $conditions['city_id']);
                        });
                    });
                }

                if (isset($conditions['branch_id'])) {
                    $query->where(function ($query) use ($conditions) {
                        $query->whereHas('branch', function ($query) use ($conditions) {
                            $query->where('id', $conditions['branch_id']);
                        });
                    });
                }

                if (isset($conditions['vehicle_id'])) {
                    $query->where(function ($query) use ($conditions) {
                        $query->whereHas('vehicle', function ($query) use ($conditions) {
                            $query->where('id', $conditions['vehicle_id']);
                        });
                    });
                }

                if (isset($conditions['source_id'])) {
                    $query->where(function ($query) use ($conditions) {
                        $query->whereHas('source', function ($query) use ($conditions) {
                            $query->where('id', $conditions['source_id']);
                        });
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

}
