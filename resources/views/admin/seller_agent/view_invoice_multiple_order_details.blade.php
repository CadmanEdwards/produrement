@extends('layouts.admin')
@section('content')
<?php
$order_item = DB::table('delivery_items')
->select('delivery_items.*','product.name as product_name','product.skucode','sku_code.name as skucode_name','product.discount_price as price','product.acutal_price as acutal_price','product.images','product.discription')
->whereIn('delivery_items.order_id',$order_ids)
->where('delivery_items.is_received',1)
->join('product','delivery_items.item_id','=','product.id')
->join('sku_code','product.skucode','=','sku_code.id')
->get();

$seller_data = DB::table('users')
     ->where('id',auth()->user()->id)
     ->get()
     ->first();
    
$get_order_data = DB::table('order')
   ->whereIn('id',$order_ids)
   ->first();

  
$show_company_2 = DB::table('comapny')
   ->where('user_id',$get_order_data->buyer_id)
   ->where('id',$get_order_data->comapny_id)
   ->first();
   if(Auth::user()->roles[0]->id == 5){
    $seller_id = DB::table('saller_agent')
    ->select('saller_agent.*','agent_assign_company.company_id as company_id') 
    ->join('agent_assign_company','saller_agent.agent_id','=','saller_agent.agent_id')
    ->where('saller_agent.user_id',auth()->user()->id)
    ->first();
    $seller_company_details = DB::table('comapny')
   // ->where('user_id',auth()->user()->id)
    ->where('id',$get_order_data->seller_company_id)
    ->first();  
  }else{
  $seller_company_details = DB::table('comapny')
   ->where('user_id',auth()->user()->id)
   ->where('id',$get_order_data->seller_company_id)
   ->first();
  }
  ?>

<style>
.custome_box{
    border: 1px solid #ccc;
    border-radius: 7px;
    padding: 14px;
    box-shadow: 1px 1px 1px 1px #ccc;
}

.select_fields{
    margin-left: 31px;
    margin-bottom: 13px;
    margin-top: 11px;
    color: #01cc84;
    font-size: 12px;
    font-weight: bold;
}

.custom_image{
      width: 100px;
      height: 50px;
      border-radius: 6px;
  }

@media only screen and (max-width: 600px) {
  .custom_image{
      width: 100%;
      height: 50px;
      border-radius: 6px;
  }
  
}

</style>
 

<h3 style="margin-left: 5px; color: #9e9e9e;">Order Items</h3>

<div class="row">
      <div class="col-md-6">
                      <table class="table table-striped table-bordered">
                        <tbody>
                        <tr>
                        <th colspan="2">Seller Details</th>
                        </tr>
                          <tr>
                            <th>Seller Name:</th>
                            <td>{{ucfirst($seller_data->name)}}</td>
                          </tr>
                          <tr>
                            <th>E-mail:</th>
                            <td>{{$seller_data->email}}</td>
                          </tr>
                          <tr>
                            <th>Phone Number:</th>
                            <td>{{$seller_data->phone_number}}</td>
                          </tr>
                          <tr>
                            <th>Company Name:</th>
                            <td>{{$seller_company_details->company_name}}</td>
                          </tr>
                          <tr>
                            <th>Comapny Type:</th>
                            <td>{{$seller_company_details->comapny_type}}</td>
                          </tr>
                          <tr>
                            <th>Phone Number:</th>
                            <td>{{$seller_company_details->landline_number}}</td>
                          </tr>
                          
                        </tbody>
                      </table>

                    
      </div>
      <div class="col-md-6">
                <table class="table table-striped table-bordered">
                  <tbody>
                  <tr>
                  <th  colspan="2">Buyer Details</th>
                    </tr>
                    <tr>
                        <th>Company Name:</th>
                        <td>{{$show_company_2->company_name}}</td>
                      </tr>
                      <tr>
                        <th>Company Type:</th>
                        <td>{{$show_company_2->comapny_type}}</td>
                      </tr>
                      <tr>
                        <th>Comapny Status:</th>
                        <td>{{$show_company_2->comapny}}</td>
                      </tr>
                      <tr>
                        <th>CNIC Number:</th>
                        <td>{{$show_company_2->cnic_number}}</td>
                      </tr>
                      <tr>
                        <th>Registered Address:</th>
                        <td>{{$show_company_2->registered_address}}</td>
                      </tr>
                      <tr>
                        <th>Delivery Address:</th>
                        <td>{{$show_company_2->delivery_address}}</td>
                      </tr>
                  </tbody>
                </table>
      </div>
</div>

          <?php
          $total_sum_price = 0;
          $total_actual_sum_price = 0;
          $item_array = array();
          ?>
          @foreach($order_item as $item)
          <?php
          array_push($item_array,$item->item_id ); 
          
          $image_data = explode(',',$item->images);
          $total_price = $item->received_quantity*$item->price;
          $total_sum_price += $item->received_quantity*$item->price;
          $total_actual_sum_price += $item->received_quantity*$item->acutal_price;
          $checked = ($item->is_received == 1) ? "checked" : "";
          ?>
                <div class="row append_data">
                      
                        <div class="col-2 text-center">
  
                              @if(isset($item->images))
                              <img class="img custom_image" src="{{url('product_images/'.$image_data[0])}}">
                              @else
                                <img style="width: 100px;" src="{{url('product_images/product-image-dummy.jpg')}}">
                              @endif
                              
                        </div>
                        <div class="col-10">
                          <div class="card" style="box-shadow: none;">
                    
                            <table class="table table-borderless text-center">
                                  <thead>
                                    <tr>
                                      <th scope="col">#Delivery Id</th>
                                      <th scope="col">{{$item->product_name}}</th>
                                      <th scope="col">Packing</th>
                                      <th scope="col">PKR</th>
                                      <th scope="col">Quantity</th>
                                      <th scope="col">Sales Tax</th>
                                      <th scope="col">Total</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <th>{{sprintf("%04d", $item->delivery_id)}}</th>
                                      <th>{{$item->discription}}</th>
                                      <th>{{$item->skucode_name}}</th>
                                      <td>{{number_format($item->price)}}</td>
                                      <td>{{$item->quantity}}</td>
                                      <td>10%</td>
                                      <td>{{number_format($total_price)}}</td>
                                    </tr>
                                    </tbody>
                                  </table>
                          </div>
                        </div>
                        
                </div>

                @endforeach
                <div class="row">
                <div class="col-md-8">
                
                </div>
                <div class="col-md-4">
                  <table class="table">
                    <tbody>
                      <tr>
                        <th class="text-right">Total Payment :</th>
                        <th>RS {{number_format($total_sum_price)}} /-</th>
                      </tr>
                      <tr>
                        <th class="text-right">Sales Tax :</th>
                        <th>10%</th>
                      </tr>
                      <tr>
                        <th class="text-right">Actual Price :</th>
                        <th>RS {{number_format($total_actual_sum_price)}} /-</th>
                      </tr>
                      <tr>
                        <th class="text-right">Discount Price :</th>
                        <th>RS {{number_format($total_sum_price)}} /-</th>
                      </tr>
                      <tr>
                        <th class="text-right">Discount :</th>
                        <th>RS {{number_format($total_actual_sum_price - $total_sum_price)}} /-</th>
                      </tr>
                      <tr>
                        <th class="text-right">Total Price With GST :</th>
                        <th>RS {{number_format($total_sum_price)}} /-</th>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <form method="POST" action="{{ route('create/invoice/for_buyer') }}">
              @csrf
              <input type="hidden" name="all_values_items" value="{{implode(',',$item_array)}}">
              <input type="hidden" name="order_ids" value="{{implode(',',$order_ids)}}">
              <input type="hidden" name="buyer_id" value="{{$get_order_data->buyer_id}}">
              <input type="hidden" name="buyer_company_id" value="{{$get_order_data->comapny_id}}">
              <input class="btn btn-danger" style="background: #01cc84; border: none; float: right;" type="submit" value="Generate Invoice For Item">  
              </form>
            </div>

           
        
                

@endsection
@section('scripts')
<script>
$("#select_all").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
</script>
@parent
@endsection