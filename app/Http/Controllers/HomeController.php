<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use Spatie\Permission\Models\Role;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = auth::user()->roles[0]->id;

        // return $role;

           if($role == 4 || $role == 3){
                if(empty(Session::get('company_id'))){
                    
                    $company_data = DB::table('comapny')
                    ->where('user_id',auth::user()->id)
                    ->get()
                    ->first();
                    
                            if(isset($company_data)){

                $company_count = DB::table('product')->where('company_id', $company_data->id )->count();
                Session::put('company_id',$company_data->id);
                return view('home', compact('company_count') );
            }else{
                return redirect()->route('company/add', auth::user()->id);
            }
        }else{
            $company_count = DB::table('product')->where('company_id', Session::get('company_id') )->count();            
            return view('home', compact('company_count'));
        }

        }else{
            return view('home');
        }        
    }
}
