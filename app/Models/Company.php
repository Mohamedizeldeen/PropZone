<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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
}
