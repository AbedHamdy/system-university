<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralPassword extends Model
{
    use HasFactory;
    protected $fillable = [
        "general_code",
        "accessible_type",
        "accessible_id",
    ];

    public function accessible()
    {
        return $this->morphTo();
    }
}
