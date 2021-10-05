@extends('layouts.admin')
@section('content')
<?php
$company_user_data = DB::table('comapny')
->where('id',$id)
->first();

$category = DB::table('category')
          ->where('created_by',$company_user_data->user_id)
          ->get();
$seller_data = DB::table('users')
          ->where('id',$company_user_data->user_id)
          ->get()
          ->first();
?>

<style>
.custome_box{
    border: 1px solid #ccc;
    border-radius: 7px;
    padding: 14px;
    box-shadow: 1px 1px 1px 1px #ccc;
}

.custome_image{
  width: 60%; 
  height: auto;
}

.delete_icon{
  font-size: 20px; 
  margin-top: 16px; 
  color: #e91e63;
}

@media only screen and (max-width: 600px) {
  .custome_image{
    width: 48px;
    height: 43px;
    margin-top: 32px;
  }
  .delete_icon{
      font-size: 20px; 
      margin-top: 32px; 
      color: #e91e63;
    }
}
</style>
 

<h3 style="margin-left: 5px; color: #01cc84;"><i class="fa fa-cart-plus" style="margin-right: 6px;"></i>Cart</h3>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <div class="row custome_box">
      <div class="col-md-6 border-right">
      <h5 style="text-transform: uppercase;">{{$company_user_data->company_name}} <small>(Seller)</small></h5>
      <p><b style="font-weight:bold;">Company Type: </b> {{$company_user_data->comapny_type}}</p>
        <p><b style="font-weight:bold;">Comapny Status: </b> {{$company_user_data->comapny}}</p>
        <p><b style="font-weight:bold;">CNIC Number: </b> {{$company_user_data->cnic_number}}</p>
        <p><b style="font-weight:bold;">Registered Address: </b> {{$company_user_data->registered_address}}</p>
        <p><b style="font-weight:bold;">Delivery Address: </b> {{$company_user_data->delivery_address}}</p>
      
      </div>
      <div class="col-md-6">
        <?php
        $show_company_2 = DB::table('comapny')
        ->where('user_id',auth()->user()->id)
        ->where('id',Session::get('company_id'))
        ->first();
         ?>
      <h5 style="text-transform: uppercase;">{{$show_company_2->company_name}} <small>(Buyer)</small></h5>
      <p><b style="font-weight:bold;">Company Type: </b> {{$show_company_2->comapny_type}}</p>
        <p><b style="font-weight:bold;">Comapny Status: </b> {{$show_company_2->comapny}}</p>
        <p><b style="font-weight:bold;">CNIC Number: </b> {{$show_company_2->cnic_number}}</p>
        <p><b style="font-weight:bold;">Registered Address: </b> {{$show_company_2->registered_address}}</p>
        <p><b style="font-weight:bold;">Delivery Address: </b> {{$show_company_2->delivery_address}}</p>
      </div>
    </div>
    <div class="col-md-2"></div>
    </div>

</div>
<br/>

<div class="row">
  <div class="col-md-12">
  <form action="{{ route('create/order/submite') }}" method="POST" enctype="multipart/form-data">
            @csrf
  <input name="order_details" class="order_details" value="" type="hidden">
  <input name="seller_id" value="{{$seller_data->id}}" type="hidden">
  <input name="buyer_id" value="{{auth()->user()->id}}" type="hidden">
  <input type="hidden" name="seller_company_id" value="{{$company_user_data->id}}">
  <input name="company_id" value="{{$show_company_2->id}}" type="hidden">
  <div class="row append_data">
  
          
    </div>
    <div>
                <input class="btn btn-danger order_confirm" style="margin-bottom:10px; background: #01cc84; border: none; float: right;" type="submit" value="Confirm Order">
            </div>
        </form>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add_to_card_sucsess" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: none;">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <h4>Congratulations! Your order has been placed!</h4><br/>
        <i class="fa fa-check" aria-hidden="true" style="font-size: 21px; color: #fff; background: #01cc84; border-radius: 50%; padding: 10px; margin-bottom: 40px;"></i>
      </div>
      
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script>
$(document).ready(function() { 
	var cart_data = JSON.parse(localStorage.getItem("mycart"));
	$('.order_details').val(localStorage.getItem("mycart"));
//	$('.append_data').html(data);
    $.ajax({
				type:    'post',
				url:     '{{route('get_cart_data')}}',
				data:    {
					_token: "{{ csrf_token() }}",
                    data:cart_data,
				},success: function (data) {
          //console.log(data);
          $('.append_data').html(data);
        },
				error:   function () {
                
                }
            });
		

 });
 
 function DeleteCart (id){
  var cart = localStorage.getItem("mycart");
						if (!cart || cart == '' || cart == null) {
						cart = [];
						} else {
							cart = JSON.parse(cart);
						}
						let tmp_cart = [];
						var upd = false;
					for (var i=0; i<cart.length; i++) {
						if (cart[i].product_id != id) {
							tmp_cart.push(cart[i])
						}
					}
					localStorage.setItem("mycart", JSON.stringify(tmp_cart));
					var cart_data = JSON.parse(localStorage.getItem("mycart"));
					$('.order_details').val(localStorage.getItem("mycart"));
					$.ajax({
				type:    'post',
				url:     '{{route('get_cart_data')}}',
				data:    {
					_token: "{{ csrf_token() }}",
                    data:cart_data,
				},success: function (data) {
          //console.log(data);
          $('.append_data').html(data);
        },
				error:   function () {
                
                }
            })
 }



 
</script>
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
<script>
$(function() {
    localStorage.clear();
    location.reload();
    $('#add_to_card_sucsess').modal('show');
    
});
</script>
@endif
@parent

@endsection