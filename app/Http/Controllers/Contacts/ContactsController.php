<?php

namespace App\Http\Controllers\Contacts;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{
    public function index() {
        $users = User::with('usersroles.role', 'usersGroups.group')
            ->where('congregation_id', auth()->user()->congregation_id)
            ->whereRaw('JSON_EXTRACT(info, "$.mobile_phone") IS NOT NULL')  // Условие: ключ mobile_phone существует
            ->whereRaw('JSON_EXTRACT(info, "$.mobile_phone") != ?', [''])
            ->whereRaw("JSON_EXTRACT(info, '$.account_type') IS NULL")
            ->orWhereRaw("JSON_EXTRACT(info, '$.account_type') != 'deleted'")// Условие: ключ mobile_phone не пуст
            ->where(function ($query) {
                $query->whereRaw("JSON_EXTRACT(info, '$.account_type') IS NULL")
                    ->orWhereRaw("JSON_EXTRACT(info, '$.account_type') != 'deleted'");
            })
            ->orderBy('last_name', 'asc')
            ->get();

        return view('Mobile.menu.modules.contacts.hub', compact('users'));
    }
    public function index2() {
        $users = User::where('congregation_id', auth()->user()->congregation_id)
            ->where(function ($query) {
                $query->whereRaw("JSON_EXTRACT(info, '$.account_type') IS NULL")
                    ->orWhereRaw("JSON_EXTRACT(info, '$.account_type') != 'deleted'");
            })
            ->orderBy('last_name', 'asc')
            ->get();

        return view('BootstrapApp.Modules.contacts.hub', compact('users'));
    }
}
