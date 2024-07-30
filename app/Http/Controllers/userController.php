<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;

class userController extends Controller
{
    public function index()
    {
        $all_users = User::select('*')->where('id','!=','0')->get();
        return view('admin.users',['users' => $all_users]);
    }
    public function edit(string $id)
    { 
        $user = User::findOrFail($id);
        return view ('admin.edituser',['user' => $user]);
    }
    public function update(Request $request,string $id)
    {
        if($request->has('cancel'))
        {
         return redirect('users');
        }
        else if($request->has('update'))
        {
            if(isset($request->admin))
            $admin = 'yes';
        else $admin = 'no';
         User::where('id',$id)->update(['name'=>  $request->name,'email'=>$request->email,
        'admin'=>$admin]);
         return redirect('users');
        }
    }
    public function createUser(Request $request)
    {
        if($request->has('cancel'))
            return redirect('adminPanel');
        else if($request->has('add'))
        {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            if(isset($request->admin))
            $admin = 'yes';
            else $admin = 'no';
            $user->admin = $admin;
            $user->save();
            return redirect('users');
        }
    }
}
