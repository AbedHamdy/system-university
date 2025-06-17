<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = [
        "semester_number",
        "level_id",
        "start_date",
        "end_date",
        "year",
    ];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
