<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\UserRole;
use App\Admin;
use App\AdminType;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;
class RolesController extends Controller
{
    public function AddUser()
		{	
			$roles = Role::get();
            $users = Admin::get();
			$adminType = AdminType::get();
			return view('admin/roles/add',compact('roles','adminType','users'));
		}


	public function AddUserStore(Request $request) {
        $user_key = rand(111111, 999999);
        //if generated key is already exist in the DB then again re-generate key
        do {
            $check = Admin::where('user_key', $user_key)->count();
            $flag = 1;
            if ($check == 1) {
                $user_key = rand(111111, 999999);
                $flag = 0;
            }
        } while ($flag == 0);
       
        $password = $request['password'];
        
        $user = Admin::create([
        	'user_key' => $user_key, 
        	 'name' => $request['name'],
        	 'email' => $request['email'],
        	 'password' => Hash::make($request['password']),
        	 'master_password' => $request['password'],
        	 'mobile' => $request['mobile'],

        	]);
        
        
        // $this->email->welcomeUser($user,$password);
        return redirect('admin/roles');
    } //Create funtion end


    public function assignRole(Request $request) {
      

        foreach($request->role_id as $role_id){
                    UserRole::create([
                            'user_id' => $request['user_id'],
                            'role_id' => $role_id,
                    ]);
        }
        return redirect('admin/roles');
    } //Create funtion end

    




		
}
