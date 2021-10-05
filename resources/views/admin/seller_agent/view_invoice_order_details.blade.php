@extends('layouts.admin')
@section('content')
<?php
$order_item = DB::table('delivery_items')
->select('delivery_items.*','product.name as product_name','product.skucode','sku_code.name as skucode_name','product.discount_price as price','product.acutal_price as acutal_price','product.images','product.discription')
->where('delivery_items.order_id',$order->id)
->where('delivery_items.is_received',1)
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

$seller_company_details = DB::table('comapny')
   ->where('user_id',auth()->user()->id)
   ->where('id',$order->seller_company_id)
   ->first();
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
          ?>
          @foreach($order_item as $item)
          <?php 
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
                            <div class="card-body">
                              <div class="row center-div">
                                  <div class="col">
                                      <table>
                                          <tbody><tr><th>{{$item->product_name}}</th></tr>
                                              <tr><td>{{$item->discription}}</td></tr>
                                          
                                      </tbody></table>
                                  </div>
                                  <div class="col">
                                    <table>
                                        <tbody><tr><th>Packing</th></tr>
                                            <tr><td>{{$item->skucode_name}}</td></tr>
                                        
                                    </tbody></table>
                                  </div>
                                  <div class="col">
                                    <table>
                                        <tbody><tr><th>PKR</th></tr>
                                            <tr><td>{{number_format($item->price)}}</td></tr>
                                        
                                    </tbody></table>
                                  </div>
                                  <div class="col">
                                    <table>
                                        <tbody><tr><th>Quantity</th></tr>
                                            <tr><td>{{$item->received_quantity}}</td></tr>
                                        
                                    </tbody></table>
                                  </div>
                                  <div class="col">
                                    <table>
                                        <tbody><tr><th>Sales Tax</th></tr>
                                            <tr><td>10%</td></tr>
                                        
                                    </tbody></table>
                                  </div>
                                  <div class="col">
                                    <table>
                                        <tbody><tr><th>Total</th></tr>
                                            <tr><td>{{number_format($total_price)}}</td></tr>
                                        
                                    </tbody></table>
                                  </div>
                              </div>
                              
                            </div>
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