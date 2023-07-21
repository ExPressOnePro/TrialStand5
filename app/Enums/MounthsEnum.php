<?php

namespace App\Enums;

use Carbon\Carbon;

/**
 * @todo move to helper or service
 */
class WeekDaysEnum
{
    public const JAN = 1;
    public const FEB = 2;
    public const MAR = 3;
    public const APR = 4;
    public const MAY = 5;
    public const JUN = 6;
    public const JUL = 7;
    public const AUG = 8;
    public const SEP = 9;
    public const OCT = 10;
    public const NOV = 11;
    public const DEC = 12;

    public const YEAR_MONTHS = [
        self::JAN => 'Январь',
        self::FEB => 'Февраль',
        self::MAR => 'Март',
        self::APR => 'Апрель',
        self::MAY => 'Май',
        self::JUN => 'Июнь',
        self::JUL => 'Июль',
        self::AUG => 'Август',
        self::SEP => 'Сентябрь',
        self::OCT => 'Октябрь',
        self::NOV => 'Ноябрь',
        self::DEC => 'Декабрь',
    ];

    public static function getYearMonths(int $months): string {
        return self::YEAR_MONTHS[$months];
    }

    public static function getYearMonthsDate(int $day): string
    {

        return match($day) {
            $year = Carbon::now()->year; // текущий год
            self::JAN => (new Carbon($year,1))->format('m'),
            self::FEB => (new Carbon($year,2))->format('m'),
            self::MAR => (new Carbon($year,3))->format('m'),
            self::APR => (new Carbon($year,4))->format('m'),
            self::MAY => (new Carbon($year,5))->format('m'),
            self::JUN => (new Carbon($year,6))->format('m'),
            self::JUL => (new Carbon($year,7))->format('m'),
            self::AUG => (new Carbon($year,8))->format('m'),
            self::SEP => (new Carbon($year,9))->format('m'),
            self::OCT => (new Carbon($year,10))->format('m'),
            self::NOV => (new Carbon($year,11))->format('m'),
            self::DEC => (new Carbon($year,12))->format('m'),
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
