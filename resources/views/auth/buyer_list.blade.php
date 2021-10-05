@extends('layouts.admin')
@section('content')
<?php
if(isset($_GET['company_type'])){
  $company_type= $_GET['company_type'];
}else{
  $company_type = ""; 
}

?>

<h3 style="margin-left: 5px; color: #9e9e9e;">Buyer List</h3>
<form action="" method="get">
                <div class="row search_input" style="margin-bottom: 10px">
                    <div class="col-sm-4">
                    <select class="form-control" name="company_type" id="company_type">
                                <option value="">-Select Company Type-</option>
                                <option value="registered" <?= ($company_type == "registered") ? 'selected' : '' ?>>Registered</option>
                                <option value="unregistered" <?= ($company_type == "unregistered") ? 'selected' : '' ?>>Un Registered</option>
                                </select>
                    </div>
                    <div class="col-sm-2">
                        <input type="submit" class="btn btn-success" style="background: #01cc84; color: #fff;" id="submit" value="Get Record" >
                    </div>
                </div>
            </form>
<div class="row">
  @foreach($confirm_data as $confirm)
  <?php
  $assign_company_data = DB::table('agent_assign_company')
  ->select('agent_assign_company.*','saller_agent.agent_name','saller_agent.agent_email','saller_agent.agent_phone','saller_agent.discount_percentage')
  ->join('saller_agent','agent_assign_company.agent_id', '=','saller_agent.agent_id')
  ->where('agent_assign_company.company_id',$confirm->buyer_company_id)
  ->first();
  ?>
  <div class="col-md-5">
<div class="card" onclick="ShowBuyerCompanyDetails(<?= $confirm->buyer_company_id; ?>)">
  <div class="row">
<div class="col-md-8">
  <h4 style="padding: 7px; text-transform: uppercase;">{{$confirm->buyer_name}}</h4>
  <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>POS:</b>{{$confirm->user_name}}</p>
  <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Status:</b>{{$confirm->status}}</p>
</div>
<div class="col-md-4 text-right" style="padding: 17px;">
<a class="btn btn-xs btn-dark" style="color:#fff;">
                  @if($confirm->comapny == "registered")
                  Registered
                  @else
                  Un Registered
                  @endif 
                                </a>
</div>
  </div>
  <div class="row">
    <div class="col-md-6">
    <h4 style="padding-left: 7px;">Company Details</h4>
    <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Company Name:</b>{{$confirm->buyer_name}}</p>
    <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Cell Number:</b>{{$confirm->phone_number}}</p>
    <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>NTN Number:</b>{{$confirm->ntn_number}}</p>
    <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Landline Number:</b>{{$confirm->landline_number}}</p>
    <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>STRN Number:</b>{{($confirm->strn_number)}}</p>
    </div>
    <div class="col-md-6">
    <h4 style="padding-left: 7px;">Agent Details</h4>
    <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Agent Name:</b>{{$assign_company_data->agent_name}}</p>
    <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Agent Email:</b>{{$assign_company_data->agent_email}}</p>
    <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Agent Contact No:</b>{{$assign_company_data->agent_phone}}</p>
    <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Agent Discount:</b>{{($assign_company_data->discount_percentage)}}</p>
    </div>
  </div>
  <div class="card-header text-center" style="padding: 0.5rem 1.25rem;">
                            <a class="btn btn-xs btn-primary" href="#">
                                    Create Order 
                                </a>

            </div>
</div>

</div>
@endforeach
</div>

<!-- Modal -->
<div class="modal fade" id="company_append_modal_3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="inner_html_company_data_3">
      
      </div>
    </div>
  </div>
</div>

@endsection
@section('scripts')

@parent
@endsection