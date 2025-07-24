<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'status',
        'location',
        'price',
        'description',
        'bedrooms',
        'bathrooms',
        'area',
        'image',
        'user_id',
        'company_id',
    ];

    protected $casts = [
        'price' => 'float',
        'area' => 'float',
    ];

    /**
     * Get the user that owns the property.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the company that owns the property.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the contracts for this property.
     */
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    /**
     * Get the current active contract for this property.
     */
    public function currentContract()
    {
        return $this->hasOne(Contract::class)->where('status', 'active');
    }

    /**
     * Get all tenants who have lived in this property.
     */
    public function tenants()
    {
        return $this->hasManyThrough(Tenant::class, Contract::class);
    }

    /**
     * Get the current tenant for this property.
     */
    public function currentTenant()
    {
        return $this->hasManyThrough(Tenant::class, Contract::class)
                    ->whereHas('contracts', function($query) {
                        $query->where('property_id', $this->id)
                              ->where('status', 'active');
                    });
    }

    /**
     * Get maintenance requests for this property.
     */
    public function maintenanceRequests()
    {
        return $this->hasMany(MaintenanceRequest::class);
    }

    /**
     * Get payments for this property through contracts.
     */
    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Contract::class);
    }

    /**
     * Get the formatted price.
     */
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format((float)$this->price, 2);
    }

    /**
     * Get the property type display name.
     */
    public function getTypeDisplayAttribute()
    {
        $types = [
            'apartment' => 'Apartment',
            'house' => 'House',
            'office' => 'Office',
            'retail' => 'Retail Space',
            'warehouse' => 'Warehouse',
            'land' => 'Land',
        ];

        return $types[$this->type] ?? ucfirst($this->type);
    }

    /**
     * Get the status display name with color.
     */
    public function getStatusDisplayAttribute()
    {
        $statuses = [
            'available' => ['text' => 'Available', 'class' => 'bg-green-100 text-green-800'],
            'rented' => ['text' => 'Rented', 'class' => 'bg-blue-100 text-blue-800'],
            'sold' => ['text' => 'Sold', 'class' => 'bg-gray-100 text-gray-800'],
            'maintenance' => ['text' => 'Maintenance', 'class' => 'bg-yellow-100 text-yellow-800'],
        ];

        return $statuses[$this->status] ?? ['text' => ucfirst($this->status), 'class' => 'bg-gray-100 text-gray-800'];
    }
}
