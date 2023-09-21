<?php

namespace App\Models;

use App\Models\Meal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MealSelection extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
}
