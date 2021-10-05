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
                    <a class="nav-link test active"  href="{{ route('admin.order.index') }}">Pending Orders <span style="padding: 4px;font-size: 9px; color: #fff; background: #01cc84; border-radius: 16%;">{{$pending_order_count}}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link test" href="{{ route('delivered_order') }}">Delivered <span style="padding: 4px;font-size: 9px; color: #fff; background: #01cc84; border-radius: 16%;">{{$delivery_order_count}}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link test" href="{{route('invoice_order')}}">Invoice <span style="padding: 4px;font-size: 9px; color: #fff; background: #01cc84; border-radius: 16%;">{{$invoice_order_count}}</span></a>
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
                <h3>Pending Orders</h3>
                <div class="row">
                <?php
               
               $order = DB::table('order')
               ->select('order.*','users.name as buyer_name','users.phone_number as buyer_phone_number','comapny.company_name','comapny.comapny_type','comapny.ntn_number')
               ->join('users','users.id','=','order.seller_id')
               ->join('comapny','comapny.id','=','order.seller_company_id')
               ->where('order.buyer_id',auth()->user()->id)
               ->where('order.is_paid',0)
               ->where('order.is_delivered',0)
               //->where('order.is_recived',0)
               ->get();

              ?>
                @if(count($order) > 0)
                @foreach($order as $ord)
                <?php 
                $dilvery_order = DB::table('order_items')
                ->select('order_items.*') 
                ->join('delivery','order_items.order_id','delivery.order_id')
                ->where('order_items.order_id',$ord->id)
                ->where('order_items.is_delivered',0)
                ->get();

                $dilvery_order_for_first_item = DB::table('delivery')
                ->where('order_id',$ord->id)
                //->where('is_delivered',0)
                ->get()
                ->first();
             
                ?>
                @if(count($dilvery_order) > 0)
 

                <?php
                $total_delivered_item = DB::table('order_items')
                ->where('order_id',$ord->id)
                ->where('is_delivered',0)
                ->get();

                $rejected_item = DB::table('order_items')
                ->where('order_id',$ord->id)
                ->where('is_rejected',1)
                ->get();
                if(count($total_delivered_item) == count($rejected_item)){
                  echo"<p>No Order Found</p>";
                }else{
                
                $total_price_of_half_data = DB::table('order_items')
                ->select('product.*')
                ->join('product','order_items.item_id','product.id')
                ->where('order_items.order_id',$ord->id)
                ->where('order_items.is_delivered',0)
                ->sum('product.discount_price');
                ?>
                <div class="col-md-6">
                  <div class="card">
                  

                          <div class="card-body">
                              <h3>{{ucwords($ord->company_name)}}</h3>
                              <p>{{$ord->created_at}}</p>

                              <div class="row">
                                <div class="col-md-6">
                                  <p><b>Tracking Id:</b> NT4564</p>
                                  <p><b>Cell Number:</b> {{$ord->buyer_phone_number}}</p>
                                  <p><b>GST:</b> 10%</p>
                                </div>
                                <div class="col-md-6">
                                <p><b>Order Number:</b> NT{{$ord->id}}</p>
                                  <p><b>NTN Number:</b> {{$ord->ntn_number}}</p>
                                  <p><b>Amount:</b> RS {{number_format($total_price_of_half_data)}}</p>
                                </div>
                              </div>
                              
                          </div>
                          <div class="card-header text-center">
                            <a style="font-size: 14px;">Status:<span class="btn btn-xs btn-primary" style="font-size: 10px;margin-left: 5px;">Pending</span></a>
                          <a style="padding: 5px;color: #9e9e9e;" href="{{route('view/order/order/half',$ord->id)}}"><i class="fas fa-eye" style="font-size: 16px;"></i></a>
                        <!--  <a><i class="fa fa-pencil-square-o" style="font-size: 17px; color: #01cc84;"></i></a> -->
                        
                                      
                          </div>
                  </div>
                </div>
                <?php } ?>
                @elseif(empty($dilvery_order_for_first_item))


                <div class="col-md-6">
                  <div class="card">
                  

                          <div class="card-body">
                              <h3>{{ucwords($ord->company_name)}}</h3>
                              <p>{{$ord->created_at}}</p>

                              <div class="row">
                                <div class="col-md-6">
                                  <p><b>Tracking Id:</b> NT4564</p>
                                  <p><b>Cell Number:</b> {{$ord->buyer_phone_number}}</p>
                                  <p><b>GST:</b> 10%</p>
                                </div>
                                <div class="col-md-6">
                                <p><b>Order Number:</b> NT{{$ord->id}}</p>
                                  <p><b>NTN Number:</b> {{$ord->ntn_number}}</p>
                                  <p><b>Amount:</b> RS {{number_format($ord->total_price)}}</p>
                                </div>
                              </div>
                              
                          </div>
                          <div class="card-header text-center">
                            <a style="font-size: 14px;">Status:<span class="btn btn-xs btn-primary" style="font-size: 10px;margin-left: 5px;">Pending</span></a>
                          <a style="padding: 5px;color: #9e9e9e;" href="{{route('view/pending/orders',$ord->id)}}"><i class="fas fa-eye" style="font-size: 16px;"></i></a>
                        <!--  <a><i class="fa fa-pencil-square-o" style="font-size: 17px; color: #01cc84;"></i></a> -->
                        
                                      
                          </div>
                  </div>
                </div>
                @else
                
                <div class="col-md-6">
                  <div class="card">

                  <?php 

                    $order_item = DB::table('order_items')
                    ->select('order_items.*','product.name as product_name','product.discount_price as price','product.acutal_price as acutal_price','product.images','product.discription')
                    ->where('order_items.order_id',$ord->id)
                    ->where('order_items.is_rejected',0)
                    ->join('product','order_items.item_id','=','product.id')
                    ->get();
                    $total_sum_price = 0;
                    foreach($order_item as $ite){

                      $delivery_items = DB::table('delivery_items')
                      ->select('delivery_items.*','product.name as product_name','product.discount_price as price','product.acutal_price as acutal_price','product.images','product.discription')
                      ->where('delivery_items.item_id',$ite->item_id)      
                      ->join('product','delivery_items.item_id','=','product.id')
                      ->first();

                      if($delivery_items->quantity == $ite->quantity){
                        continue;
                      }else{
                    $total_sum_price += $delivery_items->quantity*$delivery_items->price;
                      }

                    }
                   
                  ?>
                  

                          <div class="card-body">
                              <h3>{{ucwords($ord->company_name)}}</h3>
                              <p>{{$ord->created_at}}</p>

                              <div class="row">
                                <div class="col-md-6">
                                  <p><b>Tracking Id:</b> NT4564</p>
                                  <p><b>Cell Number:</b> {{$ord->buyer_phone_number}}</p>
                                  <p><b>GST:</b> 10%</p>
                                </div>
                                <div class="col-md-6">
                                <p><b>Order Number:</b> NT{{$ord->id}}</p>
                                  <p><b>NTN Number:</b> {{$ord->ntn_number}}</p>
                                  <p><b>Amount:</b> RS {{$total_sum_price}}</p>
                                </div>
                              </div>
                              
                          </div>
                          <div class="card-header text-center">
                            <a style="font-size: 14px;">Status:<span class="btn btn-xs btn-primary" style="font-size: 10px;margin-left: 5px;">Pending</span></a>
                          <a style="padding: 5px;color: #9e9e9e;" href="{{route('view/pending/orders',$ord->id)}}"><i class="fas fa-eye" style="font-size: 16px;"></i></a>
                        <!--  <a><i class="fa fa-pencil-square-o" style="font-size: 17px; color: #01cc84;"></i></a> -->
                        
                                      
                          </div>
                  </div>
                </div>
                @endif
                 
                @endforeach
                @else
                <p>No Order Found</p>
                @endif   
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