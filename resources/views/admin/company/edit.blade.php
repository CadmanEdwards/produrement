@extends('layouts.admin')
@section('content')
<style>
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey
}

#progressbar .active {
    color: #01cc84;
}

#progressbar li {
    list-style-type: none;
    font-size: 12px;
    width: 33%;
    float: left;
    position: relative;
    text-align: center;
}

#progressbar #account:before {
    content: "\f007";
    color: transparent;
}

#progressbar #personal:before {
    content: "\f007";
    color:transparent;
}

#progressbar #payment:before {
    content: "\f007";
    color:transparent;
}


#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 18px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: #01cc84
}

.nav-tabs .nav-link.active {
    color: #9e9e9e;
    background-color: #fff;
    border-color: transparent;
    font-size: 16px;
    border-bottom: 2px solid #01cc84;
}
.nav-tabs .nav-link {
    color: #000000c7;
    font-size: 16px;
}
</style>
<div class="row">
    <div class="col-md-12">
<div class="card">
    <div class="card-header">
        Edit Company
    </div>

    <div class="card-body">
        
    <div class="container">

<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
              
    <div class="row justify-content-center">
        <div class="col-md-8">
            
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="account"><strong>Registration</strong></li>
                                <li class="active" id="personal"><strong>Company Registration</strong></li>
                                <li id="payment"><strong>Field Of Interest</strong></li>
                            </ul> <!-- fieldsets -->
                <div class="login_heading text-center">
                    <h2 style="padding: 10px; border-bottom: 1px solid #ccc; width: 90%; margin: 0 auto;">Company Registration</h2>
                
                    </div>

                    <div class="card-body">
                        
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" style="width: 50%;">
                                <a class="nav-link {{($company->comapny == 'registered') ? 'active' : ''}}" id="home-tab" data-toggle="tab" href="#registered" role="tab" aria-controls="home" aria-selected="true">Registered</a>
                            </li>
                            <li class="nav-item" style="width: 50%;">
                                <a class="nav-link {{($company->comapny == 'unregistered') ? 'active' : ''}}" id="profile-tab" data-toggle="tab" href="#unregistered" role="tab" aria-controls="profile" aria-selected="false">Un-Registered</a>
                            </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade {{($company->comapny == 'registered') ? 'show active' : ''}}" id="registered" role="tabpanel" aria-labelledby="home-tab">
                                    <form method="POST" action="{{ route('company.register.update') }}" enctype="multipart/form-data">
                                    @csrf  
                                    <div class="form-group">
                                    <label for="company_type" class="col-form-label text-md-right">Comapny Type</label>
                                     <select id="company_type" style="height: 43px; background: #f9faff;" class="form-control " name="company_type" required="">
                                        <option value="">-select-</option>
                                        <option value="PVT ltd" {{ ($company->comapny_type == "PVT ltd") ? "selected" : '' }}>PVT ltd</option>
                                    </select>
                                    
                                    </div>
                                    <div class="form-group">
                                    <label for="company_name" class="col-form-label text-md-right">Comapny Name</label>
                                      <input id="company_name" type="text" style="height: 43px; background: #f9faff;" value="{{$company->company_name ?? ''}}" class="form-control" name="company_name" required="">
                                    
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5" style="padding: 8px;">
                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="ntn" id="ntn" value="ntn" onclick="show2();"  {{ ($company->ntn == "ntn") ? "checked" : '' }}>
                                    <label class="form-check-label" for="ntn">NTN</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="ntn" id="ntn_sales_tax" onclick="show1();" value="ntn sales tax" {{ ($company->ntn == "ntn sales tax") ? "checked" : '' }}>
                                    <label class="form-check-label" for="ntn_sales_tax">NTN - Sales Tax</label>
                                    </div>  
                                    </div>
                                    <div class="col-md-7">
                                    <div class="form-group row">
                                        <label for="logo" class="col-sm-3 col-form-label">logo</label>
                                        <div class="col-sm-9">
                                        <input type="file" style="height: 37px; background: #f9faff;" name="logo" class="form-control" id="logo">
                                      <br/>
                                      @if(!empty($company->logo))
                                      <img class="img-thumbnail" src="{{url('product_images/'.$company->logo)}}" style="width:80px;">    
                                     @endif
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="form-group strn_number" id="strn_number" style="display:none; margin-top: 12px;">
                                            <label for="strn_number" class="col-form-label text-md-right">STRN Number</label>
                                            <input id="strn_number" type="text" value="{{$company->strn_number ?? ''}}" style="height: 43px; background: #f9faff;" class="form-control " name="strn_number">
                                            
                                    </div>


                                    <div class="form-group" style="margin-top: 12px;">
                                            <label for="cnic_number" class="col-form-label text-md-right">CNIC Number</label>
                                            <input id="cnic_number" type="number" value="{{$company->cnic_number ?? '' }}" style="height: 43px; background: #f9faff;" class="form-control " name="cnic_number" required="">
                                            
                                    </div>

                                    
                                    <div class="form-group">
                                            <label for="ntn_number" class="col-form-label text-md-right">NTN Number</label>
                                            <input id="ntn_number" type="text" style="height: 43px; background: #f9faff;" value="{{$company->ntn_number ?? '' }}" class="form-control " name="ntn_number" required="">
                                            
                                    </div>

                                    <div class="form-group">
                                    <label for="registered_address" class="col-form-label text-md-right">Registered Address</label>
                                      <input id="registered_address" type="text" style="height: 43px; background: #f9faff;" value="{{$company->registered_address ?? '' }}" class="form-control " name="registered_address" required="">
                                    </div>

                                    <div class="form-group">
                                    <label for="delivery_address" class="col-form-label text-md-right">Delivery Address</label>
                                      <input id="delivery_address" type="text" style="height: 43px; background: #f9faff;" class="form-control " value="{{$company->delivery_address ?? '' }}" name="delivery_address" required="">
                                    
                                    </div>
                                    <div class="form-group">
                                    <label for="landline_number" class="col-form-label text-md-right">Landline Number</label>
                                      <input id="landline_number" type="number" style="height: 43px; background: #f9faff;" class="form-control " value="{{$company->landline_number ?? '' }}" name="landline_number" required="">
                                    </div>
                                    <input type="hidden" name="company_id" value="{{$company->id ?? '' }}">
                       

                                    <div class="form-group mb-0">
                                        
                                            <button type="submit" class="btn btn-success btn-block" style="background-color: #e4e4e4;color: #9e9e9e; border: none; height: 39px;">
                                                {{ __('Register Company') }}
                                            </button>
                                        
                                    </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade {{($company->comapny == 'unregistered') ? 'show active' : ''}}" id="unregistered" role="tabpanel" aria-labelledby="profile-tab">
                                <form method="POST" action="{{ route('company.unregister.update') }}" enctype="multipart/form-data">
                                    @csrf  
                                    <div class="form-group">
                                    <label for="organization_name" class="col-form-label text-md-right">Organization / Individual Name</label>
                                      <input id="organization_name" value="{{$company->organization_name ?? ''}}" type="text" style="height: 43px; background: #f9faff;" class="form-control " name="organization_name" required="">
                                    </div>
                                      
                                    <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group" style="margin-top: 12px;">
                                            <label for="cnic_number" class="col-form-label text-md-right">CNIC Number</label>
                                            <input id="cnic_number" value="{{$company->cnic_number ?? ''}}" type="number" style="height: 43px; background: #f9faff;" class="form-control " name="cnic_number" required="">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group" style="margin-top: 12px;">
                                            <label for="logo" class="col-form-label text-md-right">Company logo</label>
                                            <input id="logo" type="file" style="height: 43px; background: #f9faff;" class="form-control " name="logo">
                                    </div>
                                    </div>
                                    </div>

                                    <div class="form-group">
                                    <label for="registered_address" class="col-form-label text-md-right">Registered Address</label>
                                      <input id="registered_address" value="{{$company->registered_address ?? ''}}" type="text" style="height: 43px; background: #f9faff;" class="form-control " name="registered_address" required="">
                                    </div>

                                    <div class="form-group">
                                    <label for="delivery_address" class="col-form-label text-md-right">Delivery Address</label>
                                      <input id="delivery_address" value="{{$company->delivery_address ?? ''}}" type="text" style="height: 43px; background: #f9faff;" class="form-control " name="delivery_address" required="">
                                    
                                    </div>
                                    <div class="form-group">
                                    <label for="landline_number" class="col-form-label text-md-right">Landline Number</label>
                                      <input id="landline_number" type="number" value="{{$company->landline_number ?? ''}}" style="height: 43px; background: #f9faff;" class="form-control " name="landline_number" required="">
                                    </div>
                                    <input type="hidden" name="company_id" value="{{$company->id ?? '' }}">
                       

                                    <div class="form-group mb-0">
                                        
                                            <button type="submit" class="btn btn-success btn-block" style="background-color: #e4e4e4;color: #9e9e9e; border: none; height: 39px;">
                                                {{ __('Register Company') }}
                                            </button>
                                        
                                    </div>
                                    </form>

                
                                </div>
                    
                            </div>
                            <div class="text-center">
                            <a href="{{route('company/fieldofinterset/edit_view',Session::get('company_id'))}}" style="color: #01cc84; font-size: 13px; font-weight: 500;">Edit Field of interest<a>
                            </div>
                    </div>
                    
                </div>
                
                                
                        
            
        </div>
    </div>
    
</div>
</div>

    </div>
</div>
</div>
</div>


<script>
function show1(){
  document.getElementById('strn_number').style.display ='block';
}
function show2(){
  document.getElementById('strn_number').style.display = 'none';
}
</script>
@endsection