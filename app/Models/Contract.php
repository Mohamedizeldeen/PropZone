<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_number',
        'property_id',
        'tenant_id',
        'user_id',
        'company_id',
        'start_date',
        'end_date',
        'monthly_rent',
        'security_deposit',
        'late_fee',
        'rent_due_day',
        'terms_and_conditions',
        'special_clauses',
        'status',
        'notice_date',
        'termination_reason',
        'attachments'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'monthly_rent' => 'decimal:2',
        'security_deposit' => 'decimal:2',
        'late_fee' => 'decimal:2',
        'rent_due_day' => 'integer',
        'notice_date' => 'date',
        'attachments' => 'array',
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
        return $this->start_date->diffInMonths($this->end_date);
    }

    public function getRemainingDaysAttribute()
    {
        if ($this->end_date < now()) {
            return 0;
        }
        return now()->diffInDays($this->end_date);
    }

    // Business Logic
    public function isExpired()
    {
        return $this->end_date < now();
    }

    public function isActive()
    {
        return $this->status === 'active' && 
               $this->start_date <= now() && 
               $this->end_date >= now();
    }

    public function getTotalPaidAmount()
    {
        return $this->payments()->where('status', 'paid')->sum('amount');
    }

    public function getOutstandingBalance()
    {
        $expectedPayments = $this->calculateExpectedPayments();
        $paidAmount = $this->getTotalPaidAmount();
        return max(0, $expectedPayments - $paidAmount);
    }

    public function calculateExpectedPayments()
    {
        $monthsElapsed = max(1, $this->start_date->diffInMonths(now()) + 1);
        $totalMonths = min($monthsElapsed, $this->getDurationInMonthsAttribute());
        return $totalMonths * $this->monthly_rent;
    }

    public function generateNextPayment()
    {
        $nextDueDate = Carbon::createFromDate(
            now()->year, 
            now()->month, 
            $this->rent_due_day
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
