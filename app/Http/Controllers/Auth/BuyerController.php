<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
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
use Hash;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\Print_;

use App\Http\Requests\UserRequest;
use App\Http\Requests\CompanyRequest;
use App\Http\Controllers\Traits\UserCreate;

class BuyerController extends Controller
{

    use UserCreate;

    public function login(){
        return view('auth.buyer_login');
    }

    public function forgot_password(){
        return view('auth.passwords.buyer_email');
    }
    public function register(){
        return view('auth.buyer_register');
    }

    public function insert_session_id(Request $request){
       Session::put('company_id',$request->id);
       echo "success";
    }

    public function buyer_list(){
        if(isset($_GET['company_type'])){
            $company_type= $_GET['company_type'];
        }else{
            $company_type = ""; 
        }
        
        if(empty($company_type)){
            $confirm_data = DB::table('relation')
            ->select('relation.*','users.phone_number','comapny.comapny','comapny.landline_number','comapny.ntn_number','comapny.strn_number','comapny.company_name as buyer_name','comapny.user_id as user_id','users.name as user_name')
            ->join('comapny','relation.buyer_company_id', '=', 'comapny.id')
            ->join('users','comapny.user_id', '=', 'users.id')
            ->where('relation.status','approved')
            ->where('seller_id',auth()->user()->id)
            ->where('seller_company_id',Session::get('company_id'))
            ->orderBy('company_name')
            ->get();
        }else{
            $confirm_data = DB::table('relation')
            ->select('relation.*','users.phone_number','comapny.comapny','comapny.landline_number','comapny.ntn_number','comapny.strn_number','comapny.company_name as buyer_name','comapny.user_id as user_id','users.name as user_name')
            ->join('comapny','relation.buyer_company_id', '=', 'comapny.id')
            ->join('users','comapny.user_id', '=', 'users.id')
            ->where('relation.status','approved')
            ->where('seller_id',auth()->user()->id)
            ->where('comapny',$company_type)
            ->where('seller_company_id',Session::get('company_id'))
            ->orderBy('company_name')
            ->get();
        }
        

        return view('auth.buyer_list',compact('confirm_data'));
    }

    public function admin_buyer_list(){
        if(isset($_GET['company_type'])){
            $company_type= $_GET['company_type'];
        }else{
            $company_type = ""; 
        }
        $buyer = User::whereHas(
            'roles', function($q){
                $q->where('name', 'buyer');
            }
        )->get();
        //echo"<pre>";
        //print_r($buyer);die;
        

        return view('auth.admin_buyer_list',compact('buyer'));
    }

    public function admin_seller_list(){
        if(isset($_GET['company_type'])){
            $company_type= $_GET['company_type'];
        }else{
            $company_type = ""; 
        }
        $buyer = User::whereHas(
            'roles', function($q){
                $q->where('name', 'seller');
            }
        )->get();
        //echo"<pre>";
        //print_r($buyer);die;
        

        return view('auth.admin_seller_list',compact('buyer'));
    }

    public function view_buyer_details($id){
        $buyer = DB::table('users')
           ->where('id',$id)
           ->first();
        return view('auth.admin_buyer_view_details',compact('buyer'));
    }

    public function view_seller_details($id){
        $buyer = DB::table('users')
           ->where('id',$id)
           ->first();
        return view('auth.admin_seller_view_details',compact('buyer'));
    }

    public function interest($id){
        return view('auth.buyer_interest',compact('id'));
    }

    public function login_check (Request $request){
        $this->validate($request, [
            'email' => 'required', 
            'password' => 'required',
         ]);
         
         $user_data = array(
            'phone_number'  => $request->email,
            'password' => $request->password
        );

        $users = User::whereHas("roles", function($q) {
            $q->where("name",'!=', "Sub Admin")
            ->Where("name", "buyer");
        })->get()->first();
        
        if(!Auth::attempt($user_data)){
            return redirect('Buyer/login')->with('alert','Phone Number And password not match');
        }
        if ( Auth::check() ) {
            
            return redirect('/admin/home');
        }
    }

    public function check()
        {
            return ! is_null($this->user());
        }

    public function register_buyer_submit(UserRequest $request){

        $user_data = $this->store($request,'buyer',4); // can be found in traits/UserCreate
        
        if($user_data){
            return redirect()->route('company/add', $user_data->id);
        }

        return back();

    }


    public function company_unregister(Request $request){
        $this->validate($request, [
            'organization_name' => 'required',
			'cnic_number' => 'required',
            'registered_address' => 'required',
            'delivery_address' => 'required',
            'landline_number' => 'required',
         ]);

         if($request->hasfile('logo')) { 
            $file = $request->file('logo');
           
               $fileName = time().rand(0, 1000).pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
               $name = $fileName.'.'.$file->getClientOriginalExtension();
               $file->move(public_path('product_images'),$name);
               
               $image_name =  $name;
        }else{
               $image_name = null;
           }

           if($request->hasfile('cnic_front_image')) { 
            $file_2 = $request->file('cnic_front_image');
           
               $fileName_2 = time().rand(0, 1000).pathinfo($file_2->getClientOriginalName(), PATHINFO_FILENAME);
               $name_2 = $fileName_2.'.'.$file_2->getClientOriginalExtension();
               $file_2->move(public_path('cnic_images'),$name_2);
               
               $cnic_front_image =  $name_2;
        }else{
               $cnic_front_image = null;
           }


           if($request->hasfile('cnic_back_image')) { 
            $file_3 = $request->file('cnic_back_image');
           
               $fileName_3 = time().rand(0, 1000).pathinfo($file_3->getClientOriginalName(), PATHINFO_FILENAME);
               $name_3 = $fileName_3.'.'.$file_3->getClientOriginalExtension();
               $file_3->move(public_path('cnic_images'),$name_3);
               
               $cnic_back_image =  $name_3;
        }else{
               $cnic_back_image = null;
           }


           $arr = [
            'comapny' => "unregistered", 
            'user_type' => $request->user_type,
            'logo' => $image_name,
            'cnic_front_image' => $cnic_front_image,  
            'cnic_back_image' => $cnic_back_image,
            'organization_name' => $request->organization_name, 
            'cnic_number'=> $request->cnic_number,
            'registered_address'=> $request->registered_address,
            'delivery_address'=> $request->delivery_address,
            'landline_number' => $request->landline_number,
            'user_id' => auth()->user()->id ?? $request->user_id,
            'created_at'=> date('Y-m-d h:i:s')
           ];

         $last_id = DB::table('comapny')->insertGetId($arr);

        return redirect()->route('interest/add', $arr['user_id']);
    }

    public function update_company_type($user_id,$request)
    {

        return  DB::table('comapny')
                ->where('user_id',$user_id)
                ->update([
                    'company_type' => (','.implode(',',$request->intreset_id).','), 
                    'updated_at'=> date('Y-m-d h:i:s')
                ]);
        
    }

    public function company_interest_add(Request $request){

        $user_id = auth()->user()->id ?? $request->user_id;

        $this->update_company_type($user_id,$request);

        $company_data = DB::table('comapny')->where('user_id', $user_id)->first();

        $user_data = DB::table('users')->where('id', $user_id)->first();
        
        $arr = [
            'phone_number' => $user_data->phone_number,
            'password' => Session::get('temp_password')
        ];
        
        if (Auth::attempt ( $arr )) { 
            session (['id' => $user_id]); 
            
        }

        return redirect('admin/home')->with('alert', 'Profile has been updated!');
    }
    public function seller_interest_add(Request $request){
        
        DB::table('users')
            ->where('id',auth()->user()->id)
            ->update([
                'field_of_interest' => implode(',',$request->intreset_id), 
             ]);
            return redirect('admin/home')->with('success', 'Field of intrest has been updated!');
       
        }
       
        public function insert_relation(Request $request){
                $seller_data = DB::table('comapny')
                ->where('id',$request->id)
                ->first();
                $agent = DB::table('saller_agent')
                ->where('created_by',$seller_data->user_id)
                ->first();
                
                DB::table('relation')
                ->insert(
                    [
                     'buyer_id' => auth()->user()->id,
                     'buyer_company_id' => Session::get('company_id'),
                     'seller_id' => $seller_data->user_id,
                     'seller_company_id' => $request->id, 
                     'status' => "pending",
                     'pending_date_time' => date('Y-m-d h:i:s'),
                     'created_on' => date('Y-m-d h:i:s'),
                     ]
                );

                if(!empty($agent)){
                    DB::table('agent_assign_company')
                    ->insert(
                        [
                         'agent_id' => $agent->agent_id,
                         'company_id' => Session::get('company_id'),
                         'is_verified' => 0,
                         ]
                    );  
                }


                echo "success";

         }
        public function show_modal_company(Request $request){
                    $comapny = DB::table('comapny')
                      ->where('id',$request->id)
                      ->first();
                  if($comapny->comapny == "registered"){
                    $register_name = $comapny->company_name;
                  }else{
                    $register_name = $comapny->organization_name;
                  }

                  if(empty($comapny->logo)){
                    $image = '<img src="'.url('/theme/images/levis.png').'" style="width: 100%;">';
                  }else{
                    $image = '<img src="'.url('/product_images/'.$comapny->logo).'" style="width: 100%;">';
                  }
                    

                   $html = '';
                   $html .= '<div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Subscription</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>
                 <div class="modal-body">
                 <div class="row">
                 <div class="col-md-8">
                 <div class="row" style="border: 1px solid #ccc; border-radius: 10px;">
                             <div class="col-md-3" style="padding: 12px; padding-left: 10px;">
                             '.$image.'                             </div>
                             <div class="col-md-9" style="padding: 5px;">
                               <h4>'.$register_name.'</h4>
                               <p>'.$comapny->comapny.'</p>
                             </div>
                  </div>
                  </div>
                  </div>
                   <br/>
                   <h6>Note</h6>
                   <p>if you subscribe to this company your personal detail shall be shared to the company for subscription.</p>
                 </div>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   <button type="button" class="btn btn-primary" onclick="InsertRelationData('.$comapny->id.')">Save changes</button>
                 </div>
           ';

                    
                echo $html;

        }

        public function show_modal_payment(Request $request){
            $payment = DB::table('payment')
              ->where('id',$request->id)
              ->first();
           
            

           $html = '';
           $html .= '<div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Payment Details</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
         <table class="table table-bordered table-striped">
  
            <tbody>
                <tr>
                <th style="width:40%;">Total Payment</th>
                <td style="width:60%;">'.$payment->total_payment.'</td>
                </tr>
                <tr>
                <th style="width:40%;">Tax Detection</th>
                <td style="width:60%;">'.$payment->tax_detection.'</td>
                </tr>
                <tr>
                <th style="width:40%;">Adjustement Amount</th>
                <td style="width:60%;">'.$payment->adjustement_amount.'</td>
                </tr>
                <tr>
                <th style="width:40%;">Cheque Amount</th>
                <td style="width:60%;">'.$payment->cheque_amount.'</td>
                </tr>
                <tr>
                <th style="width:40%;">Cheque Number</th>
                <td style="width:60%;">'.$payment->cheque_number.'</td>
                </tr>
                <tr>
                <th style="width:40%;">Cheque Date</th>
                <td style="width:60%;">'.$payment->cheque_date.'</td>
                </tr>
                <tr>
                <th style="width:40%;">Bank Name</th>
                <td style="width:60%;">'.$payment->bank.'</td>
                </tr>
                <tr>
                <th style="width:40%;">Paid Amount</th>
                <td style="width:60%;">'.$payment->final_amount.'</td>
                </tr>
                <tr>
                <th style="width:40%;">Download Invoice</th>
                <td style="width:60%;"><a href="'.route('download/payment/PDF',$payment->invoice_id).'"><i class="fa fa-download" style="font-size: 17px; color: #01cc84;"></i></a></td>
                </tr>
            </tbody>
</table>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
         ';

            
        echo $html;

    }

        public function cnic_verification($id){
        $company_data = DB::table('comapny') 
            ->where('id',$id)
            ->first();
            return view('admin.company.verification_cnic',compact('company_data'));
        }

        public function company_verify_account ($id){
            return view('admin.company.verification_company',compact('id')); 
        }

        public function company_verification_add(Request $request){
         DB::table('agent_assign_company')
          ->where('company_id',$request->company_id)
          ->update([
            'is_verified' => 1, 
         ]);
         DB::table('relation')
          ->where('buyer_company_id',$request->company_id)
          ->where('seller_id',auth()->user()->id)
          ->update([
            'status' => "approved", 
         ]);
         return redirect('admin/home')->with('success', 'Company verified Seuccessfully!');
        }

        public function show_inner_modal_html_company(Request $request){

                        $comapny = DB::table('comapny')
                        ->where('id',$request->id)
                        ->first();
                        

                        $agent_assign_company = DB::table('agent_assign_company')
                        ->where('company_id',$comapny->id)
                        ->first();

                    if($agent_assign_company->is_verified == 0){
                        $verify ='<button class="btn btn-danger" style="background: #c5082b; margin-top: 32px;"><i class="fa fa-check"></i>Not Verified</button>';
                    }else{
                        $verify ='<button class="btn btn-primary" style="margin-top: 32px;"><i class="fa fa-check"></i> Verified</button>';
                    }

                    if($agent_assign_company->is_verified == 0){
                        $show_button = '<a href="'.route('company/verify/sales_agent',$comapny->id).'" class="btn btn-primary" style="color:#fff;">Company Verify</a>';
                    }else{
                        $show_button = '';
                    }


                    
                    if($comapny->comapny == "registered"){
                         $company_inner_details = '<p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Company name: <span style="color: #828282;">'.$comapny->company_name.'</span></p>
                        <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Company type: <span style="color: #828282;">'.$comapny->comapny.'</span></p>
                        <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Cell Number: <span style="color: #828282;">'.$comapny->landline_number.'</span></p>
                        <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Delivery Address: <span style="color: #828282;">'.$comapny->delivery_address.'</span></p>
                        <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Registered Address: <span style="color: #828282;">'.$comapny->registered_address.'</span></p>
                        <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Registered Address: <span style="color: #828282;">'.$comapny->registered_address.'</span></p>
                        <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">NTN Number: <span style="color: #828282;">'.$comapny->ntn_number.'</span></p>';
                    }else{
                        $company_inner_details = '  <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Company name: <span style="color: #828282;">'.$comapny->organization_name.'</span></p>
                        <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Company type: <span style="color: #828282;">'.$comapny->comapny.'</span></p>
                        <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Cell Number: <span style="color: #828282;">'.$comapny->landline_number.'</span></p>
                        <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Delivery Address: <span style="color: #828282;">'.$comapny->delivery_address.'</span></p>
                        <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Registered Address: <span style="color: #828282;">'.$comapny->registered_address.'</span></p>';
                        
                        }

                        if($comapny->comapny == "registered"){
                         $protect = '<i class="fas fa-shield-alt" aria-hidden="true" style="font-size: 21px;color: #01cc84;"></i>';
                        }else{
                            $protect = '<i class="fas fa-shield-alt" aria-hidden="true" style="font-size: 21px;"></i>';
                        } 

                    if(empty($comapny->logo)){
                        $image = '<img src="'.url('/theme/images/levis.png').'" style="width: 100px;">';
                    }else{
                        $image = '<img src="'.url('/product_images/'.$comapny->logo).'" style="width: 100px;">';
                    }
                        

                    $html = '';
                    $html .= '<div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Company Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <div class="image_conatainer">'.$image.'</div>
                    <hr/>
                <div class="row">
                
                <div class="col-md-9">
                '.$company_inner_details.'
                </div>
                
                <div class="col-md-3 text-center">
                '.$protect.'
                <br/>
                '.$verify.'
                </div>
                </div>
                <hr/>
                '.$show_button.'
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                    </div>';

                        
                    echo $html;
                    die;

            }

            public function block_user(Request $request){
              DB::table('users')
                ->where('id',$request->id)
                ->update([
                    'status'=>0
                ]);
            echo "User Block Successfully";    
            }

            public function unblock_block_user(Request $request){
                DB::table('users')
                  ->where('id',$request->id)
                  ->update([
                      'status'=>1
                  ]);
              echo "User Block Successfully";    
              }

            public function edit_user_data(Request $request){
                $this->validate($request, [
                    'user_id' => 'required', 
                    'user_name' => 'required',
                    'user_email' => 'required',
                    'user_phone_number' => 'required',
                ]);

                DB::table('users')
                  ->where('id',$request->user_id)
                  ->update([
                        'name'=>$request->user_name,
                        'email'=>$request->user_email,
                        'phone_number'=>$request->user_phone_number,
                  ]);

                  return redirect('admin/home')->with('success', 'User edit successfully!');

            }

            public function show_inner_modal_html_company_seller(Request $request){


                $comapny = DB::table('comapny')
                ->where('id',$request->id)
                ->first();

                // return json_encode($comapny);
                

                $agent_assign_company = DB::table('agent_assign_company')
                ->where('company_id',$comapny->id)
                ->first();

                


                $all_agent = DB::table('saller_agent')
                ->where('created_by',auth()->user()->id)
                ->get();

                // return json_encode($all_agent);
                
                foreach($all_agent as $all_agents){
                    $agent_options = '<option value="'.$all_agents->agent_id.'">'.$all_agents->agent_name.'</option>';
                }

            if($agent_assign_company->is_verified == 0){
                $verify ='<button class="btn btn-danger" style="background: #c5082b; margin-top: 32px;"><i class="fa fa-check"></i>Not Verified</button>';
            }else{
                $verify ='<button class="btn btn-primary" style="margin-top: 32px;"><i class="fa fa-check"></i> Verified</button>';
            }

            if($agent_assign_company->is_verified == 0){
                $show_button = '<a href="'.route('company/verify/sales_agent',$comapny->id).'" class="btn btn-primary" style="color:#fff;">Company Verify</a>';
            }else{
                $show_button = '';
            }


            
            if($comapny->comapny == "registered"){
                 $company_inner_details = '<p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Company name: <span style="color: #828282;">'.$comapny->company_name.'</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Company type: <span style="color: #828282;">'.$comapny->comapny.'</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Cell Number: <span style="color: #828282;">'.$comapny->landline_number.'</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Delivery Address: <span style="color: #828282;">'.$comapny->delivery_address.'</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Registered Address: <span style="color: #828282;">'.$comapny->registered_address.'</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Registered Address: <span style="color: #828282;">'.$comapny->registered_address.'</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">NTN Number: <span style="color: #828282;">'.$comapny->ntn_number.'</span></p>';
            }else{
                $company_inner_details = '  <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Company name: <span style="color: #828282;">'.$comapny->organization_name.'</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Company type: <span style="color: #828282;">'.$comapny->comapny.'</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Cell Number: <span style="color: #828282;">'.$comapny->landline_number.'</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Delivery Address: <span style="color: #828282;">'.$comapny->delivery_address.'</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Registered Address: <span style="color: #828282;">'.$comapny->registered_address.'</span></p>';
                
                }

                if($comapny->comapny == "registered"){
                 $protect = '<i class="fas fa-shield-alt" aria-hidden="true" style="font-size: 21px;color: #01cc84;"></i>';
                }else{
                    $protect = '<i class="fas fa-shield-alt" aria-hidden="true" style="font-size: 21px;"></i>';
                } 

            if(empty($comapny->logo)){
                $image = '<img src="'.url('/theme/images/levis.png').'" style="width: 100px;">';
            }else{
                $image = '<img src="'.url('/product_images/'.$comapny->logo).'" style="width: 100px;">';
            }
                

            $html = '';
            $html .= '<div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Company Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="image_conatainer">'.$image.'</div>
            <hr/>
        <div class="row">
        
        <div class="col-md-9">
        '.$company_inner_details.'
        </div>
        
        <div class="col-md-3 text-center">
        '.$protect.'
        <br/>
        '.$verify.'
        </div>
        </div>
        <hr/>
        '.$show_button.'
            </div>
            <div style="padding:5px;">
        <div class="row">
            <div class="col-md-10">
                    <form class="form-inline" action="'.route("agent_assign_change").'" method="POST">
                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                    <input type="hidden" name="assign_company_data" value="'. $agent_assign_company->id .'">
                    <div class="form-group mx-sm-3 mb-4">
                        <select class="form-control" name="agent_id" id="agent_id">
                        <option>Select Agent</option>
                        '.$agent_options.'
                        </select>
                        </div>
                    <input type="submit" class="btn btn-primary mb-4" value="Assign Different Agent">
                    </form>
            </div>
            <div class="col-md-2">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
            
            </div>';

                
            echo $html;
            

    }

    public function show_inner_modal_html_company_buyer(Request $request){
        $comapny = DB::table('comapny')
                ->where('id',$request->id)
                ->first();

        $assign_company_data = DB::table('agent_assign_company')
                ->select('agent_assign_company.*','saller_agent.agent_name','saller_agent.agent_email','saller_agent.agent_phone','saller_agent.discount_percentage')
                ->join('saller_agent','agent_assign_company.agent_id', '=','saller_agent.agent_id')
                ->where('agent_assign_company.company_id',$request->id)
                ->first();

        $all_agent = DB::table('saller_agent')
              ->where('created_by',auth()->user()->id)
              ->get();
        foreach($all_agent as $all_agents){
            $agent_options = '<option value="'.$all_agents->agent_id.'">'.$all_agents->agent_name.'</option>';
        }
        


                $agent_data = '<p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Agent name: <span style="color: #828282;">'.$assign_company_data->agent_name.'</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Agent Email: <span style="color: #828282;">'.$assign_company_data->agent_email.'</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Agent Cell Number: <span style="color: #828282;">'.$assign_company_data->agent_phone.'</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Discount Allow: <span style="color: #828282;">'.$assign_company_data->discount_percentage.'%</span></p>';

                if($comapny->comapny == "registered"){
                    $company_inner_details = '<p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Company name: <span style="color: #828282;">'.$comapny->company_name.'</span></p>
                   <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Company type: <span style="color: #828282;">'.$comapny->comapny.'</span></p>
                   <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Cell Number: <span style="color: #828282;">'.$comapny->landline_number.'</span></p>
                   <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Delivery Address: <span style="color: #828282;">'.$comapny->delivery_address.'</span></p>
                   <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Registered Address: <span style="color: #828282;">'.$comapny->registered_address.'</span></p>
                   <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Registered Address: <span style="color: #828282;">'.$comapny->registered_address.'</span></p>
                   <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">NTN Number: <span style="color: #828282;">'.$comapny->ntn_number.'</span></p>';
               }else{
                   $company_inner_details = '  <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Company name: <span style="color: #828282;">'.$comapny->organization_name.'</span></p>
                   <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Company type: <span style="color: #828282;">'.$comapny->comapny.'</span></p>
                   <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Cell Number: <span style="color: #828282;">'.$comapny->landline_number.'</span></p>
                   <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Delivery Address: <span style="color: #828282;">'.$comapny->delivery_address.'</span></p>
                   <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Registered Address: <span style="color: #828282;">'.$comapny->registered_address.'</span></p>';
                   
                   }
   
                   if($comapny->comapny == "registered"){
                    $protect = '<i class="fas fa-shield-alt" aria-hidden="true" style="font-size: 21px;color: #01cc84;"></i>';
                   }else{
                       $protect = '<i class="fas fa-shield-alt" aria-hidden="true" style="font-size: 21px;"></i>';
                   } 
   
               if(empty($comapny->logo)){
                   $image = '<img src="'.url('/theme/images/levis.png').'" style="width: 100px;">';
               }else{
                   $image = '<img src="'.url('/product_images/'.$comapny->logo).'" style="width: 100px;">';
               }

               $html = '';
            $html .= '<div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Company Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="row">
            <div class="col-md-8">
            <div class="image_conatainer">'.$image.'</div>
            </div>
            <div class="col-md-4 text-right">
            '.$protect.'
            </div>
            </div>
            <hr/>
                <div class="row">
                
                    <div class="col-md-6">
                    <h4>Buyer Company Details:</h4>
                    '.$company_inner_details.'
                    </div>
                
                    <div class="col-md-6">
                    <h4>Assign Sales Agent Details:</h4>
                    '.$agent_data.'
                    </div>
                </div>
        
         </div>
         <hr/>
        <div style="padding:5px;">
        <div class="row">
        <div class="col-md-10">
            <form class="form-inline" action="'.route("agent_assign_change").'" method="POST">
            <input type="hidden" name="_token" value="'. csrf_token() .'">
            <input type="hidden" name="assign_company_data" value="'. $assign_company_data->id .'">
            <div class="form-group mx-sm-3 mb-4">
                <select class="form-control" name="agent_id" id="agent_id">
                <option>Select Agent</option>
                '.$agent_options.'
                </select>
                </div>
            <input type="submit" class="btn btn-primary mb-4" value="Assign Different Agent">
            </form>
        </div>
        <div class="col-md-2">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
            
            </div>';

                
            echo $html;
            

       // print_r($comapny);die;
    }

        public function agent_assign_change(Request $request){
        DB::table('agent_assign_company')
          ->where('id',$request->assign_company_data)
          ->update(array(
          'agent_id' => $request->agent_id
          ));

          return redirect('buyer_list')->with('success', 'Agent updated successfully!');
        }

         public function company_edit($id){
           $company = DB::table('comapny')
              ->where('id',$id)
              ->first();
           return view('admin.company.edit',compact('company'));
         }

         public function copy_inventory_for_inventory(Request $request){
          $prents_company_id = $request->company_id;
          return view('admin.inventory.export',compact('prents_company_id'));
         }

        public function unregister_edit(Request $request){
            $this->validate($request, [
                'organization_name' => 'required',
                'cnic_number' => 'required',
                'registered_address' => 'required',
                'delivery_address' => 'required',
                'landline_number' => 'required',
             ]);

             if($request->hasfile('logo')) { 
                $file = $request->file('logo');
               
                   $fileName = time().rand(0, 1000).pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                   $name = $fileName.'.'.$file->getClientOriginalExtension();
                   $file->move(public_path('product_images'),$name);
                   
                   $image_name =  $name;
                }else{
                    $image_data = DB::table('comapny')
                        ->where('id',$request->company_id)
                        ->first();
                   $image_name = $image_data->logo;
               }

    
             DB::table('comapny')
             ->where('id',$request->company_id)
             ->update([
                 'comapny' => "unregistered", 
                 'organization_name' => $request->organization_name,
                 'logo' => $image_name, 
                 'cnic_number'=> $request->cnic_number,
                 'registered_address'=> $request->registered_address,
                 'delivery_address'=> $request->delivery_address,
                 'landline_number' => $request->landline_number,
                 'updated_at'=> date('Y-m-d h:i:s')
              ]);

              return redirect('admin/home')->with('success', 'Company has been updated!');
         }

         public function field_of_interest_edit($id){
            $company = DB::table('comapny')
               ->where('id',$id)
               ->first();
            return view('admin.company.edit_field_of_interest',compact('company'));
          }

        public function company_interest_edit_submit(Request $request){
            DB::table('comapny')
            ->where('id',$request->company_id)
            ->update([
                'company_type' => ','.implode(',',$request->intreset_id).',', 
                'updated_at'=> date('Y-m-d h:i:s')
             ]);
             return redirect('admin/home')->with('success', 'Field of interest updated successfully!');
          }

        public function request_for_buyer()
            {
        $buyer_request = DB::table('relation')
            ->select('relation.*','users.phone_number','comapny.comapny','comapny.organization_name','comapny.landline_number','comapny.ntn_number','comapny.strn_number','comapny.company_name as buyer_name','comapny.user_id as user_id','users.name as user_name')
            ->join('comapny','relation.buyer_company_id', '=', 'comapny.id')
            ->join('users','comapny.user_id', '=', 'users.id')
            ->where('relation.status','pending')
            ->where('seller_id',auth()->user()->id)
            ->where('seller_company_id',Session::get('company_id'))
            ->get();
                
                return view('admin.company.request_for_seller',compact('buyer_request'));
            }

         
        public function status_update_realation(Request $request){
           DB::table('relation')
            ->where('id',$request->id)
            ->update(
                ['status' => "approved",
                 'approved_date_time' => date('Y-m-d h:i:s'),]
            );

            echo "success";
         }
         public function status_reject_realation(Request $request){
            DB::table('relation')
             ->where('id',$request->id)
             ->update(
                 ['status' => "rejected",]
             );
 
             echo "success";
          }
        public function view_store($id){
            return view('admin.company.view_inventory_buyer',compact('id'));
        }

        public function view_cart($id){
        return view('admin.company.view_card_item',compact('id'));
        }

        public function get_cart_data(Request $request){

            // return $request->data;

            if($request->data){
                $total_amout = 0;
                $discount_amount = 0;
                foreach($request->data as $data){
                    $product = DB::table('product')
                        ->select('product.*','sku_code.name as sku_code_name')
                        ->join('sku_code','sku_code.id','product.skucode')
                        ->where('product.id',$data['product_id'])
                        ->get()
                        ->first();

                        // return json_encode($product);
                        $total_amout += $product->discount_price*$data['quantity'];
                        $discount_amount += $product->acutal_price*$data['quantity'];
                        $image_data = explode(',',$product->images);
                        if(isset($product->images)){
                          $img ='<img class="img custome_image" src="'.url('product_images').'/'.$image_data[0].'" >';
                        }else{
                            $img = '<img class="custome_image" src="'.url('product_images/product-image-dummy.jpg').'">';
                        }
                        $html = '
                        <div class="col-2 text-center">
                          
                          '.$img.'
                        </div>
                        <div class="col-9">
                          <div class="card">
                            <div class="card-body">
                              <div class="row center-div">
                                  <div class="col">
                                      <table>
                                          <tr><th>'.$product->name.'</th></tr>
                                              <tr><td>'.$product->discription.'</td></tr>
                                          
                                      </table>
                                  </div>
                                  <div class="col">
                                    <table>
                                        <tr><th>Packing</th></tr>
                                            <tr><td>'.$product->sku_code_name.'</td></tr>
                                        
                                    </table>
                                  </div>
                                  <div class="col">
                                    <table>
                                        <tr><th>PKR</th></tr>
                                            <tr><td>'.number_format($product->discount_price).'</td></tr>
                                        
                                    </table>
                                  </div>
                                  <div class="col">
                                    <table>
                                        <tr><th>Quantity</th></tr>
                                            <tr><td>'.$data['quantity'].'</td></tr>
                                        
                                    </table>
                                  </div>
                                  <div class="col">
                                    <table>
                                        <tr><th>Sales Tax</th></tr>
                                            <tr><td>10%</td></tr>
                                        
                                    </table>
                                  </div>
                                  <div class="col">
                                    <table>
                                        <tr><th>Total</th></tr>
                                            <tr><td>'.number_format($product->discount_price*$data['quantity']).'</td></tr>
                                        
                                    </table>
                                  </div>
                              </div>
                              
                            </div>
                          </div>
                        </div>
                        <div class="col-1">
                               <i class="fa fa-trash delete_card_item delete_icon" onclick="DeleteCart('.$product->id.')"></i>
                      </div>';
		                echo $html;
                }
                $dedacted_amount = $discount_amount-$total_amout;
                $sales_tax = ($total_amout/100)*10;
                $ST = $sales_tax+$total_amout;
                $html_2= '
                <div class="col-sm-8"></div>
                <div class="col-sm-4" style="text-align: right;">
                <h4>Total - RS '.number_format($total_amout).'</h4><br/>
                <h4>Discount - RS '.number_format($dedacted_amount).'</h4><br/>
                <h4>Sales Tax - RS '.number_format($sales_tax).'</h4><br/>
                <h4>Total with ST - RS '.number_format($ST).'</h4><br/>
                        </div>';
                echo $html_2;

            }else{
                $html = '<h5 style="background: #fff;">No Data Found Please select items</h5>';
	            echo $html;
            }
        }

        public function create_order(Request $request){

            $product_data = json_decode($request->order_details);

            $total_price = 0;
            foreach($product_data as $p){
                $product = DB::table('product') 
                    ->where('id', $p->product_id)
                    ->first();
                    $total_price += $product->discount_price*$p->quantity;
            }
            $sales_tax = ($total_price/100)*10;
            $total_price_with_ST = $total_price+$sales_tax;

            DB::beginTransaction();

            try {
                $order_inserted = DB::table('order')->insertGetId([
                    'is_paid' => 0,
                    'is_recived' =>0,
                    'is_delivered' =>0,
                    'total_price' => $total_price,
                    'total_price_with_ST' => $total_price_with_ST,
                    'comapny_id' => $request->company_id,
                    'seller_id' => $request->seller_id,
                    'seller_company_id' => $request->seller_company_id,
                    'buyer_id' => $request->buyer_id,
                    'created_at' => date('Y-m-d h:i:s'),
                    ]);
            
                foreach($product_data as $p){
                    DB::table('order_items')
                            ->insert(
                                [
                                'order_id' => $order_inserted, 
                                'item_id' => $p->product_id,
                                'quantity' => $p->quantity, 
                                'is_delivered' => 0,
                                'is_received' => 0,
                                'is_paid' => 0,
                                'created_at' => date('Y-m-d h:i:s'),
                                ]
                            );
                }

                DB::commit();

                return redirect()->route('admin.order.index');


         } catch (\Throwable $th) {
             //throw $th;

             $myfile = fopen("error-logs.txt", "a") or die("Unable to open file!");
             fwrite($myfile, "\n". $th->getMessage());
             fclose($myfile);

             DB::rollBack();

             return back();

         }
         
        }

        public function company_list(){
            $company = DB::table('comapny')
              ->select('comapny.*','users.name as user_name')
              ->join('users','comapny.user_id','=','users.id')
              ->where('comapny.user_type','seller')
              ->get();
            
            return view('auth.company_list',compact('company'));
        }

        public function active_inventory(Request $request)
        {
           
              DB::table('product')
              ->where('id',$request->id)
              ->update([
                'is_show'=>0
                ]);
              echo"status is deactive";
        }

        public function deactive_inventory(Request $request)
        {
            DB::table('product')
              ->where('id',$request->id)
              ->update([
                'is_show'=>1
                ]);
              echo"status is active"; 
        }

}
