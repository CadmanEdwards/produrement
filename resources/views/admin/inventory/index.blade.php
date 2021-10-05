@extends('layouts.admin')
@section('content')
<?php
if(Auth::user()->roles[0]->id == 3){
$category = DB::table('category')
          ->where('created_by',auth()->user()->id)
          ->get();
        }else{
          $category = DB::table('category')
          ->get();

        }

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
                border-color: red !important; 
                background-color: red !important; 
            } 

          .custom-control-label::before { 
                border-color: #01cc84 !important; 
                background-color: #01cc84 !important; 
            } 

            .custom-switch .custom-control-label:after{
              background-color: #fff !important;
            }
  
            /*sets the background color of 
          switch to violet when it is active*/ 
            .custom-control-input:active ~  
          .custom-control-label::before { 
                background-color: red !important; 
                border-color: red !important; 
            } 
  
            /*sets the border color of switch 
          to violet when it is not checked*/ 
            .custom-control-input:focus: 
          not(:checked) ~ .custom-control-label::before { 
                border-color: red !important; 
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
            .image_body img{
              width: 100%;
              border-top-right-radius: 10px; 
              border-top-left-radius: 10px;
              height: 164px;
              margin-bottom:10px ;
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
<h3 style="margin-left: 5px;">Inventory List</h3>
<div class="row">

    <div class="col-md-12">
    <div class="card">
    

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
                <div class="row">
                <?php
                if(Auth::user()->roles[0]->id == 3){
                $product = DB::table('product')
                ->select('product.*','sku_code.name as sku_code_name')
                ->join('sku_code','sku_code.id','=','product.skucode')
                ->where('product.created_by',auth()->user()->id)
                ->where('product.company_id',Session::get('company_id'))
                ->where('product.category_id',$c->id)
                ->get();
                }else{
                  $product = DB::table('product')
                  ->select('product.*','sku_code.name as sku_code_name')
                  ->join('sku_code','sku_code.id','=','product.skucode')
                  ->where('product.category_id',$c->id)
                  ->get();
                }
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
                 <p class="text-center" style="margin-bottom: 1px;"><b>Price: </b>{{$pro->discount_price}} / {{$pro->sku_code_name}}</p>
                 <p class="text-center" style="margin-bottom: 1px;"><b>Actual Price: </b><del>{{$pro->acutal_price}}</del> <span style="color:red; font-size:14px;">{{round($percent)}}%</span></p>

                 <div class="row" style="padding: 5px;">
                 <div class="col col-md-7 col-sm-7"><a style="float: left;"><div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input"  value="{{$pro->id}}" id="customSwitch{{$pro->id}}" <?= ($pro->is_show == 0) ? 'checked' : '' ?>>
                <label class="custom-control-label" style="color: #01cc84; " for="customSwitch{{$pro->id}}">Display Or not</label>
                </div></a></div>
                 <div class="col col-md-5 col-sm-5"><a href="{{ route('admin.Inventory.edit', $pro->id) }}" style="float: right; font-size: 14px; color: #01cc84;"><i class="fas fa-edit"></i>Edit</a></div>
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
       <input type='file' style="display:block;" name='file' >
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

@section('scripts')
<script>
    $(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
              var product_id = $(this).val();
              $.ajax({
                type:    'post',
                url:     '{{route('active_inventory')}}',
                data:    {
                  _token: "{{ csrf_token() }}",
                            id:product_id,
                },success: function (data) {
                  console.log(data);
                },
                error: function () {
                        
                        }
               });
              //alert($('input[type="checkbox"]').val()+"Checkbox is checked.");
            }
            else if($(this).prop("checked") == false){
              
              var product_id = $(this).val();
              $.ajax({
                type:    'post',
                url:     '{{route('deactive_inventory')}}',
                data:    {
                  _token: "{{ csrf_token() }}",
                            id:product_id,
                },success: function (data) {
                  console.log(data);
                },
                error: function () {
                        
                        }
               });
            }
        });
    });
</script>
@parent

@endsection