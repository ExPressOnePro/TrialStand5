<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send($email)
    {
        $user = User::where('email', $email)->first();

        Mail::to($user->email)->send(new Welcome());
    }
}
