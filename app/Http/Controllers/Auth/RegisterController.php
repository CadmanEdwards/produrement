<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use DB;
use Session;


use App\Http\Requests\UserRequest;
use App\Http\Controllers\Traits\UserCreate;


class RegisterController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use UserCreate;



    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

   protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register_seller_submit(UserRequest $request){

        $user_data = $this->store($request,'seller',3); // can be found in traits/UserCreate

        if($user_data){
            return redirect()->route('company/add', $user_data->id);
        }

        return back();

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        return $data;

        $arr = [
            'name' => $data['name'],
			'phone_number' => $data['phone_start_code'].$data['phone_number'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ];
        // return $arr;

        $user_data = User::create();


       if($data['user_type'] == "seller"){
        DB::table('model_has_roles')->insert(
            ['role_id' => 3, 
            'model_type' => "App\User", 
            'model_id' => $user_data->id]
        );
        $user_data->user_type = "seller";
        }

        Session::put('temp_password', $data['password']);

        return redirect()->route('company/add', $user_data->id);
        
        // return $user_data;
        

    }
     
    protected function create_buyer($data)
    {
       $user_data = DB::table('users')
            ->where('id',$data)
            ->get();
            return $user_data;

    }
}
