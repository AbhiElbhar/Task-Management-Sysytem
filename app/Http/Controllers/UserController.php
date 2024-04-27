<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:View user',['only'=>['index']]);
        $this->middleware('permission:Create user',['only'=>['create','store',]]);
        $this->middleware('permission:Edit user',['only'=>['edit','update']]);
        $this->middleware('permission:Delete user',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::paginate(5);

        return view ('role.user.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();

        return view('role.user.create',compact('roles'));
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
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255|unique:Users,email',
            'password'=>'required|min:8|max:20',
            'roles'=>'required'
        ]);

       $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('user.index')->with('status','User created Successfully with Role');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        $roles = Role::get();
        $userRoles = $user->roles->pluck('name','name')->all();

        return view('role.user.edit',compact(['user','roles','userRoles'])); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'roles'=>'required'
        ]);

        $user->update([
            'name'=>$request->name,
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('user.index')->with('status','User updated Successfully with Role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('status','User deleted Successfully');
    }
}
