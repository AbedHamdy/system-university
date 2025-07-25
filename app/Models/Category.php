<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'super_admin_id',
    ];

    public function superAdmin()
    {
        return $this->belongsTo(SuperAdmin::class);
    }

    public function levels()
    {
        return $this->hasMany(Level::class);
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
