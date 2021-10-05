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
.custom-control-label:before{
  background-color:#01cc84;
}
.verification_code-input:checked~.custom-control-label::before{
  background-color:#01cc84;
}
</style>

<div class="login_heading text-center">
<h2 style="padding: 10px; width: 90%; margin: 0 auto;"><i class="fa fa-thumbs-up" aria-hidden="true" style="border-radius: 50%; background: #01cc84; padding: 7px; color: #fff; margin-right: 10px;"></i>Verification Of CNIC</h2>
</div>
        @if(!empty($company_data->cnic_front_image))
        <div class="row">
        <div class="col-md-6">
        <h3>CNIC Front Image</h3>
        <img  src="{{url('cnic_images/'.$company_data->cnic_front_image)}}" style="width:100%">
        </div>
        <div class="col-md-6">
        <h3>CNIC Back Image</h3>
        <img  src="{{url('cnic_images/'.$company_data->cnic_back_image)}}" style="width:100%">
        </div>
        </div>
        @else
        <p>No Image Found</p>
        @endif
          
@endsection