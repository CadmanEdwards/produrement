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
                             Buyer Registration
                            </span>
                        </h6>
                </div>
                <div class="col" style="padding: 0px;">
                <h6 class="text-center upper_section_heading_with">
                    <span class="upper_box_with">
                        <small class="test5">2</small>
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
            
            <div class="login_heading">
                <h2 style="padding: 10px; border-bottom: 1px solid #ccc; width: 90%; margin: 0 auto;">
                Sign Up For Buyer</h2>
            </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register_buyer_submit') }}">
                        @csrf
                        <label for="name" class="col-form-label text-md-right">{{ __('Full Name') }}</label>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1" style="background: #f9faff"><i class="fa fa-user icon" style="color: #9e9e9e;"></i></span>
                        </div> 
                        <input id="name" value="abcbbbacb" type="text" aria-describedby="basic-addon1" style="border-left-color: transparent; height: 43px; background: #f9faff" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus >
                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                        </div>
                        <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon2" style="background: #f9faff;"><i class="fa fa-envelope" style="color: #9e9e9e;"></i></span>
                        </div>
                                <input id="email" value="abc@gmail.com" type="email" aria-describedby="basic-addon2" style="border-left-color: transparent; height: 43px; background: #f9faff;" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3" style="background: #f9faff;"><i class="fas fa-lock" style="color: #9e9e9e;"></i></span>
                        </div>
                            
                                <input id="password" value="12345678" aria-describedby="basic-addon3" style="border-left-color: transparent; height: 43px; background: #f9faff;" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
                        <div class="row">
                        <div class="col-md-8">
                        <label for="phone_number" class="col-form-label text-md-right">{{ __('Phone Number') }}</label>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="padding: 0px; background: #f9faff;" id="basic-addon4">

                            <select  style="height: 34px;background: #f9faff; border: none;" name="phone_start_code" id="phone_start_code">
                                <option value="0311">0311</option>
                                <option value="0312">0312</option>
                                <option value="0313">0313</option>
                                <option value="0314">0314</option>
                                <option value="0315">0315</option>
                                <option value="0340">0340</option>
                                <option value="0341">0341</option>
                                <option value="0342">0342</option>
                                <option value="0343">0343</option>
                                <option value="0344">0344</option>
                                <option value="0345">0345</option>
                                <option value="0346">0346</option>
                                <option value="0347">0347</option>
                                <option value="0300">0300</option>
                                <option value="0301">0301</option>
                                <option value="0302">0302</option>
                                <option value="0303">0303</option>
                                <option value="0304">0304</option>
                                <option value="0305">0305</option>
                                <option value="0306">0306</option>
                                <option value="0307">0307</option>
                                <option value="0308">0308</option>
                                <option value="0309">0309</option>
                                <option value="0330">0330</option>
                                <option value="0331">0331</option>
                                <option value="0332">0332</option>
                                <option value="0333">0333</option>
                                <option value="0334">0334</option>
                                <option value="0335">0335</option>
                                <option value="0336">0336</option>
                                <option value="0337">0337</option>
                                <option value="0320">0320</option>
                                <option value="0322">0322</option>
                                <option value="0323">0323</option>
                                <option value="0324">0324</option>
                                <option value="0325">0325</option>

                            </select>

                            </span>
                        </div>  
                                <input id="phone" type="number" aria-describedby="basic-addon4" style="height: 43px; background: #f9faff;" class="form-control @error('phone_number') is-invalid @enderror" required>
                                <input id="phone_number" type="hidden" name="phone_number">

                                @error('phone_number')

                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
                        </div>
                        <div class="col-md-4">
                            <label for="password" class="col-form-label text-md-right">{{ __('Operator') }}</label>
                        <div class="input-group mb-3">
                        
                            
                                <select style="height: 43px; background: #f9faff; border: 1px solid #ccc;" class="form-control is-invalid" name="phone_operator" >
                                <option value="Zong">Zong</option>
                                <option value="Telenor">Telenor</option>
                                <option value="Jazz">Jazz</option>
                                <option value="Ufone">Ufone</option>
                                <option value="Warid">Warid</option>
                                    </select>
                        </div>
                        </div>
                        </div>

                        <div class="btn btn-success pin_button" style="background-color: #01cc84 !important;float: right; margin-bottom: 12px;">Request Pin</div>

                        <div class="form-group">
                                    <label for="pin" class="col-form-label text-md-right">Enter Pin</label>
                                    <div><input id="pin" type="text" style="text-align:center; height: 43px; font-size: 31px; background: #f9faff;" class="form-control pin_insert_value" name="pin">
                                    </div>
                                    </div>

                        <div class="form-group mb-0">
                            
                                <button type="submit" class="btn btn-success btn-block submite_register" style="background-color: #e4e4e4;color: #9e9e9e; border: none; height: 39px;" disabled>
                                    {{ __('Register') }}
                                </button>
                            
                        </div>
                    </form>
                </div>
                <p class="text-center" style="color: #9e9e9e;">Back to login page <a style="color: #01cc84 !important;" href="{{ route('Buyer/login') }}">Sign In</a></p>
            </div>
        </div>
    </div>
                            
                        
</div>
    
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){
    
    function getPhone(){

        $('#phone_number').val($('#phone_start_code').val() + $('#phone').val());
   
    }

    $('#phone_start_code').change(() => getPhone());
    $('#phone').keyup(() => getPhone());

    getPhone();

});

</script>
@endsection
