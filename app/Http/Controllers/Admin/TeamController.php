<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Admin;
use App\Role;
use App\UserRole;
use App\Mall\Merchant;

use Hash;
use Auth;
use Session;
class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
         $this->middleware('auth:admin');
    }

    public function index()
    {
       $teams = Admin::orderBy('id','DESC')->get();
       foreach ($teams as $key => $team) {
         $team->hasRoles =   DB::table('user_roles')->select('roles.name')->Leftjoin('roles','roles.id','=','user_roles.role_id')->where('user_id',$team->id)->get();
       }
        return view('admin.teams.list')->with('teams',$teams);
    }


    public function create()
    {   
        $roles = Role::all();
        return view('admin.teams.add')->with('roles',$roles);
    
    }

    public function store(Request $request)

    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
        $input = $request->all();
        if (isset($request->is_merchant)){
        $merchant = Merchant::create([
                'user_name'=>$request->name,
                'email_id'=>$request->email,
                'company_name'=>$request->name,
        ]);
            $input['merchant_id'] = $merchant->id;
        }else{

        }
            $input['password'] = Hash::make($input['password']);
            $input['user_key'] = rand(111111,999999);
            //if generated key is already exist in the DB then again re-generate key
            do
            {
            $check = Admin::where('user_key',$input['user_key'])->count();
            $flag = 1;
            if($check == 1)
            {
            $input['user_key'] = rand(111111,999999);
            $flag = 0;
            }
            }
            while($flag==0);
            $user = Admin::create($input);
        if($request->input('roles') == null){

        }else{
     
            foreach ($request->input('roles') as $key => $value) {
               DB::table('user_roles')->insert(['user_id'=>$user->id,'role_id'=>$value]);  
           }
        }


        return redirect()->route('teams.index')

            ->with('success','User created successfully');

    }


    public function edit($id)

    {
        $team = Admin::find($id);
        $roles = Role::all();
        $rolesUser = UserRole::where('user_id',$id)->get();
        return view('admin.teams.edit')->with('rolesUser',$rolesUser)->with('team',$team)->with('roles',$roles);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)

    {

         $customMessages = [
                'required' => 'The :attribute field can not be blank.'
            ];
        $this->validate($request, [

            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$id,

        ],$customMessages);


        $input = $request->all();

        if(!empty($input['password'])){

            $input['password'] = Hash::make($input['password']);

        }else{

            $input = array_except($input,array('password'));

        }


        $user = Admin::find($id);
        $user->update($input);

        DB::table('user_roles')->where('user_id',$id)->delete();
        if ($request->input('roles')){
        foreach ($request->input('roles') as $key => $value) {
            DB::table('user_roles')->insert(['user_id'=>$id,'role_id'=>$value]);
            }
        }

        session::flash('message','Team updated successfully');
        return redirect('admin/teams');

    }

}
