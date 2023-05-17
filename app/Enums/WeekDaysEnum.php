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
            self::MON => (new Carbon('Mon this week'))->format('d.m.Y'),
            self::TUE => (new Carbon('Tue this week'))->format('d.m.Y'),
            self::WED => (new Carbon('Wed this week'))->format('d.m.Y'),
            self::THU => (new Carbon('Thu this week'))->format('d.m.Y'),
            self::FRI => (new Carbon('Fri this week'))->format('d.m.Y'),
            self::SAT => (new Carbon('Sat this week'))->format('d.m.Y'),
            self::SUN => (new Carbon('Sun this week'))->format('d.m.Y'),
        };
    }
    public static function getNextWeekDayDate(int $day): string
    {
        return match($day) {
            self::MON => (new Carbon('Mon next week'))->format('d.m.Y'),
            self::TUE => (new Carbon('Tue next week'))->format('d.m.Y'),
            self::WED => (new Carbon('Wed next week'))->format('d.m.Y'),
            self::THU => (new Carbon('Thu next week'))->format('d.m.Y'),
            self::FRI => (new Carbon('Fri next week'))->format('d.m.Y'),
            self::SAT => (new Carbon('Sat next week'))->format('d.m.Y'),
            self::SUN => (new Carbon('Sun next week'))->format('d.m.Y'),
        };
    }
}
