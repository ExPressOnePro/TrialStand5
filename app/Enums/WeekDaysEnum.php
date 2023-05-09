<?php

namespace App\Enums;

use Carbon\Carbon;

/**
 * @todo move to helper or service
 */
class WeekDaysEnum
{
    public const MON = 1;
    public const TUE = 2;
    public const WED = 3;
    public const THU = 4;
    public const FRI = 5;
    public const SAT = 6;
    public const SUN = 7;

    public const WEEK_DAYS = [
        self::MON => 'Понедельник',
        self::TUE => 'Вторник',
        self::WED => 'Среда',
        self::THU => 'Четверг',
        self::FRI => 'Пятница',
        self::SAT => 'Субота',
        self::SUN => 'Воскресенье',
    ];

    public static function getWeekDay(int $day): string
    {
        return self::WEEK_DAYS[$day];
    }



    public static function getWeekDayDate(int $day): string
    {
        return match($day) {
            self::MON => (new Carbon('this Monday'))->format('d.m.Y'),
            self::TUE => (new Carbon('this Tuesday'))->format('d.m.Y'),
            self::WED => (new Carbon('this Wednesday'))->format('d.m.Y'),
            self::THU => (new Carbon('this Thursday'))->format('d.m.Y'),
            self::FRI => (new Carbon('this Friday'))->format('d.m.Y'),
            self::SAT => (new Carbon('this Saturday'))->format('d.m.Y'),
            self::SUN => (new Carbon('this Sunday'))->format('d.m.Y'),
        };
    }
}
