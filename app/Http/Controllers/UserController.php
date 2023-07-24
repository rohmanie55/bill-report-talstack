<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        return view('pages.users.index', [
            'users'=>User::query()->paginate(10)
        ]);
    }

    public function create(Request $request){
        if($request->isMethod("POST")){
            $validated = $request->validate([
                'name'=> 'required|max:100',
                'email'=>'required|unique:users,email',
                'password'=> 'required',
                'role'=> 'required',
                'is_active'=>'nullable'
            ]);
 
            (new User)->fill($validated)->save();

            return redirect(route('users.index'))->with('success','Successfull Create!');
        }

        return view('pages.users.input');
    }

    public function edit(Request $request, $id){
        if($request->isMethod("POST")){
            $validated = $request->validate([
                'name'=> 'required|max:100',
                'email'=>'required|unique:users,email,'.$id,
                'password'=> 'nullable',
                'role'=> 'required',
                'is_active'=>'nullable'
            ]);

            if(!$request->password){
                unset($validated['password']);
            }
            if(!$request->is_active){
                $validated['is_active']=0;
            }
            (new User)->find($id)->fill($validated)->save();

            return redirect(route('users.index'))->with('success','Successfull Update!');
        }

        return view('pages.users.input',[
            'item'=>User::find($id)
        ]);
    }

    public function destroy($id){
        try {
            User::find($id)->delete();
            return redirect(route('users.index'))->with('success','Successfull Delete!');
        } catch (\Throwable $th) {
            return redirect(route('users.index'))->with('fail','Failed to Delete!');
        }
    }
}
