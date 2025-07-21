<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Property;

class Company extends Model
{
     protected $fillable = [
        'name',
        'email',
        'phone',
        'subscription_plan',
        'subscription_end',
    ];

    protected $hidden = [
        'password',       
    ];

    public function user(){
        return $this->hasMany(User::class);
    }
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
