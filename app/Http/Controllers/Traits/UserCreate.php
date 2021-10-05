<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;

use App\User;
use DB;
use Auth;
use Session;

trait UserCreate
{
    public function store($request,$user_type,$role_id)
    {
        $arr = [
            'name' => $request->name,
			'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_operator' => $request->phone_operator,
            'user_type'=> $user_type
         ];

            try {

                $user_data = User::create($arr);
        
                DB::table('model_has_roles')->insert([
                    'role_id' => $role_id, 
                    'model_type' => "App\User", 
                    'model_id' => $user_data->id
                ]);
        
                if(Auth::user() && Auth::user()->roles[0]->id == 5){
        
                    User::whereId($user_data->id)->update([ 'created_by' => auth()->user()->id ]);
                }
        
                Session::put('temp_password', $request->password);

                return $user_data;
          
                } catch (\Throwable $th) {
                    // if (! file_exists(storage_path('errors'))) {
                    //     mkdir(storage_path('errors'), 0777);
                    // }

                    $myfile = fopen("error-logs.txt", "a") or die("Unable to open file!");
                    fwrite($myfile, "\n". $th->getMessage());
                    fclose($myfile);

                    return back();

                    // return  'Error can be found in where your application`s index.php';


                }
     
    }
}