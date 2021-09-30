<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $id = Auth::user()->id;
        // $user = User::find($id);
        // return $user->getRoleNames();
        $role = DB::table('roles')
        ->join('role_has_permissions','role_has_permissions.role_id', '=','roles.id')
        ->join('permissions','role_has_permissions.permission_id','=','permissions.id')
        ->select(DB::raw('roles.id,roles.name,permissions.name as permissions'))
        ->get();
        
        return view('role.index', [
            'roles' => $role
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('role.create', [
            'permissions' => $permissions
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->role_name]);

        if(!empty($request->role_permission)) {
            $role->givePermissionTo($request->role_permission);
        }
        return redirect('/admin/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roles = Role::findOrFail($id);
        if(!$roles) {
            return redirect()->route('roles.index')->with('ID not found!');
        }
        $roles->delete();
        return redirect()->route('roles.index');
    }

    public function addRole()
    {
        $permissions = Permission::all();
        return view('role.create', [
            'permissions' => $permissions
        ]);
    }
}
