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
                                <li id="payment" class="active"><strong>Field Of Interest</strong></li>
                            </ul> <!-- fieldsets -->
                <div class="login_heading text-center">
                    <h2 style="padding: 10px; border-bottom: 1px solid #ccc; width: 90%; margin: 0 auto;">Fied Of Interest</h2>
                
                    </div>

                    <div class="card-body">
                        
                            
                    <form method="POST" action="{{ route('company/intrest/edit/submite') }}">
                                    @csrf 
                    <?php $company_cat = DB::table('company_type')
                          ->get();?>
                   @foreach($company_cat as $cat)
                   <?php $get_field_of_intrest = explode(',',$company->company_type);
                   $checked = (in_array($cat->id, $get_field_of_intrest)) ? "checked" : "";
                   //print_r($checked);die;
                   ?>
                   <div class="form-check custom-control custom-checkbox" style="font-size: 13px; line-height: 1.8em;">
                        <input type="checkbox" class="custom-control-input form-check-input" id="select{{$cat->id}}" name="intreset_id[]" value="{{$cat->id}}" {{$checked}}>
                        <label class="form-check-label custom-control-label" for="select{{$cat->id}}">{{$cat->name}}</label>
                    </div>
                   @endforeach
                   <input type="hidden" name="company_id" value="{{$company->id}}">
                       

                       <div class="form-group mb-0">
                           
                               <button type="submit" class="btn btn-success btn-block" style="background-color: #e4e4e4;color: #9e9e9e; border: none; height: 39px; margin-top:10px;">
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