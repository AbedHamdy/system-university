<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralPassword extends Model
{
    use HasFactory;

    public function accessible()
    {
        return $this->morphTo();
    }
}
