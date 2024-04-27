<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\support\Facades\DB;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:View Role',['only'=>['index']]);
        $this->middleware('permission:Create Role',['only'=>['create','store','show','updatePermission']]);
        $this->middleware('permission:Edit Role',['only'=>['edit','update']]);
        $this->middleware('permission:Delete Role',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = role::paginate(5);

        return view('role.role.index',compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|unique:roles,name'
        ]);

        Role::create([
            'name'=>$request->name
        ]);

        return redirect()->route('role.index')->with('status','Role created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $permission = Permission::get();
        $rolePermission = DB::table('role_has_permissions')
                        ->where('role_has_permissions.role_id', $role->id)
                        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();

        return view('role.role.addPermission',compact(['role','permission','rolePermission']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('role.role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'=>'required|string|unique:roles,name,'.$role->id
        ]);

        $role->update([
            'name'=>$request->name
        ]);

        return redirect()->route('role.index')->with('status','Role updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('role.index')->with('status','Role deleted Successfully');
    }

    public function updatePermission(Request $request, $roleId)
    {
        $request->validate([
            'permission'=>'required'
        ]);

        $role = Role::findOrfail($roleId);

        $role->syncPermissions($request->permission);

        return redirect()->back()->with('status','Permission added to Role');
    }
}
