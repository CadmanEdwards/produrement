@extends('layouts.admin')
@section('content')
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
                    <a class="nav-link test"  href="{{ route('admin.order.index') }}">Pending Orders <span style="padding: 4px;font-size: 9px; color: #fff; background: #01cc84; border-radius: 16%;">{{$pending_order_count}}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link test" href="{{ route('delivered_order') }}">Delivered <span style="padding: 4px;font-size: 9px; color: #fff; background: #01cc84; border-radius: 16%;">{{$delivery_order_count}}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link test active" href="{{route('invoice_order')}}">Invoice <span style="padding: 4px;font-size: 9px; color: #fff; background: #01cc84; border-radius: 16%;">{{$invoice_order_count}}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link test" href="{{route('completed_order')}}">Completed <span style="padding: 4px;font-size: 9px; color: #fff; background: #01cc84; border-radius: 16%;">{{$complete_order_count}}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link test" href="{{route('rejected_order')}}">Rejected Order <span style="padding: 4px;font-size: 9px; color: #fff; background: #01cc84; border-radius: 16%;">{{$reject_order_count}}</span></a>
                  </li>
            
                
                </ul>
                <div class="tab-content" id="myTabContent">
                
                <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="order-pending-tab">
                <?php
                $order_details = DB::table('invoice')
                ->select('invoice.id as invoice_id','invoice.order_id as order_id','users.name as seller_name','users.phone_number as seller_phone_number','comapny.company_name','comapny.comapny_type','comapny.ntn_number')
                ->join('users','users.id','=','invoice.seller_id')
                ->join('comapny','comapny.id','=','invoice.seller_company_id')
                ->where('invoice.buyer_id',auth()->user()->id)
                ->where('invoice.is_completed',0)
                ->where('invoice.is_partial',0)
                ->get();
                //print_r($order_details);die;

                ?>
                <h3>Pending Invoice</h3>
                <div class="row">
                @foreach($order_details as $ord)
                <?php
                 $check_invoice_item = DB::table('invoice_item')
                 ->select('invoice_item.*','product.discount_price as price')
                 ->join('product','product.id','=','invoice_item.item_id')
                 ->where('invoice_item.invoice_id',$ord->invoice_id)
                 ->get();
                 $invoice_total = 0;
                 foreach($check_invoice_item as $invoice_item){
                  $invoice_total += $invoice_item->price*$invoice_item->quantity;
                 }
                 ?>
                <div class="col-md-6">
                  <div class="card">
                

                        <div class="card-body">
                            <h3>{{ucwords($ord->company_name)}}</h3>
                            
                            <div class="row">
                              <div class="col-md-6">
                                <p><b>Order Numbers:</b> {{$ord->order_id}}</p>
                                <p><b>Cell Number:</b> {{$ord->seller_phone_number}}</p>
                                <p><b>GST:</b> 10%</p>
                              </div>
                              <div class="col-md-6">
                              <p><b>Order Number:</b> NT{{$ord->invoice_id}}</p>
                                <p><b>Amount:</b> RS {{number_format($invoice_total)}}</p>
                              </div>
                            </div>
                            
                        </div>
                        <div class="card-header text-center">
                        <a style="font-size: 14px;">Status:<span class="btn btn-xs btn-primary" style="font-size: 10px;margin-left: 5px;">Pending Delivery</span></a>
                        <a style="padding: 5px;color: #9e9e9e;" href="{{route('view/invoice/orders',$ord->invoice_id)}}"><i class="fas fa-eye" style="font-size: 16px;"></i></a>
                        </div>
                  </div>
                </div>
                
                @endforeach
                
                </div>
                <hr/>
                <h3>Partially Invoice</h3>
                <div class="row">
                
                <?php
                $partial_order = DB::table('invoice')
                ->select('invoice.id as invoice_id','invoice.order_id as order_id','users.name as seller_name','users.phone_number as seller_phone_number','comapny.company_name','comapny.comapny_type','comapny.ntn_number')
                ->join('users','users.id','=','invoice.seller_id')
                ->join('comapny','comapny.id','=','invoice.seller_company_id')
                ->where('invoice.buyer_id',auth()->user()->id)
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