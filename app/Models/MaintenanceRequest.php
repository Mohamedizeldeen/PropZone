<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaintenanceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'tenant_id',
        'title',
        'description',
        'category',
        'priority',
        'status',
        'requested_date',
        'scheduled_date',
        'completed_date',
        'assigned_to',
        'estimated_cost',
        'actual_cost',
        'notes',
        'images'
    ];

    protected $casts = [
        'requested_date' => 'datetime',
        'scheduled_date' => 'datetime',
        'completed_date' => 'datetime',
        'estimated_cost' => 'decimal:2',
        'actual_cost' => 'decimal:2',
        'images' => 'array'
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

    // Accessors
    public function getStatusBadgeAttribute()
    {
        $colors = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'in_progress' => 'bg-blue-100 text-blue-800',
            'completed' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
        ];

        return $colors[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getPriorityBadgeAttribute()
    {
        $colors = [
            'low' => 'bg-green-100 text-green-800',
            'medium' => 'bg-yellow-100 text-yellow-800',
            'high' => 'bg-orange-100 text-orange-800',
            'urgent' => 'bg-red-100 text-red-800',
        ];

        return $colors[$this->priority] ?? 'bg-gray-100 text-gray-800';
    }

    public function getCategoryBadgeAttribute()
    {
        $colors = [
            'plumbing' => 'bg-blue-100 text-blue-800',
            'electrical' => 'bg-yellow-100 text-yellow-800',
            'hvac' => 'bg-purple-100 text-purple-800',
            'appliances' => 'bg-green-100 text-green-800',
            'structural' => 'bg-red-100 text-red-800',
            'cleaning' => 'bg-cyan-100 text-cyan-800',
            'security' => 'bg-orange-100 text-orange-800',
            'other' => 'bg-gray-100 text-gray-800',
        ];

        return $colors[$this->category] ?? 'bg-gray-100 text-gray-800';
    }

    public function getDaysOpenAttribute()
    {
        if ($this->completed_date) {
            return $this->requested_date->diffInDays($this->completed_date);
        }
        
        return $this->requested_date->diffInDays(now());
    }

    // Business Logic
    public function isOverdue()
    {
        return $this->scheduled_date && 
               $this->scheduled_date < now() && 
               !in_array($this->status, ['completed', 'cancelled']);
    }

    public function canBeCompleted()
    {
        return in_array($this->status, ['pending', 'in_progress']);
    }

    public function markAsCompleted($actualCost = null, $notes = null)
    {
        $this->update([
            'status' => 'completed',
            'completed_date' => now(),
            'actual_cost' => $actualCost ?: $this->actual_cost,
            'notes' => $notes ?: $this->notes
        ]);
    }

    public function getTotalImages()
    {
        return is_array($this->images) ? count($this->images) : 0;
    }

    public static function getCategories()
    {
        return [
            'plumbing' => 'Plumbing',
            'electrical' => 'Electrical',
            'hvac' => 'HVAC',
            'appliances' => 'Appliances',
            'structural' => 'Structural',
            'cleaning' => 'Cleaning',
            'security' => 'Security',
            'other' => 'Other'
        ];
    }

    public static function getPriorities()
    {
        return [
            'low' => 'Low',
            'medium' => 'Medium',
            'high' => 'High',
            'urgent' => 'Urgent'
        ];
    }
}
