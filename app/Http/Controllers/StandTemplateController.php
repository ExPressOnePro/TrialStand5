<?php

namespace App\Http\Controllers;

use App\Http\Requests\StandRequest;
use App\Models\StandTemplate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StandTemplateController extends Controller
{
    public function index(StandRequest $request): JsonResource
    {
        $templates = StandTemplate::with([
            'stand',
            'standPublishers.user',
            'standPublishers.user2',
            'congregation',
        ])
            ->where([
                'congregation_id' => $request->congregationId,
                'stand_id' => $request->standId,
            ])
            ->orderBy('day')
            ->get();

        $currentWeek = $templates->where('type', 'current');
        $nextWeek = $templates->where('type', 'next');

        return JsonResource::collection([
            'current' => $currentWeek,
            'next' => $nextWeek,
        ]);
    }

    public function weekDays(): JsonResource
    {
        $now = Carbon::now();
        $currentWeekDay = $now->copy()->dayOfWeek;
        $weekStartDate = $now->copy()->startOfWeek()->format('d-m-Y');
        $weekEndDate = $now->copy()->endOfWeek()->format('d-m-Y');
        $nextWeekStartDate = $now->copy()->addWeek()->startOfWeek()->format('d-m-Y');
        $nextWeekEndDate = $now->copy()->addWeek()->endOfWeek()->format('d-m-Y');

        return new JsonResource([
            'currentNumberOfWeekDay' => $currentWeekDay,
            'currentWeekStartDate' => $weekStartDate,
            'currentWeekEndDate' => $weekEndDate,
            'nextWeekStartDate' => $nextWeekStartDate,
            'nextWeekEndDate' => $nextWeekEndDate,
        ]);
    }
}
