<?php

namespace App\Http\Controllers;

use App\Models\Congregation;
use App\Models\CongregationRequests;
use App\Models\Role;
use App\Models\User;
use App\Models\UsersRoles;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class CongregationsController extends Controller {

    public function select() {
        $congregation = Congregation::where('id', '>', 1)->get();

        return view('congregation.select')->with([
            'congregation' => $congregation,
        ]);
    }

    public function view($id) {
        $congregation = Congregation::find($id);
        $countUsers = User::where('congregation_id', $id)->count();
        $manager = UsersRoles::where('role_id', 4)->get();
        $user = User::where('congregation_id', $id)->get();

        foreach ($manager as $man) {
            $managerCongregation = User::where('id', $man->user_id)
                ->where('congregation_id', $id)
                ->get();
        }

        $congregationRequests = CongregationRequests::with(
            'user')
            ->where('congregation_id', $id)
            ->get();

        return view('congregation.main')
            ->with([
                'congregation' => $congregation])
            ->with([
                'managerCongregation' => $managerCongregation])
            ->with([
                'congregationRequests' => $congregationRequests])
            ->with([
                'user' => $user])
            ->with([
                'countUsers' => $countUsers]);

    }

    public function allow($id, $user_id, $conReq) {

        $user = User::find($user_id);
        $user->congregation_id = $id;
        $user->save();

        $roleUserID = Role::where('name', 'User')->first();

        DB::table('users_roles')
            ->where('user_id', $user_id)
            ->update([
                'role_id' => $roleUserID->id,
            ]);

        $congrRequests = CongregationRequests::where('user_id', $user_id);
        $congrRequests->delete();

        return redirect()->route('congregationView', $id);
    }

    public function reject($id, $conReq) {

        $congrRequests = CongregationRequests::find($conReq);
        $congrRequests->delete();

        return redirect()->route('congregationView', $id);
    }

    public function index(): JsonResource
    {
        $congregations = Congregation::query()->select('id', 'name')->get();

        return JsonResource::collection($congregations);
    }

    public function store(Request $request): JsonResource {
        $congregation = Congregation::query()->create([
            'name' => $request->post('name'),
        ]);

        return new JsonResource($congregation);
    }

    public function update(Request $request, int $id): JsonResource
    {
        $congregation = Congregation::query()->findOrFail($id);

        $congregation->update([
            'name' => $request->post('name'),
        ]);

        return new JsonResource($congregation);
    }

    public function destroy(int $id): JsonResponse
    {
        Congregation::destroy($id);

        return Response::json(['message' => 'Congregation was deleted.']);
    }
}
