<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \Spatie\Permission\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Roles/Index', [
            'roles' => Role::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles'
        ]);

        Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $roleId
     * @return Response
     */
    public function edit($roleId): Response
    {
        $role = Role::find($roleId);

        return Inertia::render('Admin/Roles/Edit', [
            'role' => $role,
            'permissions' => Permission::all()->pluck('name'),
            'rolePermissions' => $role->permissions()->pluck('name')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function update(Request $request, $roleId)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required',
        ]);

        $role = Role::find($roleId);
        $role->update($request->only(['name']));

        $permissions = collect($request->input('permissions'));
        $role->syncPermissions($permissions);

        return Inertia::render('Admin/Roles/Index', [
            'roles' => Role::all(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $roleId
     * @return RedirectResponse
     */
    public function destroy($roleId): RedirectResponse
    {
        $role = Role::find($roleId);
        $role->delete();
        return back();
    }
}
