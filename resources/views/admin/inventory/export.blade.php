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

//use Illuminate\Contracts\Session\Session;

$category = DB::table('category')
  ->where('created_by',auth()->user()->id)
  ->get();

  $sku_code = DB::table('sku_code')
  ->where('created_by',auth()->user()->id)
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
@can('inventory')
    <div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-5"></div>    
    <div class="col-lg-2">
              <button class="btn btn-success btn-block" data-toggle="modal" data-target="#import_inventory" style="color:#fff; background: #01cc84;">
              Import Inventory
              </button>
      </div>
    <div class="col-lg-3">
    <button class="btn btn-success btn-block" data-toggle="modal" data-target="#import_parents_inventory" style="color:#fff; background: #01cc84;">
              Copy Inventory
              </button>
      </div>  
    <div class="col-lg-2">
              <a class="btn btn-success btn-block" href="{{ route("admin.inventory.create") }}" style="color:#fff; background: #01cc84;">
              Inventory Add
              </a>
      </div>
    </div>
@endcan
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Export Inventory
        </div>
        <div class="card-body">
          <div class="row">

    <div class="col-md-12">
      <div>
        <form method="post" action="{{url('/export/submit')}}" enctype="multipart/form-data">
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
                      @if($selected_company->comapny == "registered")
                      <th scope="col">GST</th>
                      @endif
                      <th scope="col">Change Price</th>
                    </tr>
                  </thead>
                  <tbody>
                <?php
                  $product = DB::table('product')
                  ->select('product.*','sku_code.name as sku_code_name')
                  ->join('sku_code','sku_code.id','=','product.skucode')
                  ->where('product.created_by',auth()->user()->id)
                  ->where('product.company_id', '!=' ,Session::get('company_id'))
                  ->where('product.company_id',$prents_company_id)
                  ->where('product.category_id',$c->id)
                  ->where('exported','not like', "%,".Session::get('company_id').",%" )
                  ->get();
                ?>
                @if(count($product) > 0)
                @foreach($product as $pro)
                <?php 
                  $image = explode(',', $pro->images);
                  $single_image = $image[0];
                  $percent = (($pro->acutal_price - $pro->discount_price)*100)/$pro->acutal_price;
                ?>
                <tr>
                      <th class="text-center"><input type="checkbox" class="{{$c->id}}_chkbox" name="products[]" value="{{$pro->id}}"></th>
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
                      @if($selected_company->comapny == "registered")
                      <td>
                      <h6>{{$pro->gst}} %</h6>
                      </td>
                      @endif
                      <td>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        </div>
                        <input type="number" min="1" class="form-control" name="{{$pro->id}}_price" value="{{$pro->discount_price}}" style="height: 35px;">
                        <div class="input-group-append">
                          <span class="input-group-text" style="background: #01cc84; color: #fff;">RS</span>
                        </div>
                      </div>
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
                </div>
              </div>
              <input type="submit" name="submit" class="pull-right btn btn-primary"  style="margin-right: 6px;" value="Submit">
            </form>      
            <br>
          </div>
        </div>    
      </div>
    </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="import_inventory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Import Inventory CSV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
      <form method='post' action='{{URL("/uploadFile")}}' enctype='multipart/form-data' >
       {{ csrf_field() }}
       <input type='file' name='file' >
       <br/>
       <br/>
     
       <input class="btn btn-primary" type='submit' name='submit' value='Import Inventory'>
      </form>
      </div>
      <div class="col-md-4">
      <a style="color:#fff" href="{{url('product_images/sample.csv')}}" target="_blank" class="btn btn-secondary">Download Sample CSV</a>
      </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="import_parents_inventory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Copy Inventory For Another Company</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php
      $company_parents = DB::table('comapny')
         ->where('user_id',auth()->user()->id)
         ->where('id','!=',Session::get('company_id'))
         ->get()
      ?>
      <div class="modal-body">
      <form method='post' action='{{URL("/copy_inventory_for_inventory")}}' enctype='multipart/form-data' >
       {{ csrf_field() }}
       <div class="form-group ">
                <label for="company_id">Select Company*</label>
                <select for="company_id" id="company_id" name="company_id" class="form-control">
                <option value="">-Select-</option>
                @foreach($company_parents as $parents)
                @if($parents->comapny == "registered")
                <option value="{{$parents->id}}">{{$parents->company_name.'('.$parents->comapny.')'}}</option>
                @else
                <option value="{{$parents->id}}">{{$parents->organization_name.'('.$parents->comapny.')'}}</option>
                @endif
                @endforeach
                </select>
       </div>
     
       <input class="btn btn-primary" style="float: right;" type='submit' name='submit' value='Select Company'>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
@endsection
<script type="text/javascript">
  function chkAll(id){
    if ($("#"+id+"_chkAll").is(':checked')) {
      $("."+id+"_chkbox").prop('checked',true);
    }else{
      $("."+id+"_chkbox").prop('checked', false);
    }
  }
</script>