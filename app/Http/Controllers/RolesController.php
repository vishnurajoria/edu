<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;

class RolesController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_permissions = Permission::all();
        return view('roles.create', compact('all_permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|min:4',
            'label' => 'required|min:4',
            'permissions' => 'array',
        ]);

        $new_role = Role::create([
            'name' => request('name'),
            'label' => request('label'),
        ]);
        if(!empty(request('permissions'))) {
            foreach (request('permissions') as $permission) {
                if ($new_permission = Permission::where('name', $permission)->get()->first()) {
                    $new_role->addPermission($new_permission);
                }
            }
        }

        session()->flash('message', 'Role created!');
        return redirect('/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $role_permissions = $role->permissions;
        return view('roles.show', compact('role','role_permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role_permissions = Permission::all();
        $current_permissions = $role->permissions;
        return view('roles.edit', compact('role','role_permissions', 'current_permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->name;
        $role->label = $request->label;
        $role->save();
        $role->syncPermissions($request->permissions, true);
        session()->flash('message', 'Role updated!');
        return redirect('/roles/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
//        Delete also relations with users
        $role->permissions()->detach();
        Role::destroy($role->id);
        session()->flash('message', 'Role deleted!');
        return redirect('/roles');
    }
}
