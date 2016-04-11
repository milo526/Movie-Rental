<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Validator;

use App\Http\Requests;
use Bican\Roles\Models\Role;
use App\User;

class PermissionController extends Controller
{

    public function get($id)
    {
        return view('admin/getPermissions')->with('user', User::find($id))->with('roles', Role::all());
    }

    public function edit(Request $request, $id)
    {
    	$validator = Validator::make($request->all(), [
        	'role' => 'required',
    	]);

    	if ($validator->fails()) {
            return redirect()
            			->route('admin::permissions::get', ['id'=> $id])
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $user = User::find($id);
        $role = $request->input('role');
        if ($user->is($role)) {
        	$user->detachRole($role);
		}else{
			$user->attachRole($role);
		}

    	return redirect()->route('admin::permissions::get', ['id'=> $id])->with('status', 'Updated Role!');
    }
}
