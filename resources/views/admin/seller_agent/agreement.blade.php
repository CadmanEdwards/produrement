@extends('layouts.admin')
@section('content')
<style> 
  .priceTxt{
    width: 50%;
    height: 22px
  }
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
        border-radius: 12px;
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

   @media only screen and (max-width: 600px) {
    .table_reponsive {
      overflow: scroll;
    }
  }

  .image_body img{
    width: 100%;
    border-top-right-radius: 10px; 
    border-top-left-radius: 10px;
    height: 164px;
    margin-bottom:10px ;
  }
</style>
  <?php
    $agent = DB::table('saller_agent')->where('user_id' , auth()->user()->id)->first();

   /* $buyers = DB::table('users')
    ->distinct()
    ->select('users.*')
    ->join('comapny as c', 'c.user_id', '=', 'users.id')
    ->join('agent_assign_company as ac', 'ac.company_id', '=', 'c.id')
    ->where('ac.agent_id', $agent->agent_id )
    ->get();    */

    $buyers = DB::table('comapny as c') 
    ->select('c.*','is_verified')
    ->join('agent_assign_company as ac','ac.company_id','=','c.id')               
    ->join('saller_agent as a','a.agent_id','=','ac.agent_id')    
    ->whereNotIn('company_id', function ($query) {
     $query->select('buyer_id')                    
      ->from('agent_seller_agreement');
    }) 
    ->where('ac.agent_id', $agent->agent_id)   
    ->where('is_verified', 1)
    ->get();

    $category = DB::table('category')
    ->where('created_by', $agent->created_by)
    ->get();

    $sku_code = DB::table('sku_code')
    ->where('created_by',$agent->created_by)
    ->get();

    $selected_company = DB::table('comapny')
    ->where('id', Session::get('company_id'))
    ->first();
  ?>

        <style>

          input[type="file"]{
            display: none;
          } 

          .material-icons{
            font-size: 90px;
            color:  #01CC84;;
          }

          span.material-icons {
            border: solid;
            border-color: white;
            border-radius: 10px;
            box-shadow: 5px 5px 2.5px #f2f2f2;
          }

          #output_image
          {
            max-width:80px;
            border-radius: 12px;
            border: 1px solid #ccc;
            margin: 4px;
          }
        </style>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                Sales Agreement
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    @if(($buyers->count() > 0 ))
                    <div>
                      <form method="post" action="{{url('/agreement/submit')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">                          
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
                              <input type="checkbox" id="{{$c->id}}_chkAll" onclick="chkAll({{$c->id}})" class="{{$c->id}}_chkbox"> <b>Select All</b>
                              <hr>
                              <div class="row table_reponsive">  
                                <table class="table table-bordered text-center">
                                  <thead>
                                    <tr>
                                      <th scope="col">Select</th>
                                      <th scope="col">Product Image</th>
                                      <th scope="col">Product Name</th>
                                      <th scope="col">Discount Price</th>
                                      <th scope="col">Actual Price</th>
                                    </tr>
                                  </thead>
                                  <tbody>                                    
                                    <?php

                                    ///chna lagaya hai yaha par//// product.id ka
                                    $product = DB::table('product')
                                    ->distinct()
                                    ->select('product.id','product.images','product.name','product.acutal_price','product.discount_price','sku_code.name as sku_code_name')
                                    ->join('sku_code','sku_code.id','=','product.skucode')
                                    ->where('product.created_by',$agent->created_by)
                                   // ->where('product.company_id', '!=' ,Session::get('company_id'))
                                    //->where('product.company_id',$prents_company_id)
                                    ->where('product.category_id',$c->id)
                                    //->where('exported','not like', "%,".Session::get('company_id').",%" )
                                    ->get();                                    

                                    
                                    ?>
                                    @if(count($product) > 0)
                                    @foreach($product as $k => $pro)
                                    <?php 
                                    $image = explode(',', $pro->images);
                                    $single_image = $image[0];
                                    $percent = (($pro->acutal_price - $pro->discount_price)*100)/$pro->acutal_price;
                                    ?>
                                    <tr>
                                      <th class="text-center">
                                        <input type="checkbox" class="{{$c->id}}_chkbox" name="products[]" value="{{$pro->id}}"></th>
                                      <td>
                                        @if(isset($pro->images))
                                        <img src="{{url('product_images').'/'.$single_image}}" style="width: 60px;">
                                        @else
                                        <img src="{{url('product_images/product-image-dummy.jpg')}}" style="width: 60px;">
                                        @endif
                                      </td>
                                      <td><h6>{{$pro->name}}</h6></td>
                                      <td>
                                        <h6>{{$pro->discount_price}} RS</h6>
                                      </td>

                                      <td>
                                        <h6>{{$pro->acutal_price}} RS</h6>
                                      </td>                                      
                              
                                    </tr>

                                    @endforeach
                                    @else
                                    <p>No Product Found</p>
                                    @endif   

                                  </tbody>
                                </table>
                              </div>
                            </div>
                            @endforeach

                            <div class="row">
                             <div class="col-md-6">
                                <label>Select Buyer</label>
                                  <select name="buyer_id" class="form-control">
                                    @foreach($buyers as $buyer)
                                      <option value="{{$buyer->id}}">{{ ($buyer->company_name != "" ? ucfirst($buyer->company_name) : ucfirst($buyer->organization_name))}}</option>
                                    @endforeach
                                  </select> 
                                </div>
                                <div  class="col-md-6">
                                  <label>Discount Apply On</label>
                                  <select onchange="($(this).val() == 'over_all_order' ? ($('.dd').hide() , $('.order_type').show()) : ($('.dd').hide() , $('.quantity_type').show()) )" name="discount_apply_on" class="form-control">
                                      <option value="quantity">Quantity</option>
                                      <option value="over_all_order">Over All Order</option>
                                  </select>
                                </div>

                                <input type="hidden" name="agent_id" value="{{$agent->agent_id}}">
                                <input type="hidden" name="user_id" value="{{$agent->user_id}}">
                                <input type="hidden" name="seller_id" value="{{$agent->created_by}}">

                                <div class="col-md-6 quantity_type dd ">
                                  <label>Discount if Quantity</label>
                                 <input class="form-control" type="text" value="{{ old('quantity') }}" name="quantity">
                                </div>

                                <div class="col-md-6 order_type dd" style="display: none;">
                                  <label>Discount if Order Amount More Than</label>
                                 <input class="form-control" type="text" value="{{ old('amount_more_than') }}" name="amount_more_than">
                                </div>

                                <div class="col-md-6">
                                  <label>Discount Apply %</label>
                                 <input class="form-control" type="text" name="discount_applied" value="{{ old('discount_applied') }}">
                                </div>

                                 <div class="col-md-6">      
                                  <label>Upload Document</label>
                                  <div >
                                      <input type="file" class="form-control" name="image" id="file" accept="image/*"  onchange="show_image();" />
                                      <label for="file"> <span class="material-icons" style="font-size: 47px;">add_circle_outline</span></label>
                                      <span id="image_preview"></span>
                                  </div>
                              </div>
                            </div>

                          </div>                              

                          <input type="submit" name="submit" class="pull-right btn btn-primary"  style="margin-right: 6px;" value="Submit">
                      
                        </div>
                      </form>   
                      <br>
                    </div>
                    @else
                    <div class="alert alert-danger">You have to approve atleast one buyer company to create sales agreement.</div>
                    @endif
                  </div>    
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->
        
      <!-- Modal -->
      
    @endsection
    <script type="text/javascript">
      function chkAll(id){
        if ($("#"+id+"_chkAll").is(':checked')) {
          $("."+id+"_chkbox").prop('checked',true);
        }else{
          $("."+id+"_chkbox").prop('checked', false);
        }
      }

       function show_image() 
        {
         var total_file=document.getElementById("file").files.length;
         for(var i=0;i<total_file;i++)
         {
          $('#image_preview').html("<img id='output_image' src='"+URL.createObjectURL(event.target.files[i])+"' >");
         }
        }  
    </script>