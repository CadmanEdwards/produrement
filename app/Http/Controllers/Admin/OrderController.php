<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Invoice;
use App\Payment;
use App\InvoiceItems;
use App\Order;
use App\Company;



use DB;
use PDF;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use Illuminate\Support\Facades\Redirect;
use Session;
use Auth;

class OrderController extends Controller
{
   
    public function index()
    {
        if (! Gate::allows('company')) {
            return abort(401);
        }

        return view('admin.company.pending_order', $this->getTabs());
    }

    public function delivered_order()
    {
        if (! Gate::allows('company')) {
            return abort(401);
        }
        return view('admin.company.delivered_order',$this->getTabs());
    }

    public function complete_order()
    {   
        
        if (! Gate::allows('company')) {
            return abort(401);
        }
        
        return view('admin.company.complete_order',$this->getTabs());
    }

    public function rejected_order(){
        if (! Gate::allows('company')) {
            return abort(401);
        }
        return view('admin.company.rejected_order',$this->getTabs());

    }
    public function invoice_order()
    {
        if (! Gate::allows('company')) {
            return abort(401);
        }
        return view('admin.company.invoice_order',$this->getTabs());
    }
    
    public function view_cart_details($id){
     $order = DB::table('order')
        ->where('id',$id)
        ->get()
        ->first();
        return view('admin.company.view_order_details', compact('order'));
    }

    public function view_invoice_order_details($id){
        $invoice_order = DB::table('invoice')
        ->where('id',$id)
        ->get()
        ->first();

        return view('admin.company.view_order_invoic', compact('invoice_order'));
        
    }

    public function view_partial_invoice_order_details($id){
        $invoice_order = DB::table('invoice')
        ->where('id',$id)
        ->get()
        ->first();

        return view('admin.company.view_partial_order_invoic', compact('invoice_order'));
        
    }

    public function view_complete_orders($id){
        $invoice_order = DB::table('invoice')
        ->where('id',$id)
        ->get()
        ->first();

        return view('admin.company.view_complete_order', compact('invoice_order'));
        
    }

    public function download_invoice_pdf($id){
        $order = DB::table('order')
        ->where('id',$id)
        ->get()
        ->first();
        //return view('pdf2', compact('order'));
        $pdf = PDF::loadView('pdf2',compact('order'));
        $pdf->setOptions(['isPhpEnabled' => true]);
        $pdf->setPaper('L', 'portrait');
       return $pdf->download('Test.pdf');
    }

         public function download_payment_invoice_pdf($id){

            $invoice = Invoice::with(['show_company_1','show_company_2','buyerUser','sellerUser'])->find($id);    
            

            $order_item = DB::table('invoice_item')
            ->select(
                DB::raw('quantity * product.discount_price as prices'),
                DB::raw('quantity * product.acutal_price as actual_prices'),
                'invoice_item.*',
                'product.name as product_name',
                'sku_code.name as skucode_name',
                'product.discount_price as price',
                'product.acutal_price as acutal_price',
                'product.images',
                'product.discription'
                )
            ->where('invoice_id',$invoice->id)
            ->join('product','invoice_item.item_id','=','product.id')
            ->join('sku_code','product.skucode','=','sku_code.id')
            ->get();

        $total_sum_price = $order_item->sum('prices');
        $total_actual_sum_price = $order_item->sum('actual_prices');
          $data = [
              'invoice' => $invoice,
              'order_item' => $order_item,
              'total_sum_price' => $total_sum_price,
              'total_actual_sum_price' => $total_actual_sum_price,
              'discount' => $total_actual_sum_price - $total_sum_price,
          ];


        $pdf = PDF::loadView('pdf/sales_tax_invoice_pdf',$data);
        $pdf->setOptions(['isPhpEnabled' => true]);
        $pdf->setPaper('L', 'landscape');
        return $pdf->download('sales_tax_invoice_pdf.pdf');
    }

    public function view_pending_order_details($id){
        $order = DB::table('order')
        ->where('id',$id)
        ->get()
        ->first();
    return view('admin.company.view_pending_order_details', compact('order'));
    }

    public function payment_add (Request $request){
        if($request->submite == "Complete Payment"){
            if($request->final_amount != $request->total_price){
            return Redirect::back()->with('danger', "Total amount not equal to your change amount please click partial amount button");
           }else{

            
            Invoice::where('id',$request->invoice_id)
            ->update([
                'is_completed' => 1
            ]);

            $payment = new Payment;
            $payment->invoice_id = $request->invoice_id;
            $payment->total_payment = $request->total_payment;
            $payment->tax_detection = $request->tax_detection;
            $payment->adjustement_amount = $request->adjustement_amount;
            $payment->cheque_amount = $request->cheque_amount;
            $payment->cheque_number = $request->cheque_number;
            $payment->cheque_date = $request->cheque_date;
            $payment->bank = $request->bank;
            $payment->final_amount = $request->final_amount;
            $payment->created_on = date('Y-m-d h:i:s');
            $payment->save();




            return redirect()->route("admin.order.index")->with('success', "Payment details add successfully");
            
           }

        }else{
            
                Invoice::where('id',$request->invoice_id)
                    ->update([
                        'is_partial' => 1
                    ]);

            $payment = new Payment;
            $payment->invoice_id = $request->invoice_id;
            $payment->total_payment = $request->total_payment;
            $payment->tax_detection = $request->tax_detection;
            $payment->adjustement_amount = $request->adjustement_amount;
            $payment->cheque_amount = $request->cheque_amount;
            $payment->cheque_number = $request->cheque_number;
            $payment->cheque_date = $request->cheque_date;
            $payment->bank = $request->bank;
            $payment->final_amount = $request->final_amount;
            $payment->created_on = date('Y-m-d h:i:s');
            $payment->save();

        return redirect()->route("admin.order.index")->with('success', "Partialy Payment recived successfully");

        }
    }

    public function payment_partial_add (Request $request){

        $payment = Payment::where('invoice_id',$request->invoice_id)
                ->sum('final_amount');

        if($payment+$request->final_amount > $request->total_price){
            return Redirect::back()->with('danger', "Your amount is greater then your order amount");
            }


                if($payment+$request->final_amount == $request->total_price){
                    Invoice::where('id',$request->invoice_id)
                    ->update([
                        'is_completed' => 1,
                        'is_partial' => 0
                    ]);
                    }else{
                        Invoice::where('id',$request->invoice_id)
                        ->update([
                            'is_partial' => 1
                        ]); 
                    }

            
            

            $payment = new Payment;
            $payment->invoice_id = $request->invoice_id;
            $payment->total_payment = $request->total_payment;
            $payment->tax_detection = $request->tax_detection;
            $payment->adjustement_amount = $request->adjustement_amount;
            $payment->cheque_amount = $request->cheque_amount;
            $payment->cheque_number = $request->cheque_number;
            $payment->cheque_date = $request->cheque_date;
            $payment->bank = $request->bank;
            $payment->final_amount = $request->final_amount;
            $payment->created_on = date('Y-m-d h:i:s');
            $payment->save();




            return redirect()->route("admin.order.index")->with('success', "Payment details add successfully");
        
    }

    public function change_status_half_recive_items(Request $request){
        $this->validate($request, [
            'order_item' => 'required',
        ]);

          $delivery_id = DB::table('delivery')
              ->where('order_id',$request->order)
              ->first();

            
            foreach($request->order_item as $order_item){
                $item = DB::table('order_items')
                  ->where('id',$order_item)
                  ->first();

                DB::table('order_items')
                ->where('id',$order_item)
                ->update([
                    'is_delivered' => 1, 
                    'delivery_id' => $delivery_id->id
                     ]);
                DB::table('delivery_items')
                     ->insert([
                         'order_id' => $request->order,
                         'delivery_id' => $delivery_id->id, 
                         'item_id' => $item->item_id,
                         'is_received' => 0,
                         'is_delivered' => 1,
                         'created_on' => date('Y-m-d h:i:s')
                    ]);
                }
             

          $check_item_request = DB::table('order_items')
           ->where('is_delivered',0)
           ->where('order_id',$request->order)
           ->count();

                    if($check_item_request == 0){
                        DB::table('order')
                        ->where('id',$request->order)
                        ->update([
                            'is_delivered' => 1, 
                            ]);
                    }
             return redirect()->route('sales/agent/order', $request->order)->with('success', 'Your recevive item status change successfully');
    
    }

    public function change_status_recive_items(Request $request){
        
        $this->validate($request, [
            'order_item' => 'required',
        ]);
        
        if(Auth::user()->roles[0]->id == 5 || Auth::user()->roles[0]->id == 3){
        
            if($request->form_type == "Change Status Of Pending Items"){
            $order_data = DB::table('order')
              ->where('id',$request->order)
              ->first();
            if($request->form_qunatity != 1){
                $insert= DB::table('delivery')
                ->insertGetId([
                  'order_id' => $request->order , 
                  'seller_id' => $order_data->seller_id , 
                  'buyer_id' => $order_data->buyer_id, 
                  'is_paid' => 0,
                  'created_at'=> date('Y-m-d h:i:s')
                   ]);
              }
            
            foreach($request->order_item as $order_item){
                $item = DB::table('order_items')
                  ->where('id',$order_item)
                  ->first();

               if($request->form_qunatity == 1){
                $deliver_qunatity = DB::table('delivery_items')
                ->where('item_id',$item->item_id)
                ->where('order_id',$request->order)
                ->first();

                DB::table('delivery_items')
                ->where('item_id',$item->item_id)
                ->where('order_id',$request->order)
                ->update([
                    'quantity' => $deliver_qunatity->quantity+$_POST['qty_'.$order_item]
                     ]);
               }else{
                DB::table('order_items')
                ->where('id',$order_item)
                ->update([
                    'is_delivered' => 1, 
                    'delivery_id' => $insert
                     ]);
                     
                DB::table('delivery_items')
                     ->insert([
                         'order_id' => $request->order,
                         'delivery_id' => $insert,
                         'item_id' => $item->item_id, 
                         'is_received' => 0,
                         'quantity' => $_POST['qty_'.$order_item],
                         'is_delivered' => 1,
                         'created_on' => date('Y-m-d h:i:s')
                    ]);
                }
             }
                       
            
            $item_qunatity = DB::table('order_items')
            ->where('order_id',$request->order)
            ->sum('quantity');

            $deliver_item_qunatity = DB::table('delivery_items')
            ->where('order_id',$request->order)
            ->sum('quantity');



           if($item_qunatity == $deliver_item_qunatity){
            $check_item_request = DB::table('order_items')
            ->where('is_delivered',1)
            ->where('order_id',$request->order)
            ->count();
            $check_rejected = DB::table('order_items')
            ->where('is_rejected',1)
            ->where('order_id',$request->order)
            ->count();
            $total_item = DB::table('order_items')
            ->where('order_id',$request->order)
            ->count(); 
            $total_deliverd_item = $check_item_request + $check_rejected; 

            if($total_deliverd_item == $total_item){
                DB::table('order')
                ->where('id',$request->order)
                ->update([
                    'is_delivered' => 1, 
                    ]);
            }
           }

             return redirect()->route('sales/agent/order', $request->order)->with('success', 'Your recevive item status change successfully');
            }else{
                DB::table('order')
                ->where('id',$request->order)
                ->update([
                    'is_rejected' => 1, 
                    'reject_reason' =>$request->reject_reason
                    ]);


                foreach($request->order_item as $order_item){
                  
                    DB::table('order_items')
                    ->where('id',$order_item)
                    ->update([
                        'is_rejected' => 1, 
                        ]);
                 }
                 return redirect()->route('sales/agent/order', $request->order)->with('success', 'Your item rejected successfully');
            }
        }else{
            foreach($request->order_item as $order_item){
                $item_2 = DB::table('delivery_items')
                  ->where('id',$order_item)
                  ->first();

                DB::table('order_items')
                ->where('item_id',$item_2->item_id)
                ->where('order_id',$request->order)
                ->update([
                    'is_received' => 1, 
                     ]);
                DB::table('delivery_items')
                    ->where('id',$order_item)
                    ->update([
                         'is_received' => 1, 
                         'received_quantity' => $_POST['qty_'.$order_item],
                          ]);
             }

           $sum_recive_items = DB::table('delivery_items')
                ->where('order_id',$request->order)
                ->get()
                ->sum('received_quantity');

            $total_item =  DB::table('delivery_items')
            ->where('order_id',$request->order)
            ->get()
            ->sum('quantity');
           if($sum_recive_items == $total_item){
           $check_item_request = DB::table('order_items')
           ->where('is_received',1)
           ->where('order_id',$request->order)
           ->count();

           $check_rejected = DB::table('order_items')
           ->where('is_rejected',1)
           ->where('order_id',$request->order)
           ->count();

            $total_item = DB::table('order_items')
            ->where('order_id',$request->order)
            ->count();

        $total_deliverd_item = $check_item_request + $check_rejected; 

        if($total_deliverd_item == $total_item){
            DB::table('order')
            ->where('id',$request->order)
            ->update([
                'is_recived' => 1, 
                 ]);
        }
    }
        return redirect()->route('view/order', $request->order)->with('success', 'Your recevive item status change successfully');
        }
            
    }

    public function create_order_invoice(Request $request){

        $order_ids = $request->order_id;

        $order_check = DB::table('order')
           ->selectRaw('min(id) as id')
           ->whereIn('id', $order_ids)
           ->groupBy('buyer_id')
           ->get();

        if(count($order_check) > 1){
            return redirect()->route('sales/agent/invoice_order')->with('danger', 'Please select same buyer order. you select different buyer orders');
        }else{

            return view('admin.seller_agent.view_invoice_multiple_order_details', compact('order_ids'));
        }

    }

    public function create_invoice_for_buyer(Request $request){
        $item = explode(',',$request->all_values_items);
        $buyer_id = $request->buyer_id;
        $buyer_company_id = $request->buyer_company_id;
        $order_ids = $request->order_ids;
        $delivery_order_id = explode(',',$order_ids);
        $get_seller_company_id = DB::table('order')->where('id',$delivery_order_id[0])->first();
        $deliver_data = DB::table('delivery')->whereIn('order_id',$delivery_order_id)->get();
        $deliver_item = DB::table('delivery_items')->whereIn('order_id',$delivery_order_id)->where('is_received',1)->get();
        $delivery_array = array();
        

        foreach($deliver_data as $dt){
            array_push($delivery_array,$dt->id);
            DB::table('delivery')
            ->where('id',$dt->id)
            ->update([
                'is_invoice' => 1 , 
                ]);
        }

        
        
        $invoice = new Invoice;
            $invoice->order_id = $order_ids;
            $invoice->delivery_id = implode(',',$delivery_array);
            if(Auth::user()->roles[0]->id == 5){
                $invoice->seller_id = auth()->user()->id;
                $invoice->seller_company_id = $get_seller_company_id->seller_company_id;
            }else{
            $invoice->seller_id = auth()->user()->id;
            $invoice->seller_company_id = Session::get('company_id');
            }
            $invoice->buyer_id = $buyer_id;
            $invoice->buyer_company_id = $buyer_company_id;
            $invoice->save();

        foreach($deliver_item as $d_items){

                $invoice_items = new InvoiceItems;
                $invoice_items->invoice_id = $invoice->id;
                $invoice_items->quantity = $d_items->received_quantity;
                $invoice_items->order_id = $d_items->order_id;
                $invoice_items->item_id = $d_items->item_id;
                $invoice_items->delivery_id = $d_items->delivery_id;
                $invoice_items->created_on = date('Y-m-d h:i:s');
                $invoice_items->save();
            }

            return redirect()->route('sales/agent/order')->with('success', 'Invoice generate successfully');

            
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('comapny')) {
            return abort(401);
        }
        $roles = Role::where("name",'!=', "administrator")
        ->where("name", "Sub Admin")
        ->get()->pluck('name', 'name');

        return view('admin.inventory.create', compact('roles'));
    }

    public function store(Request $request)
    {
        
        if (! Gate::allows('comapny')) {
            return abort(401);
        }

        $this->validate($request, [

            'name' => 'required', 
            'category' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'discription' => 'required',  
     
         ]);
         if($request->hasfile('image')) { 
            foreach($request->file('image') as $file)
            {
                $fileName = time().rand(0, 1000).pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $name = $fileName.'.'.$file->getClientOriginalExtension();
                $file->move(public_path('product_images'),$name);
                $image[]= $name;
                
            }
        } 

        $image_name =  implode(',',$image);

        DB::table('product')
              ->insert([
                  'name' => $request->name , 
                  'category_id' => $request->category , 
                  'acutal_price' => $request->price, 
                  'discount_price'=> $request->discount_price, 
                  'skucode'=> $request->sku_code,
                  'discription'=> $request->discription,
                  'images'=> $image_name,
                  'created_by'=> auth()->user()->id,
                  'created_at' => date('Y-m-d h:i:s')
                   ]);

        return redirect()->route('admin.inventory.index')->with('success','Product Add Successfully');
    }

    public function category_add(Request $request){

        $this->validate($request, [

            'name' => 'required|unique:category', 
     
         ]);


        DB::table('category')
              ->insert([
                  'name' => $request->name , 
                  'created_by'=> auth()->user()->id,
                  'created_at' => date('Y-m-d h:i:s')
                   ]);

    return redirect()->route('admin.inventory.create')->with('success','Category Add Successfully');

    }

    public function sku_add(Request $request){
        $this->validate($request, [

            'name' => 'required|unique:sku_code', 
     
         ]);


        DB::table('sku_code')
              ->insert([
                  'name' => $request->name , 
                  'created_by'=> auth()->user()->id,
                  'created_at' => date('Y-m-d h:i:s')
                   ]);

    return redirect()->back()->with('success','SKU Code Add Successfully');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('comapny')) {
            return abort(401);
        }
        $product = DB::table('product')
                ->where('created_by',auth()->user()->id)
                ->where('id',$id)
                ->get()
                ->first();

                

        return view('admin.inventory.edit', compact('product'));
    }

    public function inventory_edit_submit(Request $request){
        $this->validate($request, [

            'name' => 'required', 
            'category' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'discription' => 'required',  
     
         ]);
         if($request->hasfile('image')) { 
            foreach($request->file('image') as $file)
            {
                $fileName = time().rand(0, 1000).pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $name = $fileName.'.'.$file->getClientOriginalExtension();
                $file->move(public_path('product_images'),$name);
                $image[]= $name;
                
            }
            $image_name =  implode(' , ',$image);
        }else{

            $product = DB::table('product')
            ->where('id',$request->inventory_id)
            ->get()
            ->first(); 
            
            $image_name = $product->images;
        }

        DB::table('product')
              ->where('id',$request->inventory_id)
              ->update([
                  'name' => $request->name , 
                  'category_id' => $request->category , 
                  'acutal_price' => $request->price, 
                  'discount_price'=> $request->discount_price, 
                  'skucode'=> $request->sku_code,
                  'discription'=> $request->discription,
                  'images'=> $image_name,
                  'created_by'=> auth()->user()->id,
                  'created_at' => date('Y-m-d h:i:s')
                   ]);

        return redirect()->url()->previous()->with('success','Product Add Successfully');



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
        if (! Gate::allows('inventory')) {
            return abort(401);
        }

        $user->update($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->syncRoles($roles);

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        if (! Gate::allows('inventory')) {
            return abort(401);
        }

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (! Gate::allows('inventory')) {
            return abort(401);
        }

        $user->delete();

        return redirect()->route('admin.users.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('inventory')) {
            return abort(401);
        }
        User::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
    public function getTabs()
    {

            
            // $pending_order_count = DB::table('order')
            // ->select('order.*','users.name as buyer_name','users.phone_number as buyer_phone_number','comapny.company_name','comapny.comapny_type','comapny.ntn_number')
            // ->join('users','users.id','=','order.seller_id')
            // ->join('comapny','comapny.id','=','order.seller_company_id')

            // ->join('comapny','comapny.id','=','order.comapny_id')

            // ->where('order.buyer_id',auth()->user()->id)
            // ->where('order.is_paid',0)
            // ->where('order.is_delivered',0)
            // ->where('comapny.id',Session::get('company_id'))
            // ->where('order.is_recived',0)
            // ->count();

            $pending_order_count = Order::with('company:id')
                ->where('buyer_id', auth()->user()->id)
                ->where('is_paid', 0)
                ->where('is_delivered', 0)
                ->where('comapny_id',Session::get('company_id'))
                ->where('is_recived',0)

                ->count();
         

           

            $delivery_order_count = DB::table('delivery')
            // ->select('delivery.id as delivery_id','order.*','users.name as seller_name','users.phone_number as seller_phone_number','comapny.company_name','comapny.comapny_type','comapny.ntn_number')
            // ->join('users','users.id','=','delivery.seller_id')
            
            ->join('order','order.id','=','delivery.order_id')


            ->where('order.is_delivered',1)
            ->where('order.is_recived',0)
            ->where('delivery.buyer_id',auth()->user()->id)
            // ->where('comapny.id',Session::get('company_id'))
            ->count();

            $invoice_order_count = DB::table('invoice')
            // ->select('invoice.id as invoice_id','invoice.order_id as order_id','users.name as seller_name','users.phone_number as seller_phone_number','comapny.company_name','comapny.comapny_type','comapny.ntn_number')
            // ->join('users','users.id','=','invoice.seller_id')
            // ->join('comapny','comapny.id','=','invoice.seller_company_id')

            ->join('comapny','comapny.id','=','invoice.buyer_company_id')

            ->where('invoice.buyer_id',auth()->user()->id)
            ->where('invoice.is_completed',0)
            ->where('invoice.is_partial',0)
            ->where('comapny.id',Session::get('company_id'))
            ->count();

            $complete_order_count = DB::table('invoice')
            
            // ->select('invoice.id as invoice_id','invoice.order_id as order_id','users.name as seller_name','users.phone_number as seller_phone_number','comapny.company_name','comapny.comapny_type','comapny.ntn_number')
            // ->join('users','users.id','=','invoice.seller_id')
            // ->join('comapny','comapny.id','=','invoice.seller_company_id')

            ->join('comapny','comapny.id','=','invoice.buyer_company_id')
            
            ->where('invoice.buyer_id',auth()->user()->id)
            ->where('invoice.is_completed',1)
            ->where('comapny.id',Session::get('company_id'))
            ->count();
            $reject_order_count = DB::table('order')
            ->select('order.*','users.name as buyer_name','users.phone_number as buyer_phone_number','comapny.company_name','comapny.comapny_type','comapny.ntn_number')
            ->join('users','users.id','=','order.seller_id')
            ->join('comapny','comapny.id','=','order.seller_company_id')
            ->where('order.buyer_id',auth()->user()->id)
            ->where('order.is_rejected',1)
            ->where('comapny.id',Session::get('company_id'))
            ->count();

            return compact(
                'pending_order_count',
                'delivery_order_count',
                'invoice_order_count',
                'complete_order_count',
                'reject_order_count'
            );
    }

}
