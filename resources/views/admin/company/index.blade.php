@extends('layouts.admin')
@section('content')
<?php
$category = DB::table('category')
          ->where('created_by',auth()->user()->id)
          ->get();
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
            [data-toggle="collapse"] .fa:before {   
              content: "\f139";
            }

            [data-toggle="collapse"].collapsed .fa:before {
              content: "\f13a";
            }
            </style>

<div class="row">

    <div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h4 style="color: #01cc84;"><i class="fa fa-thumbs-up" aria-hidden="true" style="border-radius: 50%; background: #01cc84; padding: 4px; color: #fff;"></i> My Store</h4>
            <div class="row">
            <?php
            $confirm_data = DB::table('relation')
              ->select('relation.*','comapny.company_name as user_name','comapny.logo','comapny.comapny as comapny','comapny.organization_name as organization_name')
              ->join('comapny','relation.seller_company_id', '=', 'comapny.id')
              ->where('relation.status','approved')
              ->where('buyer_id',auth()->user()->id)
              ->where('buyer_company_id',Session::get('company_id'))
              ->get();
              ?>
            @if($confirm_data->count() > 0)
            @foreach($confirm_data as $confirm) 
            <div class="col-md-3">
            <a href="{{route('company/view_store',$confirm->seller_company_id)}}">
              <div class="card" style="box-shadow: none;">
                <div class="row">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-3" style="padding: 5px; padding-left: 16px;">
                    @if(empty($confirm->logo))
                    <img src="{{url('/theme/images/levis.png')}}" style="width: 100%;">
                    @else
                    <img src="{{url('/product_images/'.$confirm->logo)}}" style="width: 100%;">
                    @endif
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-6" style="padding: 5px;">
                      @if($confirm->comapny == "registered")
                            <h4>{{$confirm->user_name}}</h4>
                      @else
                          <h4>{{$confirm->organization_name}}</h4>
                      @endif
                      <p>Shop online</p>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-3" style="padding: 10px;">
                      <i class="fa fa-check" aria-hidden="true" style="font-size: 21px;color: #01cc84;"></i>
                    </div>
                </div>
              </div>
              </a>
            </div>
            @endforeach
            @else 
            <h4 style="padding: 5px;">No data found</h4>
            @endif

           </div>
           <h4 style="color: #01cc84;"><i class="fa fa-thumbs-down" aria-hidden="true" style="border-radius: 50%; background: #01cc84; padding: 4px; color: #fff;"></i> Pending request</h4>
            <div class="row">
            <?php
            $pending_data = DB::table('relation')
              ->select('relation.*','comapny.company_name as user_name','comapny.logo','comapny.comapny as comapny','comapny.organization_name as organization_name')
              ->join('comapny','relation.seller_company_id', '=', 'comapny.id')
              ->where('relation.status','pending')
              ->where('buyer_id',auth()->user()->id)
              ->where('buyer_company_id',Session::get('company_id'))
              ->get();
            ?>
            @if($pending_data->count() > 0)
            @foreach ($pending_data as $pend)
            <div class="col-md-3">
              <div class="card" style="box-shadow: none;">
                <div class="row">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-3" style="padding: 5px; padding-left: 16px;">
                    @if(empty($pend->logo))
                    <img src="{{url('/theme/images/levis.png')}}" style="width: 100%;">
                    @else
                    <img src="{{url('/product_images/'.$pend->logo)}}" style="width: 100%;">
                    @endif
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-6" style="padding: 5px;">
                      @if($pend->comapny == "registered")
                            <h4>{{$pend->user_name}}</h4>
                          @else
                          <h4>{{$pend->organization_name}}</h4>
                          @endif
                      <p>Shop online</p>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-3" style="padding: 10px;">
                    <i class="far fa-question-circle" aria-hidden="true" style="font-size: 21px;color: #ffeb3b;"></i>
                    </div>
                </div>
              </div>
            </div>
            @endforeach
            @else 
            <h4 style="padding: 5px;">No data found</h4>
            @endif
           </div>
            </div>
            
      </div>
      
      <div id="accordion">
        <?php
        
        $company_data = DB::table('comapny')
              ->where('id',Session::get('company_id'))
              ->first();


              $company_explode = explode(',',$company_data->company_type);
              foreach(array_filter($company_explode) as $key => $exp){
              $company_heading = DB::table('company_type')->where('id',$exp)->first();
              ?>
              
              <div class="" id="headingpanel{{$company_heading->id}}">
                <h5 class="mb-0">
                  <button class="btn btn-link" style="color: #01cc84; font-size: 15px; font-weight: bold;" data-toggle="collapse" data-target="#collapsepanel{{$company_heading->id}}" aria-expanded="<?= $key == 1 ? 'true' : 'false' ?>" aria-controls="collapsepanel{{$company_heading->id}}">
                  <i class="nav-icon fas fa-building" aria-hidden="true" style="border-radius: 50%; background: #01cc84; padding: 4px; color: #fff;margin-right: 5px;"></i> {{$company_heading->name}}
                  </button>
                </h5>
              </div>
              
              
              <?php
              $my_seller_companies = DB::table('comapny')->select('seller_company_id')
              ->where('buyer_company_id',Session::get('company_id'))
              ->from('relation')->pluck('seller_company_id')->toArray();
// print_r(Session::get('company_id')); die;
              $data =  DB::table('comapny')
              ->where('user_type','seller')
              ->where('company_type', 'like', '%,'.$exp.',%')
              ->whereNotIn('id', $my_seller_companies)
              ->get();
              ?>
              
              <div id="collapsepanel{{$company_heading->id}}" class="collapse <?= $key == 1 ? 'show' : '' ?>" aria-labelledby="headingpanel{{$company_heading->id}}" data-parent="#accordion">
              <div class="card-body">
              <div class="row">
              @foreach($data as $user)
                  <div class="col-md-3">
                  <a onclick="RequestSend(<?= $user->id ?>)" style="cursor: pointer;">
                    <div class="card" style="box-shadow: none;">
                      <div class="row">
                          <div class="col-lg-3 col-sm-3 col-md-3 col-3" style="padding: 5px; padding-left: 16px;">
                          @if(empty($user->logo))
                          <img src="{{url('/theme/images/levis.png')}}" style="width: 100%;">
                          @else
                          <img src="{{url('/product_images/'.$user->logo)}}" style="width: 100%;">
                          @endif
                          </div>
                          <div class="col-lg-6 col-sm-6 col-md-6 col-6" style="padding: 5px;">
                          @if($user->comapny == "registered")
                            <h4>{{$user->company_name}}</h4>
                          @else
                          <h4>{{$user->organization_name}}</h4>
                          @endif
                            <p>Shop online</p>
                          </div>
                          <div class="col-lg-3 col-sm-3 col-md-3 col-3 text-center" style="padding: 10px;">
                            <i class="far fa-question-circle" aria-hidden="true" style="font-size: 21px;color: #ffeb3b;"></i>
                          </div>
                      </div>
                    </div>
                  </a>
                  </div>
              @endforeach  
              </div>    
              </div>
            </div>
            
            <?php
              }
            ?>
              </div>
    </div>
    
</div>

<!-- Modal -->
<div class="modal fade" id="company_request_pending" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="inner_data">
        
        </div>
    </div>
  </div>
</div>

@endsection
@section('scripts')
@parent

@endsection
