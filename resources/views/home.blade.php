@extends('layouts.admin')

@section('content')

@if(auth::user()->roles[0]->id ==5)

<?php

    $agent = DB::table('saller_agent')->where('user_id','=',auth::user()->id)->first();    
$company_data = DB::table('comapny as c') 
    ->SELECT('c.*','is_verified')
    ->join('agent_assign_company as ac','ac.company_id','=','c.id')               
    ->join('saller_agent as a','a.agent_id','=','ac.agent_id')    
    ->where('ac.agent_id', $agent->agent_id)   
    ->get(); 
?>
<style>.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: black;
    border-radius: 0;
    background-color: transparent;
    border-bottom: 3px solid #01CC84;
    
}
@media screen and (max-width: 600px){
    .nmhnxtcard{
      width:100% !important;
    }
}
</style>
<div>

    <div class="row" style="display: flex;padding-bottom: 30px;">
    <h4 style="font-weight: 400; font-size: 30px;" >Register Company</h4>
</div>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="display: flex; margin-left: 29px;">
<li class="nav-item">
    <a class="nav-link" style="color: #54667a;" id="pills-register-tab" href="{{url('Buyer/register')}}" aria-selected="true">Register Account</a>
</li>
<li class="nav-item">
    <a class="nav-link active" id="pills-verify-tab" data-toggle="pill" href="#pills-verify" role="tab" aria-controls="pills-verify" aria-selected="false">Verify Account</a>
</li>

</ul>
<div class="nmh_inner_tab_main" style="display: flex;">
<div class="tab-content" id="pills-tabContent" style="border: none;">

@foreach($company_data as $company)

  <div class="tab-pane fade show active" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab">
    <button class="btn btn-success" Type="button" style="font-weight: 500;  padding-left: 30px;padding-right: 30px; background: gainsboro;border: navajowhite;font-weight: 300;font-size: 17px;padding-left: 30px;padding-right: 30px; margin: 3px;">{{ ($company->company_name != "" ? ucfirst($company->company_name) : ucfirst($company->organization_name))}}</button> <br>
    <div class="card nmhnxtcard" style="    width: 100%;
    padding: 5px;
    padding-left: 10px;
    box-shadow: 1px 1px 4px 1px grey;
    padding-right: 50px;box-shadow: 1px 1px 4px 1px grey;">
      <div class="row">
      <div class="col">
            <table style="font-size: 16px;">
                <tr>
                    <td>
                    @if(empty($company->logo))
                    <img src="{{url('/theme/images/levis.png')}}" style="width: 80px;">
                    @else
                    <img src="{{url('/product_images/'.$company->logo)}}" style="width: 80px;">
                    @endif
                    </td>
                </tr>
               
            </table>
        </div>
        <div class="col">
            <table style="font-size: 16px;">
                <tr>
                    <td style="font-weight: 500;">Status</td>
                </tr>
                <tr>
                    <td>
                        {{$company->is_verified == 0 ? 'Pending' : 'Approved'}}
                    </td>
                </tr>
            </table>
        </div>
        <div class="col">
            <table style="text-align: center;">
                <tr>
                    <td style="font-weight: 500;">Details</td>
                </tr>
                <tr>
                    <td>
                        <a class="btn btn-success"onclick="ShowCopmany(<?= $company->id ?>)"  style="background: #01cc84; color: #fff;width: 100%;border-radius: 0px !important;">View</a>
                    </td>
                </tr>
            </table>
        </div>       
      </div>
    </div>
  </div>
  @endforeach
   <!-- record 2!-->   
</div>
  </div>
</div>

@else

<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Sales chart -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- Column -->
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daily Sales</h4>
                    <div class="text-right">
                        <h2 class="font-light m-b-0"><i class="ti-arrow-up text-success"></i>$120</h2>
                        <span class="text-muted">Todays Income</span>
                    </div>
                    <span class="text-success">80%</span>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar"
                        style="width: 80%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                        aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Weekly Sales</h4>
                    <div class="text-right">
                        <h2 class="font-light m-b-0"><i class="ti-arrow-up text-info"></i> $5,000</h2>
                        <span class="text-muted">Todays Income</span>
                    </div>
                    <span class="text-info">30%</span>
                    <div class="progress">
                        <div class="progress-bar bg-info" role="progressbar"
                        style="width: 30%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                        aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Monthly Sales</h4>
                    <div class="text-right">
                        <h2 class="font-light m-b-0"><i class="ti-arrow-up text-info"></i> $5,000</h2>
                        <span class="text-muted">Todays Income</span>
                    </div>
                    <span class="text-info">30%</span>
                    <div class="progress">
                        <div class="progress-bar bg-info" role="progressbar"
                        style="width: 30%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                        aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Yearly Sales</h4>
                    <div class="text-right">
                        <h2 class="font-light m-b-0"><i class="ti-arrow-up text-info"></i> $5,000</h2>
                        <span class="text-muted">Todays Income</span>
                    </div>
                    <span class="text-info">30%</span>
                    <div class="progress">
                        <div class="progress-bar bg-info" role="progressbar"
                        style="width: 30%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                        aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- ============================================================== -->
    <!-- Sales chart -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- column -->
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Revenue Statistics</h4>
                    <div class="flot-chart">
                        <div class="flot-chart-content " id="flot-line-chart"
                        style="padding: 0px; position: relative;">
                        <canvas class="flot-base w-100" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Revenue Statistics</h4>
                <div class="flot-chart">
                    <div id="myfirstchart" style="height: 250px;"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- column -->
</div>
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- ============================================================== -->

<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->

@endif
<!-- Modal -->
<div class="modal fade" id="company_append_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="inner_html_company_data">
      
      </div>
    </div>
  </div>
</div>    
@endsection
@section('scripts')
@parent

@endsection
@if(isset($company_count) && $company_count == 0 && auth::user()->roles[0]->id == 3)
<!-- Modal -->
<div class="modal fade" style="z-index: 9999999; background: #00000061;" id="invent-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">No record of inventory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    You have no record of your inventory Please add inventory records 
</div>
<div class="modal-footer">
    <a href="{{url('/admin/inventory')}}">
        <button type="button" class="btn btn-primary">OK</button>
    </a>
</div>
</div>
</div>
</div>

<script type="text/javascript">   
    window.onload = (event) => {
        $("#invent-modal").modal('show')
    };

</script>
@endif