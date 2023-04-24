<?php

namespace App\Http\Controllers;

use App\Models\StandTemplate;
use Illuminate\Http\Request;

class StandController extends Controller
{
    public function index()
    {
        $templates = StandTemplate::with(
            'stand',
            'standPublishers.user',
            'standPublishers.user2',
            'congregation'
       )
            ->orderBy('day')
            ->get();

        return view('stand.index', ['templates' => $templates]);
    }
}
