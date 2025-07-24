<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'company',
        'company_id',
        'role',
        'password',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Employee management relationships
    public function employees()
    {
        return $this->hasMany(User::class, 'company_id', 'company_id')
                    ->where('role', 'employee')
                    ->where('id', '!=', $this->id);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'company_id', 'company_id')
                    ->where('role', 'admin');
    }

    // Scopes
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeEmployees($query)
    {
        return $query->where('role', 'employee');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForCompany($query, $companyId)
    {
        return $query->where('company_id', $companyId);
    }

    // Helper methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isEmployee()
    {
        return $this->role === 'employee';
    }

    public function canManageEmployees()
    {
        return $this->isAdmin();
    }

    public function getFullNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->last_name) ?: $this->name;
    }

    public function getRoleBadgeAttribute()
    {
        $colors = [
            'admin' => 'bg-blue-100 text-blue-800',
            'employee' => 'bg-green-100 text-green-800',
        ];

        return $colors[$this->role] ?? 'bg-gray-100 text-gray-800';
    }
}
