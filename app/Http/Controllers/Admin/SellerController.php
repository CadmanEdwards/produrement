<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\User;
use App\Company;
use App\SellerAgentCompanyAssign;
use App\SellerAgent;
use App\Order;
use Auth;
use Session;
use App\Invoice;
use App\SaleAgreement;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use Illuminate\Support\Facades\Hash;
use PDF;

class SellerController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $users = User::whereHas("roles", function($q) {
            $q->where("name",'!=', "administrator")
            ->Where("name", "Seller");
            })->get();
        return view('admin.seller.index', compact('users'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $roles = Role::where("name",'!=', "administrator")
        ->where("name", "seller")
        ->get()->pluck('name', 'name');

        return view('admin.seller.create', compact('roles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $user = User::create($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->assignRole($roles);

        return redirect()->route('admin.seller.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri_segments = explode('/', $uri_path);
        

        $user = User::where('id',$uri_segments[5])->first();
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $roles = Role::where("name",'!=', "administrator")
        ->where("name", "Seller")
        ->get()->pluck('name', 'name');

        return view('admin.seller.edit', compact('user', 'roles'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, User $user)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $user->update($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->syncRoles($roles);

        return redirect()->route('admin.seller.index');
    }

    public function sales_agent(){

        $users = User::Select('users.*','s.discount_percentage','s.area_assign','agent_id')
        ->where('s.created_by','=', auth()->user()->id)
        ->join('saller_agent as s','s.user_id','=','users.id')
        ->where('user_type', '=', 'sale_agent')
        ->orderBy('users.name')
        ->get();


        return view('admin.seller_agent.index', compact('users'));
    }

    public function sale_agent_create()
    {       
        // if (! Gate::allows('users_manage')) {
        //   return abort(401);
        // }

        $company_data = DB::table('comapny')
        ->distinct()
        ->select('comapny.*')
        ->join('relation as r','r.buyer_company_id','=','comapny.id')
        ->where('seller_id' , auth()->user()->id)
        // ->whereNotIn('r.buyer_company_id', function ($query) {
        //   $query->select('company_id')                    
        //     ->from('agent_assign_company');
        // })  

       // ->where('user_id','!=', auth()->user()->id)
        ->get();

        // return $company_data;
       
        return view('admin.seller_agent.create', compact('company_data'));
    }

    public function sale_agent_submit(Request $request)
    {        
        /* if (! Gate::allows('users_manage')) {
            return abort(401);
        }*/

        

        $this->validate($request, [
            'password' => 'required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            'phone_number' => 'required|unique:users',
            'email' => 'required|email|unique:users',
          //  'assign_company' => 'required'     
         ]);        

        $image_name = null;
        if($request->image) 
        {
            $fileName = time().pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            $name = $fileName.'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('profile_image'),$name);
            $image_name =  $name;
        }      

        $user = User::create([
                'email'=> $request->email,
                'name' => $request->name,
                'password' => Hash::make($request->password), 
                'phone_number' => $request->phone_number,
                'user_type' => 'sale_agent',
            ]
        );  

        // geting last id
        $last_user_id = $user->id;

        DB::table('model_has_roles')->insert(
            ['role_id' => 5, 
            'model_type' => "App\User", 
            'model_id' => $last_user_id]
        );
        
        /// assign group to user
        $user->assignRole($request->input('roles')); 

        //// inserting agant data ///
        $seller  = SellerAgent::create([
            'agent_name' => $request->name,
            'agent_email' =>$request->email,
            'agent_phone' =>$request->phone_number,
            'discount_percentage'=> $request->discount_percentage,
            'assign_area_lat' => $request->lat,
            'assign_area_long' => $request->lng,
            'display_image' => $image_name,
            'area_assign' => $request->area_assign,
            'user_id' => $last_user_id,
            'created_by' =>  auth()->user()->id,
        ]);

        $agent_id = $seller->agent_id;
        if(!empty($request->assign_company)){
            foreach ( $request->assign_company as $key => $com_id) {
                SellerAgentCompanyAssign::create([  
                        'company_id' => $com_id,
                        'agent_id' => $agent_id,
                ]
                );

                //// updating relation table to remove from request pending///
                DB::table('relation')
                ->where('buyer_company_id', $com_id)
                ->update(['status' => 'approved']);

                }
        }

        return redirect()->route('sales/agent');
    }

    public function edit_seller($id){
        
        $roles = Role::where("name",'=', "Sale Agent")        
        ->get()->pluck('name', 'name');

        $user = User::join('saller_agent','saller_agent.user_id','=','users.id')
        ->find($id);

        $ar = SellerAgentCompanyAssign::SELECT('agent_assign_company.company_id')
        ->join('saller_agent as a','a.agent_id','=','agent_assign_company.agent_id')
        ->where('user_id', $id)->get()->toArray();   

        $agent = DB::table('saller_agent')->where('user_id','=',$id)->first();        
        
        $company_assign= array();
        foreach ($ar as $key => $com) {
            $company_assign[] = $com['company_id'];
        }        

        return view('admin.seller_agent.edit', compact('roles','user','company_assign','agent'));
    }       

    public function sale_agent_edit_submit(Request $request)
    {        
        /* if (! Gate::allows('users_manage')) {
            return abort(401);
        }*/   

        $this->validate($request, [        
           // 'phone_number' => 'required|unique:users,phone_number,'. $request->user_id,
           // 'email' => 'required|email|unique:users,email,'. $request->user_id,
            'assign_company' => 'required'     
        ]);     

        if(isset($request->change_password)){
            $this->validate($request, [
                'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'required|min:6',           
            ]);     
        }   

        $update_array = array(
            'agent_name' => $request->name,
            'agent_email' =>$request->email,
            'agent_phone' =>$request->phone_number,
            'discount_percentage'=> $request->discount_percentage,
            'assign_area_lat' => $request->lat,
            'assign_area_long' => $request->lng,            
        );

        $image_name = null;
        if($request->image) 
        {
            $fileName = time().pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            $name = $fileName.'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('profile_image'),$name);
            $image_name =  $name;

            $update_array['display_image'] = $image_name;
        }    

        $user_array = array(
            'email'=> $request->email,
            'name' => $request->name,            
            'phone_number' => $request->phone_number,                
        );  

        if(isset($request->change_password)){
            $user_array['password'] = Hash::make($request->password); 
        }

        //// updating user array ////
        $user = User::where('id' , $request->user_id) ->update($user_array );  

        // geting last id
        $last_user_id = $request->user_id;
        
        //// inserting agant data ///
        $seller  = SellerAgent::where('user_id' , $request->user_id)->update($update_array);

        $agent_id = $request->agent_id;

        $asigns = SellerAgentCompanyAssign::where('agent_id', $agent_id)->get()->toArray();

        //// deleting old ////////
        SellerAgentCompanyAssign::where('agent_id', $agent_id)->delete();

        foreach ( $request->assign_company as $key => $com_id) {
            $flag=0;
            foreach ($asigns as $key => $dta) {
                if($dta['company_id'] == $com_id){
                    $flag = $dta['is_verified'];
                } 
            }
            SellerAgentCompanyAssign::create([  
                    'company_id' => $com_id,
                    'agent_id' => $agent_id,
                    'is_verified' => $flag
               ]
            );

             //// updating relation table to remove from request pending///
            DB::table('relation')
            ->where('buyer_company_id', $com_id)
            ->update(['status' => 'approved']);
        }

        return redirect()->route('sales/agent');
    }

    public function show(User $user)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $user->load('roles');

        return view('admin.seller.show', compact('user'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $user->delete();

        return redirect()->route('admin.seller.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        User::whereIn('id', request('ids'))->delete();
        return response()->noContent();
    }

    public function agentDestroy($id)
    { 
        $agent = DB::table('saller_agent')->where('user_id',$id)->first();
        $assign_com_ids= DB::table('agent_assign_company')->where('agent_id',$agent->agent_id)->get();

        if(!empty($assign_com_ids)){
            foreach ($assign_com_ids as $key => $dta) {
                ///// updating relation table to remove from request pending///
                DB::table('relation')
                ->where('buyer_company_id', $dta-> company_id)
                ->update(['status' => 'pending']);
            }    
        }

        DB::table('saller_agent')->where('agent_id',$agent->agent_id)->delete();
        DB::table('agent_assign_company')->where('agent_id',$agent->agent_id)->delete();
        User::find($id)->delete();
        return redirect()->route('sales/agent')->with('success','Sales Agent has been deleted successfully.');
    }
    
    public function view_buyer(){

        $confirm_data = DB::table('users')
        ->select('users.*','comapny.landline_number','comapny.ntn_number','comapny.strn_number','comapny.company_name as buyer_name','comapny.user_id as user_id','users.name as user_name')
        ->join('comapny','users.id', '=', 'comapny.user_id')
        ->where('created_by',auth()->user()->id)
        ->get();

        return view('admin.seller_agent.view_buyer',compact('confirm_data'));
        
    }

    public function view_order(){

        return view('admin.seller_agent.pending_order');
    }

    public function rejected_order(){
        return view('admin.seller_agent.rejected_order');
    }

    public function view_pending_order_details($id){
        $order = DB::table('order')
        ->where('id',$id)
        ->first();

        $order_item = DB::table('delivery_items')
        ->select('delivery_items.*','product.name as product_name','product.skucode','sku_code.name as skucode_name','product.discount_price as price','product.acutal_price as acutal_price','product.images','product.discription')
        ->where('delivery_items.order_id',$order->id)
        ->where('delivery_items.is_received',0)
        ->join('product','delivery_items.item_id','=','product.id')
        ->join('sku_code','product.skucode','=','sku_code.id')
        ->get();

        $seller_data = DB::table('users')
            ->where('id',$order->seller_id)
            ->get()
            ->first();
        $show_company_2 = DB::table('comapny')
        ->where('user_id',$order->buyer_id)
        ->where('id',$order->comapny_id)
        ->first();

        return view('admin.seller_agent.view_pending_order_details', compact('order','order_item','seller_data','show_company_2'));
    }

    public function downloadDeliveryInvoice($id){    
      
        // $order = Order::with(['show_company_1','show_company_2','buyerUser','sellerUser'])->find($id);

        
        return $id;

        $order_item = DB::table('delivery_items')
            ->select('delivery_items.*','product.name as product_name','product.skucode','sku_code.name as skucode_name','product.discount_price as price','product.acutal_price as acutal_price','product.images','product.discription')
            ->where('delivery_items.order_id',$order->id)
            ->where('delivery_items.is_received',0)
            ->join('product','delivery_items.item_id','=','product.id')
            ->join('sku_code','product.skucode','=','sku_code.id')
            ->get();




        $pdf = PDF::loadView('pdf/delivery_challan_pdf',compact('order','order_item'));
        $pdf->setOptions(['isPhpEnabled' => true]);
        $pdf->setPaper('L', 'landscape');
        return $pdf->download('delivery_challan.pdf');

    }

    public function view_partially_order_details($id){
        $order = DB::table('order')
        ->where('id',$id)
        ->get()
        ->first();
        return view('admin.seller_agent.view_partially_order_details', compact('order'));
    }

    public function view_invoice_order_details($id){
        $order = DB::table('order')
        ->where('id',$id)
        ->get()
        ->first();
        $order_ids = array();
        $order_ids[] = $order->id; 
        //print_r($converted_array);die;
        return view('admin.seller_agent.view_invoice_multiple_order_details', compact('order_ids'));
   // return view('admin.seller_agent.view_invoice_order_details', compact('order'));
    }

    public function view_complete_orders_details($invoice_id){

        $invoice_order = Invoice::with(['sellerUser'])->find($invoice_id);

        $order_item = DB::table('invoice_item')
        ->select(
            DB::raw('quantity * product.discount_price as prices'),
            DB::raw('quantity * product.acutal_price as actual_prices'),
            'invoice_item.*','product.name as product_name',
            'sku_code.name as skucode_name',
            'product.discount_price as price',
            'product.acutal_price as actual_price',
            'product.images',
            'product.discription')
        
        ->where('invoice_id',$invoice_order->id)
        ->join('product','invoice_item.item_id','=','product.id')
        ->join('sku_code','product.skucode','=','sku_code.id')
        ->get();


        $total_sum_price = $order_item->sum('prices');
        $total_actual_sum_price = $order_item->sum('actual_prices');

        $discount = $total_actual_sum_price - $total_sum_price;

        $company = Company::query();
       
        $admin = (Auth::user() && Auth::user()->roles[0]->id == 5);

        $company->when($admin, function ($q) use ($invoice_order) {
             $q->where('id',$invoice_order->seller_company_id);  
             return $q;
        });

        $company->when(!$admin, function ($q) {
            $q->where('user_id',auth()->user()->id);
            $q->where('id',Session::get('company_id'));  
            return $q;
        });

        $show_company_2 = $company->first();

        return view(
            'admin.company.view_complete_order', 
            compact('invoice_order','order_item','show_company_2','total_sum_price','total_actual_sum_price','discount'));
    }

    public function view_rejected_order_details($id){
        $order = DB::table('order')
        ->where('id',$id)
        ->get()
        ->first();
    return view('admin.seller_agent.view_rejected_order_details', compact('order'));
    }

   

    public function delivered_order()
    {
        return view('admin.seller_agent.delivered_order');
    }

    public function view_cart_details($id){
        $order = DB::table('order')
        ->where('id',$id)
        ->get()
        ->first();
        return view('admin.seller_agent.view_order_details', compact('order'));
    }

    public function view_cart_half_order($id){
        $order = DB::table('order')
        ->where('id',$id)
        ->get()
        ->first();
        return view('admin.seller_agent.view_half_order_details', compact('order'));
    }

    public function invoice_order()
    {
        return view('admin.seller_agent.invoice_order');
    }

    public function complete_order()
    {
       return view('admin.seller_agent.complete_order');
    }

    public function agreement_list(){
        return view('admin.seller_agent.agreement_list');   
    }


    public function sale_agent_agreement()
    {
        return view('admin.seller_agent.agreement');
    }

    public function agreement_submit(Request $request)
    {
         $validation_array['discount_applied'] = 'required';
         $validation_array['products'] = 'required';

         if($request->discount_apply_on == 'over_all_order'){
            $validation_array['amount_more_than'] = 'required';
         }else{
            $validation_array['quantity'] = 'required';
         }

        $this->validate($request, $validation_array );

        $insert_array=   array(
            'agent_id' => $request->agent_id,
            'buyer_id'    => $request->buyer_id,
            'seller_id'    => $request->seller_id,
            'discount_applied_on' => $request->discount_apply_on,
            'discount' => $request->discount_applied,
            'if_quantity' => (($request->discount_apply_on == 'over_all_order') ? 0 : $request->quantity),
            'if_order_amount' =>(($request->discount_apply_on == 'over_all_order') ? $request->amount_more_than : 0) , 
            'items' => ','.implode(',', $request->products).',' ,
            'unique_id' => floor(time()-999999999),
        );        

        if($request->image) 
        {
            $fileName = time().pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            $name = $fileName.'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('profile_image'),$name);
            $image_name =  $name;

            $insert_array['document'] = $image_name;
        }  

        SaleAgreement::create($insert_array);
        return redirect()->route('agreement/list')->with('success','Agreement has been done successfully.');        
    }

    public function pdf_view(Type $var = null)
    {

        return view('pdf_view');

    //      $order = \DB::table('order')
    //     ->where('id',$id)
    //     ->get()
    //     ->first();
    //     $pdf = PDF::loadView('pdf2',compact('order'));
    //     $pdf->setOptions(['isPhpEnabled' => true]);
    //     $pdf->setPaper('L', 'portrait');
    //    return $pdf->download('Test.pdf');

    }
}