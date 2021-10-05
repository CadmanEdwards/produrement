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
              color: #fff !important;
              background-color: #1a966a !important;
              border-color: #dee2e6 #dee2e6 #fff !important;
              text-align: center;
              border-radius: 0px;
              }

              .nav-tabs .nav-link {
                  background: #01cc84;
                  margin-left: 2px;
                  text-align: center;
                  border-radius: 17px;
                  margin-top: -6px;
                  color: #fff;
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

              .btn-danger:hover{
                background-color: #01cc84 !important;
              }
              
            </style>

<h3 style="margin-left: 5px;">Invantory List</h3>
<div class="row">

    <div class="col-md-12">
    <div class="card">
    

            <div class="card-body">
            <div class="row">
                    @if(empty($company_user_data->logo))
                    <img src="{{url('/theme/images/levis.png')}}" style="width: 70px;">
                    @else
                    <img src="{{url('/product_images/'.$company_user_data->logo)}}" style="width: 70px;">
                    @endif
                      <h4 style="margin-top: 9px;margin-left: 8px;text-transform: uppercase;">{{$company_user_data->company_name}}<small style="margin-left: 5px;text-transform: lowercase;">(Shop online)</small></h4>
                      
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist" style="justify-content: center;">
            @foreach($category as $key=>$c)
                <li class="nav-item">
                    <a class="nav-link test <?php if($key == 0){echo"active";}?>" id="category-{{$c->id}}-tab" data-toggle="tab" href="#category-{{$c->id}}" role="tab" aria-controls="home" aria-selected="true">{{$c->name}}</a>
                </li>
            @endforeach
                
                </ul>
                <div class="tab-content" id="myTabContent">
                @foreach($category as $key=>$c)
                
                <div class="tab-pane fade <?php if($key == 0){echo"show active";}?>" id="category-{{$c->id}}" role="tabpanel" aria-labelledby="category-{{$c->id}}-tab">
                <div class="row">
                <?php
                $product = DB::table('product')
                ->select('product.*','sku_code.name as sku_code_name')
                ->join('sku_code','sku_code.id','=','product.skucode')
                ->where('is_show',1)
                ->where('product.company_id',$id)
                ->where('product.category_id',$c->id)
                ->get();
                
                ?>
                @if(count($product) > 0)
                @foreach($product as $pro)
                <?php $image = explode(',', $pro->images);
                      $single_image = $image[0];
                      $percent = (($pro->acutal_price - $pro->discount_price)*100)/$pro->acutal_price;
                      ?>
                <div class="col-md-3">
                <div class="card">
                <div class="card-body" style="padding: 0;">
                <div class="image_body">
                @if(isset($pro->images))
                    <img src="{{url('product_images').'/'.$single_image}}">
                  @else
                    <img src="{{url('product_images/product-image-dummy.jpg')}}">
                  @endif
                </div>
                 <h3 class="text-center">{{$pro->name}}</h3>
                 <p class="text-center" style="margin-bottom: 1px;"><b>Price: </b>{{number_format($pro->discount_price)}} / {{$pro->sku_code_name}}</p>
                 <p class="text-center" style="margin-bottom: 1px;"><b>Actual Price: </b><del>{{number_format($pro->acutal_price)}}</del></p>
                 
                 <p class="text-center"><b>Discount: </b><span style="color:red; font-size:14px;">{{round($percent)}}%</span></p>
                 
                 <div class="text-center">
                   <label style="background: #01cc84;padding: 3px; color: #fff;">Quantity</label>
                 <input name="quantity_{{$pro->id}}" class="quantity_{{$pro->id}}" onchange="AddToCard(<?= $pro->id ?>)" style="margin-left: -3px; border: 2px solid #01cc84;" type="number" min="0" max="10">
                </div>
                
                </div>
                </div>
                </div> 
                @endforeach
                @else
                <p>No Product Found</p>
                @endif   
                </div>
                
                
                </div>
                @endforeach
                </div>
                <div class="row">
                <div class="col-md-10"></div>
                <div class="col-md-2">
                <a class="btn btn-block btn-danger" href="{{route('company/view_cart',$id)}}">Add to card</a>
                </div>
                </div>
            </div>
            
    </div>
    </div>
    
</div>

@endsection
@section('scripts')
<script>
$('.add_to_card').on('click', function(e) {
            		e.preventDefault();

						var newItem = { 'id' : $(this).attr('data-value'), 'quantity': 1,'res_id': rest_id};
						cart.push(newItem);
					
					localStorage.setItem("mycart", JSON.stringify(cart));
					
            	});

function AddToCard (product_id){
  var quantity_of_item = $('.quantity_'+product_id).val();
  var  user_id = <?= $seller_data->id ?>;
  var cart = localStorage.getItem("mycart");
  var newCart = [];
  if (!cart || cart == '' || cart == null) {
						cart = [];
					} else {
						cart = JSON.parse(cart);
					}
					var upd = false;
					for (var i=0; i<cart.length; i++) {
						if (cart[i].product_id == product_id) {
              if(quantity_of_item != 0) {
                cart[i].quantity = quantity_of_item;
                upd = true;
                newCart.push(cart[i]);
              } 
            } else {
              newCart.push(cart[i]);
            }
					}


          if (!upd) {
						var newItem = { 'product_id' :product_id , 'quantity': quantity_of_item,'user_id': user_id};
						newCart.push(newItem);
					}
          console.log(newCart)
					localStorage.setItem("mycart", JSON.stringify(newCart));
					
          
}
</script>
@parent

@endsection