<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_number',
        'contract_id',
        'tenant_id',
        'property_id',
        'user_id',
        'payment_type',
        'amount',
        'due_date',
        'paid_date',
        'status',
        'payment_method',
        'transaction_reference',
        'late_fee_amount',
        'notes',
        'receipt_file'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'late_fee_amount' => 'decimal:2',
        'due_date' => 'date',
        'paid_date' => 'date',
    ];

    // Relationships
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        $colors = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'paid' => 'bg-green-100 text-green-800',
            'overdue' => 'bg-red-100 text-red-800',
            'partial' => 'bg-orange-100 text-orange-800',
            'cancelled' => 'bg-gray-100 text-gray-800',
        ];

        return $colors[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getPaymentTypeBadgeAttribute()
    {
        $colors = [
            'rent' => 'bg-blue-100 text-blue-800',
            'security_deposit' => 'bg-purple-100 text-purple-800',
            'utility_deposit' => 'bg-cyan-100 text-cyan-800',
            'late_fee' => 'bg-red-100 text-red-800',
            'maintenance' => 'bg-orange-100 text-orange-800',
            'other' => 'bg-gray-100 text-gray-800',
        ];

        return $colors[$this->payment_type] ?? 'bg-gray-100 text-gray-800';
    }

    public function getTotalAmountAttribute()
    {
        return $this->amount + ($this->late_fee_amount ?? 0);
    }

    public function getDaysLateAttribute()
    {
        if (!$this->due_date || $this->status === 'paid') {
            return 0;
        }

        return max(0, now()->diffInDays($this->due_date, false));
    }

    // Business Logic
    public function isLate()
    {
        return $this->due_date < now() && $this->status !== 'paid';
    }

    public function canBeMarkedAsPaid()
    {
        return in_array($this->status, ['pending', 'overdue', 'partial']);
    }

    public function markAsPaid($paymentDate = null, $referenceNumber = null)
    {
        $this->update([
            'status' => 'paid',
            'paid_date' => $paymentDate ?: now(),
            'transaction_reference' => $referenceNumber ?: $this->transaction_reference
        ]);
    }

    public function calculateLateFee($lateFeeAmount = 50, $gracePeriodDays = 5)
    {
        if (!$this->isLate()) {
            return 0;
        }

        $daysLate = $this->getDaysLateAttribute();
        if ($daysLate <= $gracePeriodDays) {
            return 0;
        }

        return $lateFeeAmount;
    }

    public static function getPaymentTypes()
    {
        return [
            'rent' => 'Rent',
            'security_deposit' => 'Security Deposit',
            'utility_deposit' => 'Utility Deposit',
            'late_fee' => 'Late Fee',
            'maintenance' => 'Maintenance',
            'other' => 'Other'
        ];
    }

    public static function getPaymentMethods()
    {
        return [
            'cash' => 'Cash',
            'check' => 'Check',
            'bank_transfer' => 'Bank Transfer',
            'credit_card' => 'Credit Card',
            'debit_card' => 'Debit Card',
            'online' => 'Online Payment',
            'mobile_money' => 'Mobile Money'
        ];
    }
}
