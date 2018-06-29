<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use App\Article;
use App\Testimony;
use Validator;
use Illuminate\Http\Request;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Log;


class JwtAuthenticateController extends Controller
{

    public function index()
    {
        return response()->json(['auth'=>Auth::user(),
                                 'users'=>User::all()]);
    }
   public function userProfile(){
        $user_id = auth()->user()->id;
        $user_name = User::where('id', '=', $user_id)->get();
        $user_articles =  Article::where('user_id', '=', $user_id)->get();
        return response()->json(['user' =>
          $user_name, 'Articles by the user' => $user_articles]);
        // $user_id, 'Articles by the user' => $user_articles
    }
    public function total(){
        $users = User::all()->count();
        $articles = Article::all()->count();
        $testimony = Testimony::all()->count();
        return response()->json([
            'users' => $users,
            'articles' => $articles,
            'testimonies' => $testimony
        ]);
    }


    public function authenticate()
    {
        $credentials = request()->only('email', 'password');

        try {
            $token = JWTAuth::attempt($credentials);
            // verify the credentials and create a token for the user
            if (!$token) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }



        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(['token' => $token], 200);
    }
    public function register()
    {
      $this->validate(request(), [
        'name' => 'required|string|max:30',
        'email' => 'required|string|max:30',
        'password' => 'required|string|min:6',

      ]);
       try{
        $name = request()->name;
        $email = request()->email;
        $password = request()->password;

        $user = User::create([
            'name' => $name,
            'email' => $email,
           'password' => Hash::make($password),

        ]);
      }
      catch (\Illuminate\Database\QueryException $e){
           $errorCode = $e->errorInfo[1];
           if($errorCode == 1062){
               return response()->json(['error' => 'Duplicate Entry']);
           }
       }
        $token = JwTAuth::fromUser($user);

        return response()->json(['token' => $token], 200);


    }


    public function createRole(Request $request){

        $role = new Role();
        $role->name = $request->input('name');
        $role->save();

        return response()->json(" Role created");

    }

    public function createPermission(Request $request){

        $viewUsers = new Permission();
        $viewUsers->name = $request->input('name');
        $viewUsers->save();

        return response()->json("Permission created");

    }
    public function checkPermissions(Request $request){
        $role = Role::where('name', '=', $request->input('role'))->get();
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            // return $permission;
            return response()->json(['permission' => $permission]);
            // return response()->json(['status'=> true, 'message'=> 'success', 
            //     'permission'=>$permission],200);
        }
        
    }

    public function assignRole(Request $request){
        $user = User::where('email', '=', $request->input('email'))->first();

        $role = Role::where('name', '=', $request->input('role'))->first();
        //$user->attachRole($request->input('role'));
        $user->roles()->attach($role->id);

        return response()->json("assigned as " . $role->name);
    }

    public function attachPermission(Request $request){
        $role = Role::where('name', '=', $request->input('role'))->first();
        $permission = Permission::where('name', '=', $request->input('name'))->first();
        
        $role->attachPermission($permission);

        return response()->json("permission attached to role");
    }

    public function checkRoles(Request $request){
        $user = User::where('email', '=', $request->input('email'))->first();
        Log::info($user);
        return response()->json([
            "user" => $user,
            "owner" => $user->hasRole('owner'),
            "admin" => $user->hasRole('admin'),
            "createUser" => $user->can('create-users'),
            "editUser" => $user->can('edit-user'),
            "listUsers" => $user->can('list-users')
        ]);
    }


}
