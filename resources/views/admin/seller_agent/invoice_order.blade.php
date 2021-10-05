@extends('layouts.admin')
@section('content')
<?php
$pending_order_count = DB::table('order')
                ->select('order.*','users.name as buyer_name','users.phone_number as buyer_phone_number','comapny.company_name','comapny.comapny_type','comapny.ntn_number')
                ->join('users','users.id','=','order.seller_id')
                ->join('comapny','comapny.id','=','order.seller_company_id')
                ->where('order.seller_id',auth()->user()->id)
                ->where('order.seller_company_id',Session::get('company_id'))
                ->where('order.is_paid',0)
                ->where('order.is_delivered',0)
                // ->where('order.is_recived',0)
                ->count();

$deliver_order_count = DB::table('delivery')
                ->select('delivery.id as delivery_id','order.*','comapny.company_name','users.name as seller_name','users.phone_number as seller_phone_number')
                ->join('users','users.id','=','delivery.seller_id')
                ->join('order','order.id','=','delivery.order_id')
                ->join('comapny','comapny.id','=','order.comapny_id')
                ->where('order.seller_id',auth()->user()->id)
                ->where('order.seller_company_id',Session::get('company_id'))
                //->where('order.is_delivered',1)
                ->where('order.is_recived',0)
                ->count();

$invoice_order_count=  DB::table('delivery')
                ->select('delivery.id as delivery_id','order.*','delivery.is_invoice','comapny.company_name','users.name as seller_name','users.phone_number as seller_phone_number')
                ->join('users','users.id','=','delivery.seller_id')
                ->join('order','order.id','=','delivery.order_id')
                ->join('comapny','comapny.id','=','order.comapny_id')
                ->where('order.seller_id',auth()->user()->id)
                //->where('order.is_delivered',1)
                ->where('delivery.is_invoice',0)
                ->where('order.is_recived',1)
                ->count();
                

$complete_order_count =  DB::table('invoice')
                ->select('invoice.id as invoice_id','invoice.order_id as order_id','users.name as seller_name','users.phone_number as buyer_phone_number','comapny.company_name','comapny.comapny_type','comapny.ntn_number')
                ->join('users','users.id','=','invoice.buyer_id')
                ->join('comapny','comapny.id','=','invoice.seller_company_id')
                ->where('invoice.seller_id',auth()->user()->id)
                ->where('invoice.is_completed',1)
                ->count();

$partial_order_count = DB::table('invoice')
                ->select('invoice.id as invoice_id','invoice.order_id as order_id','users.name as seller_name','users.phone_number as seller_phone_number','comapny.company_name','comapny.comapny_type','comapny.ntn_number')
                ->join('users','users.id','=','invoice.buyer_id')
                ->join('comapny','comapny.id','=','invoice.buyer_company_id')
                ->where('invoice.seller_id',auth()->user()->id)
                ->where('invoice.is_completed',0)
                ->where('invoice.is_partial',1)
                ->count();
            
$reject_order_count =  $order = DB::table('order')
          ->select('order.*','users.name as buyer_name','users.phone_number as buyer_phone_number','comapny.company_name','comapny.comapny_type','comapny.ntn_number')
          ->join('users','users.id','=','order.seller_id')
          ->join('comapny','comapny.id','=','order.seller_company_id')
          ->where('order.seller_id',auth()->user()->id)
          ->where('order.is_rejected',1)
          ->count();


?>
 <style> 
            .custom-control-input:focus ~  
          .custom-control-label::before { 
                /* when the button is toggled off  
  it is still in focus and a violet border will appear */ 
                border-color: #01cc84 !important; 
                /* box shadow is blue by default 
  but we do not want any shadow hence we have set  
  all the values as 0 */ 
                box-shadow: 
                  0 0 0 0rem rgba(0, 0, 0, 0) !important; 
            } 
  
            /*sets the background color of 
          switch to violet when it is checked*/ 
            .custom-control-input:checked ~  
          .custom-control-label::before { 
                border-color: #01cc84 !important; 
                background-color: #01cc84 !important; 
            } 
  
            /*sets the background color of 
          switch to violet when it is active*/ 
            .custom-control-input:active ~  
          .custom-control-label::before { 
                background-color: #01cc84 !important; 
                border-color: #01cc84 !important; 
            } 
  
            /*sets the border color of switch 
          to violet when it is not checked*/ 
            .custom-control-input:focus: 
          not(:checked) ~ .custom-control-label::before { 
                border-color: #01cc84 !important; 
            } 

            @media (min-width: 992px){

            .nav-link.active.test {
                  color: #ccc !important;
                  border-color: #dee2e600 #dee2e600 #01cc84 !important;
                  text-align: center;
                  border-radius: 0px;
                  font-size: 13px;
                  margin-left: 2px;
              }
              }

              .nav-tabs .nav-link {
                  color: #ccc;
                  font-size: 13px;
                  border-bottom: 1px solid #ccc;
                  margin-left: 2px;
              }

              .tab-content {
                   border: none;
                }
            
            }
            .image_body img{
              width: 100%;
              border-top-right-radius: 10px; 
              border-top-left-radius: 10px;
              height: 164px;
              margin-bottom:10px ;
            }
            input[type=number]::-webkit-inner-spin-button, 
              input[type=number]::-webkit-outer-spin-button {  

                background-color: #000;
                opacity: 1;

              }
              
            </style>

<div class="row">

    <div class="col-md-12">
    <div class="card">
    

            <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link test"  href="{{ route('sales/agent/order') }}">Pending Orders <span style="padding: 4px;font-size: 9px; color: #fff; background: #01cc84; border-radius: 16%;">{{$pending_order_count}}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link test" href="{{ route('sales/agent/delivered_order') }}">Delivered <span style="padding: 4px;font-size: 9px; color: #fff; background: #01cc84; border-radius: 16%;">{{$deliver_order_count}}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link test active" href="{{route('sales/agent/invoice_order')}}">Invoice <span style="padding: 4px;font-size: 9px; color: #fff; background: #01cc84; border-radius: 16%;">{{$invoice_order_count+$partial_order_count}}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link test" href="{{route('sales/agent/completed_order')}}">Completed <span style="padding: 4px;font-size: 9px; color: #fff; background: #01cc84; border-radius: 16%;">{{$complete_order_count}}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link test" href="{{route('sales/agent/rejected_order')}}">Rejected Order <span style="padding: 4px;font-size: 9px; color: #fff; background: #01cc84; border-radius: 16%;">{{$reject_order_count}}</span></a>
                  </li>
            
                </ul>
                <div class="tab-content" id="myTabContent">
                
                <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="order-pending-tab">
                <?php
                if(Auth::user()->roles[0]->id == 5){
                $seller_id = DB::table('saller_agent') 
                ->where('user_id',auth()->user()->id)
                ->first();

                $order_details = DB::table('delivery')
                ->select('delivery.id as delivery_id','agent_assign_company.agent_id as agent_id','comapny.company_name','order.*','users.name as seller_name','users.phone_number as seller_phone_number')
                ->join('users','users.id','=','delivery.seller_id')
                ->join('order','order.id','=','delivery.order_id')
                ->join('comapny','comapny.id','=','order.comapny_id')
                ->join('agent_assign_company','agent_assign_company.company_id','=','order.comapny_id')
                ->where('agent_assign_company.agent_id', $seller_id->agent_id)
                ->where('order.seller_id',$seller_id->created_by)
                //->where('order.is_delivered',1)
                //->where('order.is_recived',0)
                //->where('delivery.seller_id',$seller_id->created_by)
                ->get();
                }elseif(Auth::user()->roles[0]->id == 3){
                  $order_details=  DB::table('delivery')
                  ->select('delivery.id as delivery_id','order.*','comapny.company_name','users.name as seller_name','users.phone_number as seller_phone_number')
                  ->join('users','users.id','=','delivery.seller_id')
                  ->join('order','order.id','=','delivery.order_id')
                  ->join('comapny','comapny.id','=','order.comapny_id')
                  ->where('order.seller_id',auth()->user()->id)
                  //->where('order.is_delivered',1)
                  //->where('order.is_recived',1)
                  ->get();
                }else{
                  $order_details=  DB::table('delivery')
                  ->select('delivery.id as delivery_id','order.*','comapny.company_name','users.name as seller_name','users.phone_number as seller_phone_number')
                  ->join('users','users.id','=','delivery.seller_id')
                  ->join('order','order.id','=','delivery.order_id')
                  ->join('comapny','comapny.id','=','order.comapny_id')
                  //->where('order.seller_id',auth()->user()->id)
                  //->where('order.is_delivered',1)
                  //->where('order.is_recived',1)
                  ->get();
                }
                

                ?>
                <h3>Pending Invoice</h3>
                <form method="POST" action="{{ route('create/order/invoice') }}" id="order_form">
                @csrf
                <div class="row">
                
                @foreach($order_details as $ord)
                <?php
                $check_pending_orders = DB::table('delivery_items')
                      ->where('delivery_id',$ord->delivery_id)
                      ->where('is_received',1)
                      ->count();
                      ?>
                @if($check_pending_orders > 0)
                @php
                {{$check_invoice_orders = DB::table('invoice_item')
                      ->where('delivery_id',$ord->delivery_id)
                      ->count();
                      }}
                @endphp
                @if($check_invoice_orders < 1)
                <div class="col-md-6">
                  <div class="card">
                      <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                            <h3>{{ucwords($ord->company_name)}}</h3>
                            <p>{{$ord->created_at}}</p>
                            </div>
                            <div class="col-md-2 text-right">
                             <input type="checkbox" style="margin-top: 11px;" class="form-check-input" name="order_id[]" value="{{$ord->id}}">
                            </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <p><b>Tracking Id:</b> NT4564</p>
                                <p><b>Cell Number:</b> {{$ord->seller_phone_number}}</p>
                                <p><b>GST:</b> 10%</p>
                              </div>
                              <div class="col-md-6">
                              <p><b>Order Number:</b> NT{{$ord->id}}</p>
                                <p><b>NTN Number:</b> </p>
                                <p><b>Amount:</b> RS {{number_format($ord->total_price)}}</p>
                              </div>
                            </div>
                            
                        </div>
                        <div class="card-header text-center">
                        <a style="font-size: 14px;">Status:<span class="btn btn-xs btn-primary" style="font-size: 10px;margin-left: 5px;">Pending Delivery</span></a>
                        <a style="padding: 5px;color: #9e9e9e;" href="{{route('sales/agent/view_invoice_order',$ord->id)}}"><i class="fas fa-eye" style="font-size: 16px;"></i></a>
                      <!--   <a style="padding: 5px;color: #01cc84;" href="{{route('download/PDF',$ord->id)}}"><i class="fas fa-download"  style="font-size: 16px;"></i></a> -->
                      <!--  <a><i class="fa fa-pencil-square-o" style="font-size: 17px; color: #01cc84;"></i></a> -->
                        </div>
                  </div>
                </div>
                @endif
                @endif
                @endforeach
                </div>
                <div class="text-right">
                <input type="submit" class="btn btn-danger" value="Generate Invoice For Order">
                </div>
                </form>
                <hr>
                <h3>Partially Invoice</h3>
                <div class="row">
                
                <?php
                $partial_order = DB::table('invoice')
                ->select('invoice.id as invoice_id','invoice.order_id as order_id','users.name as seller_name','users.phone_number as seller_phone_number','comapny.company_name','comapny.comapny_type','comapny.ntn_number')
                ->join('users','users.id','=','invoice.buyer_id')
                ->join('comapny','comapny.id','=','invoice.buyer_company_id')
                ->where('invoice.seller_id',auth()->user()->id)
                ->where('invoice.is_completed',0)
                ->where('invoice.is_partial',1)
                ->get();
                ?>

              @foreach($partial_order as $p_ord)
                <?php
                 $check_invoice_item_partial = DB::table('invoice_item')
                 ->select('invoice_item.*','product.discount_price as price')
                 ->join('product','product.id','=','invoice_item.item_id')
                 ->where('invoice_item.invoice_id',$p_ord->invoice_id)
                 ->get();
                 $partial_invoice_total = 0;
                 foreach($check_invoice_item_partial as $partial_invoice_item){
                  $partial_invoice_total += $partial_invoice_item->price*$partial_invoice_item->quantity;
                 }
                 ?>
                <div class="col-md-6">
                  <div class="card">
                

                        <div class="card-body">
                            <h3>{{ucwords($p_ord->company_name)}}</h3>
                            
                            <div class="row">
                              <div class="col-md-6">
                                <p><b>Order Numbers:</b> {{$p_ord->order_id}}</p>
                                <p><b>Cell Number:</b> {{$p_ord->seller_phone_number}}</p>
                                <p><b>GST:</b> 10%</p>
                              </div>
                              <div class="col-md-6">
                              <p><b>Order Number:</b> NT{{$p_ord->invoice_id}}</p>
                                <p><b>Amount:</b> RS {{number_format($partial_invoice_total)}}</p>
                              </div>
                            </div>
                            
                        </div>
                        <div class="card-header text-center">
                        <a style="font-size: 14px;">Status:<span class="btn btn-xs btn-primary" style="font-size: 10px;margin-left: 5px;">Pending Delivery</span></a>
                        <a style="padding: 5px;color: #9e9e9e;" href="{{route('view/partial/invoice/orders',$p_ord->invoice_id)}}"><i class="fas fa-eye" style="font-size: 16px;"></i></a>
                        </div>
                  </div>
                </div>
                
                @endforeach
                </div>
                
                
                </div>
                </div>
            </div>
            
    </div>
    </div>
    
</div>

@endsection
@section('scripts')

@parent

@endsection