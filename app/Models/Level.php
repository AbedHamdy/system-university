<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'number_level',
        'super_admin_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function semester()
    {
        return $this->hasOne(Semester::class);
    }
}
