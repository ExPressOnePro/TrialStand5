<?php

namespace App\Http\Controllers;

use App\Models\Congregation;
use App\Models\CongregationRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CongregationRequestsController extends Controller {

    public function joinCongregation(Request $request, $id) {

        $user = Auth::user(); // получаем текущего пользователя
        $congregation = Congregation::find($id); // получаем собрания, к которому нужно присоединиться
        CongregationRequests::firstOrCreate([
            'user_id' => $user->id,
            'congregation_id' => $congregation->id,
        ]);

        /*$admins = $group->admins;*/ // получаем администраторов группы
        /*Notification::send($admins, new GroupJoinRequestNotification($groupRequest));*/

        // перенаправляем пользователя на страницу собрания
        return redirect()->route('home');
    }

}
