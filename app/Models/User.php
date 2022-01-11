<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function experiences()
    {
        return $this->hasMany(Experience::class, 'user_id');
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class, 'user_id');
    }
}
