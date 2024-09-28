<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Mail\SendUserPassword;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('app.users.index');
        $users = User::with( 'roles' )->where('type', 'admin')->get();
        return view('backend.user.index',compact('users'));

    }

    public function create()
    {
        Gate::authorize('app.users.create');
        $roles = Role::get();
        return  view('backend.user.create',compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        Gate::authorize('app.users.create');
        $user = new User();
        $user->name           = $request->name;
        $user->email          = $request->email;
        $user->type          = 'admin';
        $user->designation    = $request->designation;
        $user->mobile         = $request->contact;
        $user->password       = Hash::make($request->password);
        $user->status         = $request->status;
        if ($request->hasFile('avatar')){
            $slug = str_slug($request->name);
            $image = $request->file('avatar');
            $file_name = $slug. '_' . time();
            $upload_path = 'uploads/avatar/';
            $filePath = $upload_path . $file_name. '.'. $image->getClientOriginalExtension();
            $image_url = $upload_path . $filePath;
            $image->move($upload_path, $image_url);
            $user->image = $filePath;
        }
        $user->save();
        $user->roles()->sync($request->roles,[]);

        // $user->password = $request->password;
        // $user->loginUri = route('login');
        // Mail::to($user->email)->send(new SendUserPassword($user));

        notify()->success('User Create successfully','Success');
        return redirect()->route('app.users.index');


    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        Gate::authorize('app.users.edit');
        $roles = Role::get();
        return  view('backend.user.edit',compact('roles','user'));
    }


    public function update(Request $request, User $user)
    {
        Gate::authorize('app.users.edit');
        $this->validate($request,[
            'name' =>'required',
            'email' =>'required|string|email|max:255|unique:users,email,'.$user->id,
            'roles'     => "required|array|min:1",
            "roles.*"   =>"required|distinct|min:1",
            'avatar' =>'nullable|mimes:jpg,jpeg,png|max:1024',
        ]);
        $user->name           = $request->name;
        $user->email          = $request->email;
        $user->designation    = $request->designation;
        $user->mobile         = $request->contact;
        $user->password       =  isset($request->password)?Hash::make($request->password):$user->password;
        $user->status         = $request->status;
        if ($request->hasFile('avatar')){
            $slug = str_slug($request->name);
            $image = $request->file('avatar');
            $file_name = $slug. '_' . time();
            $upload_path = 'uploads/avatar/';
            $filePath = $upload_path . $file_name. '.'. $image->getClientOriginalExtension();
            $image_url = $upload_path . $filePath;
            if ($user->image != null && File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }
            $image->move($upload_path, $image_url);
            $user->image = $filePath;
        }
        $user->save();
        $user->roles()->sync($request->input('roles', []));
        notify()->success('User Update successfully','Success');
        return redirect()->route('app.users.index');
    }


    public function destroy(User $user)
    {
        Gate::authorize('app.users.destroy');
        if ($user->image != null && File::exists(public_path($user->image))) {
            File::delete(public_path($user->image));
        }
        $user->delete();
        notify()->success("User delete successfully","Success","topRight");
        return  redirect()->back();

    }


    public function profile()
    {
        $user = Auth::user();
        $data['user'] = User::where('id', $user->id)->first();
        return  view('backend.user.profile',$data);
    }

    public function profile_update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        $this->validate($request,[
            'name' =>'required',
            'avatar' =>'nullable|mimes:jpg,jpeg,png|max:1024',
            'password' => ['nullable','string', 'min:8', 'confirmed'],
        ]);
        $user->name           = $request->name;
        $user->mobile         = $request->contact;
        $user->password       =  isset($request->password)?Hash::make($request->password):$user->password;
        if ($request->hasFile('avatar')){
            $slug = str_slug($request->name);
            $image = $request->file('avatar');
            $file_name = $slug. '_' . time();
            $upload_path = 'uploads/avatar/';
            $filePath = $upload_path . $file_name. '.'. $image->getClientOriginalExtension();
            $image_url = $upload_path . $filePath;
            if ($user->image != null && File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }
            $image->move($upload_path, $image_url);
            $user->image = $filePath;
        }
        $user->save();

        notify()->success('Profile successfully','Success');
        return  redirect()->route('app.dashboard');
    }

}
