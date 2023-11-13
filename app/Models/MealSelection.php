<?php

namespace App\Models;

use App\Models\Meal;
use Illuminate\Support\Facades\Auth;
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

    public static function userSelections(User $user = null)
    {
        if (!$user) {
            $user = Auth::user();
        }

        return self::where(['user_id' => $user->id])->whereHas('meal')->get();
    }

    public static function userWeekSelections(int $year, int $week, User $user = null)
    {
        if (!$user) {
            $user = Auth::user();
        }

        $conditions = [
            'user_id' => $user->id,
            'year' => $year,
            'week' => $week
        ];

        return self::where($conditions)->whereHas('meal')->get();
    }

    public static function wipe($year, $week, User $user = null)
    {
        if (!$user) {
            $user = Auth::user();
        }
        self::where([
            'year' => $year,
            'week' => $week,
            'user_id' => $user->id
        ])->delete();
    }
}
