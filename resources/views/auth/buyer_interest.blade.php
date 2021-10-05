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

.custom-control-label:before{
  background-color:#01cc84;
}
.custom-checkbox .custom-control-input:checked~.custom-control-label::before{
  background-color:#01cc84;
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
body{
    background-color: #f3f3f3;
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
                <h6 class="upper_section_heading" style="text-align: right;">
                    <span class="upper_box"><small class="test4">3</small> Field Of Interest</span></h6>
                </div>
            </div>    
        <div class="card" style="border: none;">
            
            <div class="login_heading text-center">
                <h2 style="padding: 10px; border-bottom: 1px solid #ccc; width: 90%; margin: 0 auto;">Interest</h2>
                 <p style="color: red;">Please select your category of your interest</p>
                </div>

                <div class="card-body">
                <form method="POST" action="{{ route('company/intrest/submite') }}">
                                    @csrf 
                    <div class="form-check custom-control custom-checkbox">
                        <input type="hidden" name="user_id" value="{{$id}}">
                        <input type="checkbox" class="custom-control-input form-check-input" id="select_all">
                        <label class="form-check-label custom-control-label" for="select_all">Select All</label>
                    </div>
                    <hr/>

                    <?php $company_cat = DB::table('company_type')
                          ->get();?>
                   @foreach($company_cat as $cat)
                   <div class="form-check custom-control custom-checkbox" style="font-size: 13px; line-height: 1.8em;">
                        <input type="checkbox" class="custom-control-input form-check-input" id="select{{$cat->id}}" name="intreset_id[]" value="{{$cat->id}}">
                        <label class="form-check-label custom-control-label" for="select{{$cat->id}}">{{$cat->name}}</label>
                    </div>
                   @endforeach
                       

                       <div class="form-group mb-0">
                           
                               <button type="submit" class="btn btn-success btn-block" style="background-color: #01cc84;color: #fff; border: none; height: 39px; margin-top:10px;">
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
@endsection
