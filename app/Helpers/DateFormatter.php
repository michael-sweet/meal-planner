<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateFormatter
{
    public static function formatWeekRange(int $year, int $week): string
    {
        $date_start = Carbon::create()->setISODate($year, $week);
        $date_end = $date_start->copy()->addDays(6);

        $start_format = 'M j';
        $end_format = 'j, Y';

        if ($date_start->year != $date_end->year) {
            $start_format .= ', Y';
        }

        if ($date_start->month != $date_end->month) {
            $end_format = 'M ' . $end_format;
        }

        return $date_start->format($start_format) . ' – ' . $date_end->format($end_format);
    }
}
