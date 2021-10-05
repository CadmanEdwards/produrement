@extends('layouts.admin')
@section('content')


<h3 style="margin-left: 5px; color: #9e9e9e;">Company List</h3>
<div class="row">
  @foreach($company as $confirm)
  <div class="col-md-6">
<div class="card">
  <div class="row">
<div class="col-md-8">
  <h4 style="padding: 7px; text-transform: capitalize;">{{($confirm->comapny == "registered" ? $confirm->company_name : $confirm->organization_name)}}{{($confirm->comapny == "registered" ? '('.$confirm->comapny_type.')' : "")}}</h4>
  <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Seller Name:</b>{{$confirm->user_name}}</p>
  <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Status:</b>{{$confirm->company_name}}</p>
</div>
<div class="col-md-4 text-center" style="padding: 17px;">
<a class="btn btn-xs btn-primary" style="color:#fff;">
                                    Verified 
                                </a>
</div>
  </div>
  <div class="row">
    <div class="col-md-5">
    <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>CNIC Number:</b>{{$confirm->cnic_number}}</p>
    <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>NTN Number:</b>{{$confirm->ntn_number}}</p>
    <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Registered Address:</b>{{$confirm->registered_address}}</p>
    </div>
    <div class="col-md-7">
    <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Landline Number:</b>{{$confirm->landline_number}}</p>
    <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>STRN Number:</b>{{($confirm->strn_number)}}</p>
    <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Delivery Address:</b>{{($confirm->delivery_address)}}</p>
    </div>
  </div>
  <div class="card-header text-center" style="padding: 0.5rem 1.25rem;">
                            <a class="btn btn-xs btn-primary" href="#">
                                    View Details 
                            </a>
 </div>
</div>

</div>
@endforeach
</div>

@endsection
@section('scripts')

@parent
@endsection