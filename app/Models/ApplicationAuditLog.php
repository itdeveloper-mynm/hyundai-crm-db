<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationAuditLog extends Model
{
    public $timestamps = false;

    const CREATED_AT = 'created_at';

    protected $fillable = ['application_id', 'user_id', 'changes'];

    protected $casts = [
        'changes'    => 'array',
        'created_at' => 'datetime',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Human-readable field name map.
     */
    public static function fieldLabel(string $field): string
    {
        $map = [
            'category'                   => 'Category',
            'sub_category'               => 'Sub Category',
            'crm_lead_status'            => 'CRM Lead Status',
            'kyc'                        => 'KYC',
            'source_id'                  => 'Source ID',
            'campaign_id'                => 'Campaign ID',
            'branch_id'                  => 'Branch ID',
            'vehicle_id'                 => 'Vehicle ID',
            'city_id'                    => 'City ID',
            'comments'                   => 'Comments',
            'apply_for'                  => 'Apply For',
            'booking_reason'             => 'Booking Reason',
            'booking_category'           => 'Booking Category',
            'department'                 => 'Department',
            'intention'                  => 'Intention',
            'purchase_plan'              => 'Purchase Plan',
            'preferred_appointment_time' => 'Preferred Appointment Time',
            'qualified_date'             => 'Qualified Date',
            'nationalid'                 => 'National ID',
            'vin'                        => 'VIN',
            'plateno'                    => 'Plate No',
        ];

        return $map[$field] ?? ucwords(str_replace('_', ' ', $field));
    }
}
