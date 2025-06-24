<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "email",
        "password",
        "image",
        "code",
        "national_id",
        "phone",
        "address",
        "level_id",
        "fees",
        "category_id",
        "admin_id",
        "semester_id",
    ];
}
