@extends('layouts.app')

@section('content')

<style>


.card {
    z-index: 0;
    border: none;
    border-radius: 0.5rem;
    position: relative
}



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

.upper_section_heading {
    width: 100%;
    border-bottom: 2px solid #01cc84;
    line-height: 0.1em;
}
.upper_box { 
    background:#f3f3f3; 
    padding: 0px 2px;
    color: #01cc84;
}
.upper_section_heading_with {
    width: 100%;
    border-bottom: 2px solid #ccc;
    line-height: 0.1em;
}
.upper_box_with { 
    background:#f3f3f3; 
    padding: 0px 2px;
    color: #ccc;
}

.test4{
    background: #01cc84; 
    color: #fff; 
    padding: 3px 9px 3px 9px; 
    font-size:12px;
}
.test5{
    background: #ccc; 
    color: #fff; 
    padding: 3px 9px 3px 9px; 
    font-size:12px;
}
body{
    background-color: #f3f3f3;
}
@media only screen and (max-width: 600px) {
    .upper_section_heading {
    width: 100%;
    border-bottom: none;
    line-height: 0.1em;
    }
    .upper_section_heading_with {
    width: 100%;
    border-bottom: none;
    line-height: 0.1em;
    }
    .test4{
    display: none;
    }
    .test5{
    display: none;
    }
}

</style>
<div class="container">

<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
              
    <div class="row justify-content-center">
        <div class="col-md-6">
        <div class="row" style="    margin-bottom: 19px; margin-top: 19px;">
                <div class="col" style="padding: 0px;">
                    <h6 class="upper_section_heading">
                        <span class="upper_box">
                            <small class="test4">1</small>
                            Registration
                            </span>
                        </h6>
                </div>
                <div class="col" style="padding: 0px;">
                <h6 class="text-center upper_section_heading">
                    <span class="upper_box">
                        <small class="test4">2</small>
                        Company Registration
                    </span>
                </h6>
                </div>
                <div class="col" style="padding: 0px;">
                <h6 class="upper_section_heading_with" style="text-align: right;">
                    <span class="upper_box_with"><small class="test5">3</small> Field Of Interest</span></h6>
                </div>
            </div>
            <div class="card" style="border: none;">
            
            
                <div class="login_heading text-center">
                    <h2 style="padding: 10px; border-bottom: 1px solid #ccc; width: 90%; margin: 0 auto;">Company Registration</h2>
                
                    </div>

                    <div class="card-body">
                        
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" style="width: 50%;">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#registered" role="tab" aria-controls="home" aria-selected="true">Registered</a>
                            </li>
                            <li class="nav-item" style="width: 50%;">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#unregistered" role="tab" aria-controls="profile" aria-selected="false">Un-Registered</a>
                            </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="registered" role="tabpanel" aria-labelledby="home-tab">
                                    <form method="POST" action="{{ route('company.register.store') }}" enctype="multipart/form-data">
                                    @csrf  
                                    <div class="form-group">
                                    <label for="company_type" class="col-form-label text-md-right">Comapny Type</label>
                                     <select id="company_type" style="height: 43px; background: #f9faff;" class="form-control " name="company_type" required="">
                                        <option value="">-select-</option>
                                        <option value="PVT ltd">PVT ltd</option>
                                    </select>
                                    
                                    </div>
                                    <div class="form-group">
                                    <label for="company_name" class="col-form-label text-md-right">Comapny Name</label>
                                      <input id="company_name" type="text" style="height: 43px; background: #f9faff;" class="form-control " name="company_name" required="">
                                    
                                    </div>
                                    <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ntn" id="ntn" value="ntn" onclick="show2();"  checked>
                                        <label class="form-check-label" for="ntn">NTN</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ntn" id="ntn_sales_tax" onclick="show1();" value="ntn sales tax">
                                        <label class="form-check-label" for="ntn_sales_tax">NTN - Sales Tax</label>
                                        </div>  
                                    </div>
                                    <div class="col-md-7">
                                    <div class="form-group row">
                                        <label for="logo" class="col-sm-3 col-form-label">logo</label>
                                        <div class="col-sm-9">
                                        <input type="file" style="height: 37px; background: #f9faff;" name="logo" class="form-control" onchange="loadFile(event)" id="logo" accept="image/*">
                                        <img id="output" src="#" onclick="logoImage()" style="width:100px; height:50px; display: none; margin-top:5px;" class="rounded float-right"/>
                                        </div>
                                        
                                    </div>
                                    </div>
                                    </div>
                                    <div class="form-group row strn_number" id="strn_number" style="display:none; margin-top: 12px;">
                                            <div class="col-md-6">
                                            <label for="strn_number" class="col-form-label text-md-right">STRN Number</label>
                                            <input id="strn_number" type="text" style="height: 43px; background: #f9faff;" class="form-control " name="strn_number">
                                            </div>
                                            <div class="col-md-6">
                                            <label for="strn_image" class="col-form-label text-md-right">STRN Image</label>
                                            <input id="strn_image" type="file" style="height: 43px; background: #f9faff;" class="form-control " name="strn_image" onchange="loadFile_4(event)" accept="image/*">
                                            <img id="show_strn_image" onclick="STRNImage();" src="#" style="width:100px; height:50px; display: none; margin-top:5px;" class="rounded float-right"/>
                                            </div>
                                    </div>


                                    <div class="form-group" style="margin-top: 12px;">
                                            <label for="cnic_number" class="col-form-label text-md-right">CNIC Number</label>
                                            <input id="cnic_number" type="number" style="height: 43px; background: #f9faff;" class="form-control " name="cnic_number" required="">
                                            
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                            <label for="cnic_front_image" class="col-form-label text-md-right">CNIC Front Image</label>
                                            <input id="cnic_front_image" type="file" style="height: 37px; background: #f9faff;" class="form-control " name="cnic_front_image" onchange="loadFile_2(event)" accept="image/*" required="">
                                            <img id="image_cnic_front_image" onclick="CnicFrontImage();" src="#" style="width:100px; height:50px; display: none; margin-top:5px;" class="rounded float-right"/>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="cnic_back_image class="col-form-label text-md-right">CNIC Back Image</label>
                                                <input id="cnic_back_image" type="file" style="height: 37px; background: #f9faff;" class="form-control " name="cnic_back_image" onchange="loadFile_3(event)" accept="image/*" required="">
                                                <img id="image_cnic_back_image" onclick="CnicBackImage();" src="#" style="width:100px; height:50px; display: none; margin-top:5px;" class="rounded float-right"/>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="ntn_number" class="col-form-label text-md-right">NTN Number</label>
                                            <input id="ntn_number" type="text" style="height: 43px; background: #f9faff;" class="form-control " name="ntn_number" required="">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="ntn_image" class="col-form-label text-md-right">NTN Image</label>
                                            <input id="ntn_image" type="file" style="height: 43px; background: #f9faff;" class="form-control " name="ntn_image" required="" onchange="loadFile_5(event)" accept="image/*">
                                            <img id="show_ntn_image" src="#" onclick="NTNImage();" style="width:100px; height:50px; display: none; margin-top:5px;" class="rounded float-right"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <label for="registered_address" class="col-form-label text-md-right">Registered Address</label>
                                      <input id="registered_address" type="text" style="height: 43px; background: #f9faff;" class="form-control " name="registered_address" required="">
                                    </div>

                                    <div class="form-group">
                                    <label for="delivery_address" class="col-form-label text-md-right">Delivery Address</label>
                                      <input id="delivery_address" type="text" style="height: 43px; background: #f9faff;" class="form-control " name="delivery_address" required="">
                                    
                                    </div>
                                    <div class="form-group">
                                    <label for="landline_number" class="col-form-label text-md-right">Landline Number</label>
                                      <input id="landline_number" type="number" style="height: 43px; background: #f9faff;" class="form-control " name="landline_number" required="">
                                    </div>
                                    <input type="hidden" name="user_id" value="{{$id}}">
                                    @if($role_id->role_id == 3)
                                    <input type="hidden" name="user_type" value="seller">
                                    @else
                                    <input type="hidden" name="user_type" value="buyer">
                                    @endif
                       

                                    <div class="form-group mb-0">
                                        
                                            <button type="submit" class="btn btn-success btn-block" style="background-color: #01cc84; color: #fff; border: none; height: 39px;">
                                                {{ __('Register Company') }}
                                            </button>
                                        
                                    </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="unregistered" role="tabpanel" aria-labelledby="profile-tab">
                                <form method="POST" action="{{ route('company.unregister.store') }}" enctype="multipart/form-data"> 
                                    @csrf  
                                    <div class="form-group">
                                    <label for="organization_name" class="col-form-label text-md-right">Organization / Individual Name</label>
                                      <input id="organization_name" type="text" style="height: 43px; background: #f9faff;" class="form-control " name="organization_name" required="">
                                    </div>
                                      
                                    <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group" style="margin-top: 12px;">
                                            <label for="cnic_number" class="col-form-label text-md-right">CNIC Number</label>
                                            <input id="cnic_number" type="number" style="height: 43px; background: #f9faff;" class="form-control " name="cnic_number" required="">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group" style="margin-top: 12px;">
                                            <label for="logo" class="col-form-label text-md-right">Company logo</label>
                                            <input id="logo" type="file" style="height: 43px; background: #f9faff;" class="form-control " name="logo" onchange="loadFile_6(event)">
                                            <img id="register_logo_image" src="#" onclick="RegisterLogoImage()" style="width:100px; height:50px; display: none; margin-top:5px;" class="rounded float-right"/>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                            <label for="cnic_front_image" class="col-form-label text-md-right">CNIC Front Image</label>
                                            <input id="cnic_front_image" type="file" style="height: 37px; background: #f9faff;" class="form-control " onchange="loadFile_7(event)" name="cnic_front_image" required="">
                                            <img id="register_cnic_front_image" src="#" onclick="RegisterCnicFrontImage()" style="width:100px; height:50px; display: none; margin-top:5px;" class="rounded float-right"/>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="cnic_back_image class="col-form-label text-md-right">CNIC Back Image</label>
                                                <input id="cnic_back_image" type="file" style="height: 37px; background: #f9faff;" class="form-control " onchange="loadFile_8(event)" name="cnic_back_image" required="">
                                                <img id="register_cnic_back_image" src="#" onclick="RegisterCnicBackImage()" style="width:100px; height:50px; display: none; margin-top:5px;" class="rounded float-right"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <label for="registered_address" class="col-form-label text-md-right">Registered Address</label>
                                      <input id="registered_address" type="text" style="height: 43px; background: #f9faff;" class="form-control " name="registered_address" required="">
                                    </div>

                                    <div class="form-group">
                                    <label for="delivery_address" class="col-form-label text-md-right">Delivery Address</label>
                                      <input id="delivery_address" type="text" style="height: 43px; background: #f9faff;" class="form-control " name="delivery_address" required="">
                                    
                                    </div>
                                    <div class="form-group">
                                    <label for="landline_number" class="col-form-label text-md-right">Landline Number</label>
                                      <input id="landline_number" type="number" style="height: 43px; background: #f9faff;" class="form-control " name="landline_number" required="">
                                    </div>
                                    <input type="hidden" name="user_id" value="{{$id}}">
                                    @if($role_id->role_id == 3)
                                    <input type="hidden" name="user_type" value="seller">
                                    @else
                                    <input type="hidden" name="user_type" value="buyer">
                                    @endif
                                    <div class="form-group mb-0">
                                        
                                            <button type="submit" class="btn btn-success btn-block" style="background-color: #e4e4e4;color: #9e9e9e; border: none; height: 39px;">
                                                {{ __('Register Company') }}
                                            </button>
                                        
                                    </div>
                                    </form>

                
                                </div>
                    
                            </div>
                    </div>
                </div>
                                
                        
            </div>
        </div>
    </div>
    
</div>
</div>

<!--Logo Modal -->
<div class="modal fade" id="logoImage" tabindex="-1" role="dialog" aria-labelledby="logoImageLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoImageLabel">Logo Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      <img id="logo_modal_image" src="#" style="width:400px;"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--CNIC Front Modal -->
<div class="modal fade" id="CnicFrontImage" tabindex="-1" role="dialog" aria-labelledby="CnicFrontImageLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CnicFrontImageLabel">CNIC Front Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      <img id="cnic_front_modal_image" src="#" style="width:400px;"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--CNIC Back Modal -->
<div class="modal fade" id="CnicBackImage" tabindex="-1" role="dialog" aria-labelledby="CnicBackImageLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CnicBackImageLabel">CNIC Back Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      <img id="cnic_back_modal_image" src="#" style="width:400px;"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!--NTN Modal -->
<div class="modal fade" id="NTNImage" tabindex="-1" role="dialog" aria-labelledby="NTNImageLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="NTNImageLabel">NTN Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      <img id="ntn_modal_image" src="#" style="width:400px;"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--STRN Modal -->
<div class="modal fade" id="STRNImage" tabindex="-1" role="dialog" aria-labelledby="STRNImageLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="STRNImageLabel">STRN Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      <img id="show_strn_modal_image" src="#" style="width:400px;"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Register Logo Modal -->
<div class="modal fade" id="RegisterLogoImage" tabindex="-1" role="dialog" aria-labelledby="RegisterLogoImageLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="RegisterLogoImageLabel">Comopany Logo Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      <img id="register_modal_logo_image" src="#" style="width:400px;"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- CNIC Front Modal -->
<div class="modal fade" id="RegisterCnicFrontImage" tabindex="-1" role="dialog" aria-labelledby="RegisterCnicFrontImageLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="RegisterCnicFrontImageLabel">CNIC Front Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      <img id="register_modal_cnic_front_image" src="#" style="width:400px;"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- CNIC Back Modal -->
<div class="modal fade" id="RegisterCnicBackImage" tabindex="-1" role="dialog" aria-labelledby="RegisterCnicBackImageLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="RegisterCnicbackImageLabel">CNIC Back Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      <img id="register_modal_cnic_back_image" src="#" style="width:400px;"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
function show1(){
  document.getElementById('strn_number').style.display ='flex';
}
function show2(){
  document.getElementById('strn_number').style.display = 'none';
}

    var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      var logo_modal_image = document.getElementById('logo_modal_image');
      output.src = reader.result;
      logo_modal_image.src = reader.result;
      output.style.display = "block";
    };
    reader.readAsDataURL(event.target.files[0]);
  };

  var loadFile_2 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var cnic_front_image = document.getElementById('image_cnic_front_image');
      var cnic_front_modal_image = document.getElementById('cnic_front_modal_image');
      cnic_front_image.src = reader.result;
      cnic_front_modal_image.src = reader.result;
      cnic_front_image.style.display = "block";
    };
    reader.readAsDataURL(event.target.files[0]);
  };

  var loadFile_3 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var cnic_back_image = document.getElementById('image_cnic_back_image');
      var cnic_back_modal_image = document.getElementById('cnic_back_modal_image');
      cnic_back_image.src = reader.result;
      cnic_back_modal_image.src = reader.result;
      cnic_back_image.style.display = "block";
    };
    reader.readAsDataURL(event.target.files[0]);
  };

  var loadFile_4 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var show_strn_image = document.getElementById('show_strn_image');
      var show_strn_modal_image = document.getElementById('show_strn_modal_image');
      show_strn_image.src = reader.result;
      show_strn_modal_image.src = reader.result;
      show_strn_image.style.display = "block";
    };
    reader.readAsDataURL(event.target.files[0]);
  };

  var loadFile_5 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var show_ntn_image = document.getElementById('show_ntn_image');
      var ntn_modal_image = document.getElementById('ntn_modal_image');
      show_ntn_image.src = reader.result;
      ntn_modal_image.src = reader.result;
      show_ntn_image.style.display = "block";
    };
    reader.readAsDataURL(event.target.files[0]);
  };

  var loadFile_6 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var register_logo_image = document.getElementById('register_logo_image');
      var register_modal_logo_image = document.getElementById('register_modal_logo_image');
      register_logo_image.src = reader.result;
      register_modal_logo_image.src = reader.result;
      register_logo_image.style.display = "block";
    };
    reader.readAsDataURL(event.target.files[0]);
  };

  var loadFile_7 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var register_cnic_front_image = document.getElementById('register_cnic_front_image');
      var register_modal_cnic_front_image = document.getElementById('register_modal_cnic_front_image');
      register_cnic_front_image.src = reader.result;
      register_modal_cnic_front_image.src = reader.result;
      register_cnic_front_image.style.display = "block";
    };
    reader.readAsDataURL(event.target.files[0]);
  };

  var loadFile_8 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var register_cnic_back_image = document.getElementById('register_cnic_back_image');
      var register_modal_cnic_back_image = document.getElementById('register_modal_cnic_back_image');
      register_cnic_back_image.src = reader.result;
      register_modal_cnic_back_image.src = reader.result;
      register_cnic_back_image.style.display = "block";
    };
    reader.readAsDataURL(event.target.files[0]);
  };


</script>
@endsection
