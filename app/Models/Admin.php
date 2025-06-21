<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'image',
        "password",
        'category_id',
        'super_admin_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
