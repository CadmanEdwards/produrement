<?php
     $order_item = DB::table('invoice_item')
        ->select('invoice_item.*','product.name as product_name','sku_code.name as skucode_name','product.discount_price as price','product.acutal_price as acutal_price','product.images','product.discription')
        ->where('invoice_id',$invoice_order->id)
        ->join('product','invoice_item.item_id','=','product.id')
        ->join('sku_code','product.skucode','=','sku_code.id')
        ->get();
     $seller_data = DB::table('users')
          ->where('id',$invoice_order->seller_id)
          ->get()
          ->first();
     $show_company_2 = DB::table('comapny')
        ->where('user_id',auth()->user()->id)
        ->where('id',Session::get('company_id'))
        ->first();
?>

@extends('layouts.admin')
@section('content')
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
 

<h3 style="margin-left: 5px; color: #9e9e9e;">Delivery Items Invoice</h3>

<?php
$total_sum_price = 0;
$total_actual_sum_price = 0;
?>                      
              @csrf 
@foreach($order_item as $item)
<?php 
$image_data = explode(',',$item->images);
$total_price = $item->quantity*$item->price;
$total_sum_price += $item->quantity*$item->price;
$total_actual_sum_price += $item->quantity*$item->acutal_price;
$checked = ($item->is_received == 1) ? "checked" : "";
?>
                <div class="row append_data">
                      
                        <div class="col-2">
                         
                              @if(isset($item->images))
                               <img class="img custom_image" src="{{url('product_images/'.$image_data[0])}}">
                              @else
                                <img style="width: 100px;" src="{{url('product_images/product-image-dummy.jpg')}}">
                              @endif
                        </div>
                        <div class="col-9">
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
                        <th>RS {{number_format($total_sum_price)}}</th>
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
                </div>
              </div>
              
               <form method="POST" action="{{ route('payment/add/invoice') }}">
               <div class="row">
               <div class="col-md-2"></div>
               <div class="col-md-8">
               <?php 
               $percentage = 4.5;
               $totalWidth = $total_sum_price;
               
               $new_width = ($percentage / 100) * $totalWidth;
               
               ?>
               <table class="table table-striped table-bordered">
                    <tbody>
                    <tr>
                    <th colspan="4">Payment Details</th>
                    </tr>
                      <tr>
                        <th colspan="2">Total Payment</th>
                        <th colspan="2">
                        <div class="input-group">
                          <input type="text" class="form-control" name="total_payment" value="{{$total_sum_price}}">
                          <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">RS</span>
                          </div>
                        </div>
                        </th>
                      </tr>
                      <tr>
                        <th colspan="2">Tax Detection</th>
                        <th colspan="2">
                        <div class="input-group">
                          <input type="text" class="form-control" value="4.5" name="tax_detection">
                          <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">%</span>
                          </div>
                        </div>
                        </th>
                      </tr>
                      <tr>
                        <th colspan="2">Adjustement</th>
                        <th colspan="2">
                        <div class="input-group">
                          <input type="number" class="form-control" name="adjustement_amount" value="{{$total_sum_price+$new_width}}">
                          <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">RS</span>
                          </div>
                        </div>
                        </th>
                      </tr>
                      <tr>
                        <th colspan="2">Cheque Amount</th>
                        <th colspan="2">
                        <div class="input-group">
                          <input type="number" class="form-control" name="cheque_amount" value="{{$total_sum_price+$new_width}}">
                          <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">RS</span>
                          </div>
                        </div>
                        </th>
                      </tr>
                      <tr>
                        <th>
                        <div class="form-group">
                            <label for="cheque_number">Cheque Number*</label>
                            <input type="number" class="form-control" name="cheque_number" id="cheque_number" required="">
                        </div>
                        </th>
                        <th>
                        <div class="form-group">
                            <label for="cheque_date">Cheque Date*</label>
                            <input type="date" class="form-control" name="cheque_date" id="cheque_date" required="">
                        </div>
                        </th>
                        <th>
                        <div class="form-group">
                            <label for="bank">Bank*</label>
                            <input type="text" class="form-control" name="bank" id="bank" required="">
                        </div>
                        </th>
                        <th>
                        <div class="form-group">
                            <label for="final_amount">Amount*</label>
                            <input type="number" class="form-control" name="final_amount" id="final_amount" value="{{$total_sum_price+$new_width}}">
                        </div>
                        </th>
                      </tr>
                    </tbody>
                  </table>  
               </div>
               <div class="col-md-2"></div>

               </div>
               @csrf 
               <input type="hidden" value="{{$invoice_order->id}}" name="invoice_id">
               <input type="hidden" value="{{$total_sum_price+$new_width}}" name="total_price">
                <input class="btn btn-danger" name="submite" style="background: #01cc84; border: none; float: right; margin-bottom:8px;" type="submit" value="Partial Payment">
                <input class="btn btn-danger" name="submite" style="background: #01cc84; border: none; float: right; margin-bottom:8px;  margin-right: 9px;" type="submit" value="Complete Payment">
           </form>
               
                

@endsection
@section('scripts')
<script>
$("#select_all").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });


    </script>
@parent
@endsection