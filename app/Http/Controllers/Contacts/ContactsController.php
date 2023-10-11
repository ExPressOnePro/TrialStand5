<?php

namespace App\Http\Controllers\Contacts;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{
    public function index($congregation) {
        $user = User::find(Auth::id());
        $users = User::with('usersroles.role', 'usersGroups.group')
            ->where('congregation_id', $user->congregation_id)
            ->orderBy('last_name', 'asc')
            ->get();
        return view('Mobile.menu.modules.contacts.hub', compact('users'));
    }
}
