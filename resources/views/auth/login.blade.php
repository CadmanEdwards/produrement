@extends('layouts.app')

@section('content')
<style>
body{
    background-color: #f3f3f3;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <br/>
        <br/>
            <div class="card" style="border: none;">
                <div class="login_heading text-center">
                <h2 style="padding: 10px; border-bottom: 1px solid #ccc; width: 100%; margin: 0 auto;">{{ __('Sign In Seller') }}</h2>
            
                </div>

                <div class="card-body">
                        <div class="row">
                        <div class="col-md-6">
                        <br/>
                        <br/>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <fieldset>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="number_box">
                                    
                                    <div class="form-group">
                                    <label for="name" class="col-form-label text-md-right">Phone Number</label>
                                    <div><input id="email" type="number" style="height: 43px; background: #f9faff;" class="form-control @error('phone_number') is-invalid @enderror" name="email" required />
                                    </div>
                                    </div>

                                    <div class="next_btn">
                                    <div class="space"></div>

                                    <button type="button" class="btn btn-success btn-block next" style="background-color:#01cc84 !important;">Next</button>
                                    </div>
                                    </div>
                                   
                                    <div class="show_after_email" style="display: none;">

                                    <div class="form-group">
                                    <label for="name" class="col-form-label text-md-right">Password</label>
                                    <div><input id="password" type="password" style="height: 43px; background: #f9faff;" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="***" />
                                    @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    </div>

                                    <div class="space"></div>

                                    <div class="clearfix">
                                        

                                        <button type="submit" class="btn btn-block btn-success" style="background-color:#01cc84 !important;">
                                            <i class="ace-icon fa fa-key"></i>
                                            <span class="bigger-110">Login</span>
                                        </button>
                                    </div>
 
                                    <div class="space-4"></div>
                                    </div>
                                    
                                </fieldset>
                            </form>
                        </div>
                        <div class="col-md-6">
                        <img src="{{url('theme/images/Asset.png')}}" style="width: 100%;">
                        </div>
                            </div>    

                            <div style="margin-left: 14px;">
                                    <a href="{{ route('password.request') }}" style="color: #01cc84;">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                            </div>
                            <br/>
                                <br/>
            <p class="text-center" style="color: #9e9e9e;">Don't Have An Account? <a style="color: #01cc84 !important;" href="{{ route('register') }}">Sign Up</a></p>
       
                            </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
