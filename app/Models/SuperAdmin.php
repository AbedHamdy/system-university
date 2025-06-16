<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SuperAdmin extends Authenticatable
{
    use HasFactory;

    public function generalPassword()
    {
        return $this->morphOne(GeneralPassword::class, 'accessible');
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

}
