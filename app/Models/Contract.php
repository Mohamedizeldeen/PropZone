<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'tenant_id',
        'lease_start_date',
        'lease_end_date',
        'monthly_rent',
        'security_deposit',
        'utility_deposit',
        'payment_due_day',
        'late_fee_amount',
        'grace_period_days',
        'terms_conditions',
        'status',
        'signed_date',
        'contract_file_path'
    ];

    protected $casts = [
        'lease_start_date' => 'date',
        'lease_end_date' => 'date',
        'monthly_rent' => 'decimal:2',
        'security_deposit' => 'decimal:2',
        'utility_deposit' => 'decimal:2',
        'late_fee_amount' => 'decimal:2',
        'payment_due_day' => 'integer',
        'grace_period_days' => 'integer',
        'signed_date' => 'date',
    ];

    // Relationships
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        $colors = [
            'active' => 'bg-green-100 text-green-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'expired' => 'bg-red-100 text-red-800',
            'terminated' => 'bg-gray-100 text-gray-800',
        ];

        return $colors[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getDurationInMonthsAttribute()
    {
        return $this->lease_start_date->diffInMonths($this->lease_end_date);
    }

    public function getRemainingDaysAttribute()
    {
        if ($this->lease_end_date < now()) {
            return 0;
        }
        return now()->diffInDays($this->lease_end_date);
    }

    // Business Logic
    public function isExpired()
    {
        return $this->lease_end_date < now();
    }

    public function isActive()
    {
        return $this->status === 'active' && 
               $this->lease_start_date <= now() && 
               $this->lease_end_date >= now();
    }

    public function getTotalPaidAmount()
    {
        return $this->payments()->where('status', 'completed')->sum('amount');
    }

    public function getOutstandingBalance()
    {
        $expectedPayments = $this->calculateExpectedPayments();
        $paidAmount = $this->getTotalPaidAmount();
        return max(0, $expectedPayments - $paidAmount);
    }

    public function calculateExpectedPayments()
    {
        $monthsElapsed = max(1, $this->lease_start_date->diffInMonths(now()) + 1);
        $totalMonths = min($monthsElapsed, $this->getDurationInMonthsAttribute());
        return $totalMonths * $this->monthly_rent;
    }

    public function generateNextPayment()
    {
        $nextDueDate = Carbon::createFromDate(
            now()->year, 
            now()->month, 
            $this->payment_due_day
        );

        if ($nextDueDate < now()) {
            $nextDueDate->addMonth();
        }

        return [
            'due_date' => $nextDueDate,
            'amount' => $this->monthly_rent,
            'type' => 'rent'
        ];
    }
}
