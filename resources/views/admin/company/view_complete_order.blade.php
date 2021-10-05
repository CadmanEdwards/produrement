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
 

<h3 style="margin-left: 5px; color: #9e9e9e;">Deliveried Items Invoice</h3>

@csrf 
@foreach($order_item as $item)

<?php 
        $image_data = explode(',',$item->images);
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
                                      <td>{{number_format($item->prices)}}</td>
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
                      <td>{{ucfirst($invoice_order->sellerUser->name)}}</td>
                    </tr>
                    <tr>
                      <th>E-mail:</th>
                      <td>{{$invoice_order->sellerUser->email}}</td>
                    </tr>
                    <tr>
                      <th>Phone Number:</th>
                      <td>{{$invoice_order->sellerUser->phone_number}}</td>
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
                        <th>RS {{number_format($discount)}}</th>
                      </tr>
                      <tr>
                        <th>Total Price With GST</th>
                        <th>RS {{number_format($total_sum_price)}}</th>
                      </tr>
                    </tbody>
                  </table>

                  <?php
                  $payment = DB::table('payment')
                     ->where('invoice_id',$invoice_order->id)
                     ->get();
                  ?>

                  <table class="table table-striped table-bordered">
                    <tbody>
                    <tr>
                    <th colspan="3">Paid Payment Details</th>
                    </tr>
                    <tr>
                        <th>Payment</th>
                        <th>Paid on</th>
                        <th>Action</th>
                      </tr>
                    @foreach($payment as $p)
                    <tr>
                    <td>{{number_format($p->final_amount)}}</td>
                    <td>{{$p->created_on}}</td>
                    <td><button class="btn btn-primary" onclick="PaymentModal(<?= $p->id; ?>)">View</button></td>
                    </tr>

                    @endforeach  
                     
                    </tbody>
                  </table>
                </div>
              </div>
              
              <!-- Modal -->
              <div class="modal fade" id="PaymentModal" tabindex="-1" role="dialog" aria-labelledby="PaymentModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content inner_payment_html">
                   
                  </div>
                </div>
              </div>
               

@endsection
@section('scripts')
<script>
function PaymentModal(payment_id){
  
  $.ajax({
				type:    'post',
				url:     '{{route('show_modal_payment')}}',
				data:    {
					_token: "{{ csrf_token() }}",
                    id:payment_id,
				},success: function (data) {
          $('.inner_payment_html').append(data);
          $('#PaymentModal').modal('show');
        },
				error:   function () {
                
                }
            });
            $('#PaymentModal').on('hidden.bs.modal', function() {
      $('.inner_payment_html').html("");
            });
    
}

</script>
@parent
@endsection