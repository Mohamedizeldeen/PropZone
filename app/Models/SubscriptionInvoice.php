<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_name',
        'plan_type',
        'amount',
        'billing_period_start',
        'billing_period_end',
        'due_date',
        'payment_date',
        'status',
        'payment_method',
        'transaction_id',
        'properties_limit',
        'tenants_limit',
        'notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'billing_period_start' => 'date',
        'billing_period_end' => 'date',
        'due_date' => 'date',
        'payment_date' => 'date',
        'properties_limit' => 'integer',
        'tenants_limit' => 'integer',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        $colors = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'paid' => 'bg-green-100 text-green-800',
            'overdue' => 'bg-red-100 text-red-800',
            'cancelled' => 'bg-gray-100 text-gray-800',
        ];

        return $colors[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getPlanTypeBadgeAttribute()
    {
        $colors = [
            'free' => 'bg-gray-100 text-gray-800',
            'basic' => 'bg-blue-100 text-blue-800',
            'premium' => 'bg-purple-100 text-purple-800',
            'enterprise' => 'bg-gold-100 text-gold-800',
        ];

        return $colors[$this->plan_type] ?? 'bg-gray-100 text-gray-800';
    }

    public function getBillingPeriodAttribute()
    {
        return $this->billing_period_start->format('M d') . ' - ' . $this->billing_period_end->format('M d, Y');
    }

    public function getDaysOverdueAttribute()
    {
        if ($this->status === 'paid' || !$this->due_date) {
            return 0;
        }

        return max(0, now()->diffInDays($this->due_date, false));
    }

    // Business Logic
    public function isOverdue()
    {
        return $this->due_date < now() && $this->status !== 'paid';
    }

    public function isPaid()
    {
        return $this->status === 'paid';
    }

    public function canBeMarkedAsPaid()
    {
        return in_array($this->status, ['pending', 'overdue']);
    }

    public function markAsPaid($paymentDate = null, $transactionId = null, $paymentMethod = null)
    {
        $this->update([
            'status' => 'paid',
            'payment_date' => $paymentDate ?: now(),
            'transaction_id' => $transactionId ?: $this->transaction_id,
            'payment_method' => $paymentMethod ?: $this->payment_method
        ]);
    }

    public function generateNextInvoice()
    {
        $nextStart = $this->billing_period_end->addDay();
        $nextEnd = $nextStart->copy()->addMonth()->subDay();
        
        return static::create([
            'user_id' => $this->user_id,
            'plan_name' => $this->plan_name,
            'plan_type' => $this->plan_type,
            'amount' => $this->amount,
            'billing_period_start' => $nextStart,
            'billing_period_end' => $nextEnd,
            'due_date' => $nextEnd->addDays(7),
            'status' => 'pending',
            'properties_limit' => $this->properties_limit,
            'tenants_limit' => $this->tenants_limit
        ]);
    }

    public static function getPlanTypes()
    {
        return [
            'free' => [
                'name' => 'Free',
                'price' => 0,
                'properties_limit' => 1,
                'tenants_limit' => 5
            ],
            'basic' => [
                'name' => 'Basic',
                'price' => 29.99,
                'properties_limit' => 5,
                'tenants_limit' => 25
            ],
            'premium' => [
                'name' => 'Premium',
                'price' => 59.99,
                'properties_limit' => 15,
                'tenants_limit' => 100
            ],
            'enterprise' => [
                'name' => 'Enterprise',
                'price' => 199.99,
                'properties_limit' => null, // unlimited
                'tenants_limit' => null // unlimited
            ]
        ];
    }
}
