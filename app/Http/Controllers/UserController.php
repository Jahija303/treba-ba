<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $users = User::paginate(15);
        $roles = Role::all()->toArray();
        $cities = City::all()->toArray();
        $user_roles = DB::table('model_has_roles')
            ->select(['model_id', 'role_id', 'roles.name'])
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->get();

        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
            'user_roles' => $user_roles,
            'roles' => $roles,
            'cities' => $cities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'city_id' => 'required',
            'email' => 'required|unique:users|email',
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
            'role' => 'required',
        ]);

        $user = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'city_id' => $request->city_id,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ];

        User::create($user)->assignRole($request->role);
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'role' => 'required',
            'status' => 'required'
        ]);

        $user = User::find($id);
        $user->update([
           'status' => $request->status
        ]);
        $user->syncRoles([$request->role]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        User::where('id',$id)
            ->update(['status' => 0]);
        return back();
    }
}
