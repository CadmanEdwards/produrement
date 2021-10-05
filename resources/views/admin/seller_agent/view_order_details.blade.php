@extends('layouts.admin')
@section('content')
<?php
$order_item = DB::table('order_items')
     ->select('order_items.*','product.name as product_name','product.skucode','sku_code.name as skucode_name','product.discount_price as price','product.acutal_price as acutal_price','product.images','product.discription')
     ->where('order_items.order_id',$order->id)
     ->where('order_items.is_rejected',0)
     ->join('product','order_items.item_id','=','product.id')
     ->join('sku_code','product.skucode','=','sku_code.id')
     ->get();
// print_r($order_item);die;
$seller_data = DB::table('users')
     ->where('id',$order->seller_id)
     ->get()
     ->first();
$show_company_2 = DB::table('comapny')
  ->where('user_id', $order->buyer_id)
  ->where('id', $order->comapny_id)
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
 

<h3 style="margin-left: 5px; color: #9e9e9e;">Pending Items</h3>
<div class="row">
                    <div class="form-check custom-control custom-checkbox select_fields">
                        <input type="checkbox" class="custom-control-input form-check-input" id="select_all">
                        <label class="form-check-label custom-control-label" for="select_all">Select All</label>
                    </div>

</div>
<form method="POST" action="{{ route('change/status/recive_items') }}" id="order_form">

<?php

$total_sum_price = 0;
$total_actual_sum_price = 0;
?>                      
              @csrf 
@foreach($order_item as $item)
<?php
$dilevered_data = DB::table('delivery')
     ->where('order_id', $item->order_id)
     ->first();
if(empty($dilevered_data)){
  $image_data = explode(',',$item->images);
  $total_price = $item->quantity*$item->price;
  $total_sum_price += $item->quantity*$item->price;
  $total_actual_sum_price += $item->quantity*$item->acutal_price;
  //$checked = ($item->is_received == 1) ? "checked" : "";
?>
                <div class="row append_data">
                      <div class="col-1 text-center">
                      <input type="checkbox" style="margin-top: 11px;" class="form-check-input" name="order_item[]" value="{{$item->id}}" >
                      </div>
                        <div class="col-2">
                          
                              @if(isset($item->images))
                              <img class="img custom_image" src="{{url('product_images/'.$image_data[0])}}">
                              @else
                                <img style="width: 100px;" src="{{url('product_images/product-image-dummy.jpg')}}">
                              @endif
                              
                        </div>
                        <div class="col-9">
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
                                            <tr><td>{{$item->price}}</td></tr>
                                        
                                    </tbody></table>
                                  </div>
                                  <div class="col">
                                    <table>
                                        <tbody><tr><th>Quantity</th></tr>
                                            <tr><td>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" min="1" name="qty_{{$item->id}}" value="{{$item->quantity}}">
                                              
                                            </div>
                                            </td></tr>
                                        
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
                                            <tr><td>{{$total_price}}</td></tr>
                                        
                                    </tbody></table>
                                  </div>
                              </div>
                              
                            </div>
                          </div>
                        </div>
                        
                </div>
<?php } 
else{
  $delivery_items = DB::table('delivery_items')
  ->select('delivery_items.*','product.name as product_name','product.discount_price as price','product.acutal_price as acutal_price','product.images','product.discription')
  ->where('delivery_items.item_id',$item->item_id)      
  ->join('product','delivery_items.item_id','=','product.id')
  ->first();
//print_r($delivery_items->quantity);die;

  if($delivery_items->quantity == $item->quantity){
    continue;
  }else{
$image_data = explode(',',$delivery_items->images);
$total_price = $delivery_items->quantity*$delivery_items->price;
$total_sum_price += $delivery_items->quantity*$delivery_items->price;
$total_actual_sum_price += $delivery_items->quantity*$delivery_items->acutal_price;
$checked = ($item->is_received == 1) ? "checked" : "";

?>

<div class="row append_data">
                      <div class="col-1 text-center">
                      <input type="checkbox" style="margin-top: 11px;" class="form-check-input" name="order_item[]" value="{{$item->id}}">
                      <input type="hidden" name="form_qunatity" value="1">
                      </div>
                        <div class="col-2">
                          
                              @if(isset($item->images))
                              <img class="img custom_image" src="{{url('product_images/'.$image_data[0])}}">
                              @else
                                <img style="width: 100px;" src="{{url('product_images/product-image-dummy.jpg')}}">
                              @endif
                              
                        </div>
                        <div class="col-9">
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
                                            <tr><td>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" min="1" name="qty_{{$item->id}}" value="{{$item->quantity-$delivery_items->quantity}}">
                                              
                                            </div>
                                            </td></tr>
                                        
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
  
 
 <?php } 
  }
?>
                @endforeach
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
                <div class="col-md-6">
                  <table class="table table-striped table-bordered">
                    <tbody>
                    <tr>
                    <th colspan="2">Payment Details</th>
                    </tr>
                      <tr>
                        <th>Total Payment</th>
                        <th>RS {{number_format($total_sum_price)}}</th>
                      </tr>
                      <tr>
                        <th>Sales Tax</th>
                        <th>10%</th>
                      </tr>
                      <tr>
                        <th>Actual Price</th>
                        <th>RS {{number_format($total_actual_sum_price)}}</th>
                      </tr>
                      <tr>
                        <th>Discount Price</th>
                        <th>RS {{$total_sum_price}}</th>
                      </tr>
                      <tr>
                        <th>Discount</th>
                        <th>RS {{number_format($total_actual_sum_price - $total_sum_price)}}</th>
                      </tr>
                      <tr>
                        <th>Total Price With GST</th>
                        <th>RS {{number_format($total_sum_price)}}</th>
                      </tr>
                    </tbody>
                  </table>
               <br/>
                  <input type="hidden" name="order" value="{{$order->id}}">
               
                <div style="margin-bottom: 14px;">
                <button type="button" style="background: red; border: none; float: right; margin-left:8px;" class="btn btn-primary" data-toggle="modal" data-target="#reject_item">
                  Reject Pending Item
                </button>
                <input class="btn btn-danger" name="form_type" style="background: #01cc84; border: none; float: right;" type="submit" value="Change Status Of Pending Items">  
                
           
                </div>
                </div>
              </div>

                
        </form>

                <!-- Modal -->
        <div class="modal fade" id="reject_item" tabindex="-1" role="dialog" aria-labelledby="reject_itemLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="reject_itemLabel">Reject Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <div class="form-group">
                  <label for="reject_reason">Reject Reason</label>
                  <textarea class="form-control" name="reject_reason" id="reject_reason" rows="3" form="order_form"></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input class="btn btn-danger" name="form_type" form="order_form" type="submit" value="Reject Pending Items">
              </div>
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