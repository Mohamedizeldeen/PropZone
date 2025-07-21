<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'national_id',
        'occupation',
        'employer',
        'monthly_income',
        'emergency_contact_name',
        'emergency_contact_phone',
        'status',
        'move_in_date',
        'move_out_date',
        'notes'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'monthly_income' => 'decimal:2',
        'move_in_date' => 'date',
        'move_out_date' => 'date',
    ];

    // Relationships
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function currentContract()
    {
        return $this->hasOne(Contract::class)->where('status', 'active');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function maintenanceRequests()
    {
        return $this->hasMany(MaintenanceRequest::class);
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getStatusBadgeAttribute()
    {
        $colors = [
            'active' => 'bg-green-100 text-green-800',
            'inactive' => 'bg-gray-100 text-gray-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'terminated' => 'bg-red-100 text-red-800',
        ];

        return $colors[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    // Business Logic
    public function getTotalPaidAmount()
    {
        return $this->payments()->where('status', 'completed')->sum('amount');
    }

    public function getPendingPaymentAmount()
    {
        return $this->payments()->where('status', 'pending')->sum('amount');
    }

    public function getActiveMaintenanceRequestsCount()
    {
        return $this->maintenanceRequests()->whereIn('status', ['pending', 'in_progress'])->count();
    }
}
