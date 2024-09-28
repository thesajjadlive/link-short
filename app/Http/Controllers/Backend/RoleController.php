<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{

    public function index()
    {
        Gate::authorize('app.roles.index');
        $roles = Role::get();
        return  view('backend.role.index',compact('roles'));
    }


    public function create()
    {
        Gate::authorize('app.roles.create');
        $modules = Module::all();
        return  view('backend.role.create',compact('modules'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'role_name' =>'required',
            'permissions' =>'required|array',
            'permissions.*' =>'integer',
        ]);
        Role::create([
            'name' =>$request->role_name,
            'slug' =>str_slug($request->role_name),
        ])->permissions()->sync($request->input('permissions'),[]);
        notify()->success("Role create successfully","Success","topRight");
        return redirect()->route('app.roles.index');
    }


    public function show(Role $role)
    {
        //
    }


    public function edit(Role $role)
    {
        Gate::authorize('app.roles.edit');
        $role       = $role;
        $modules    = Module::all();
        return  view('backend.role.edit',compact('role','modules'));
    }


    public function update(Request $request, Role $role)
    {
        $this->validate($request,[
            'role_name' =>'required',
            'permissions' =>'required|array',
            'permissions.*' =>'integer',
        ]);
        $role->update([
            'name' => $request->role_name,
            'slug' => str_slug($request->role_name),
        ]);
        $role->permissions()->sync($request->input('permissions'));
        notify()->success("Role Update successfully","Success","topRight");
        return redirect()->route('app.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        Gate::authorize('app.roles.destroy');
        if ($role->deletable == true){
            $role->delete();
            notify()->success("Role delete successfully","Success","topRight");
            return  redirect()->back();
        }else{
            notify()->error("You can\'t delete system role","Error","topRight");
            return  redirect()->back();
        }
    }
}
