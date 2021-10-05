
@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card" style="border: none !important;">
            <div class="p-4">
                <div class="card-body">
                <div class="login_heading text-center">
                <h2 style="padding: 10px; border-bottom: 1px solid #ccc; width: 90%; margin: 0 auto;">Change Password</h2>
            
                </div>
                    <form method="POST" action="{{ route('password_change_with_front') }}">
                        {{ csrf_field() }}
                        <h1>
                            <div class="login-logo">
                                <a href="#">
                                    
                                </a>
                            </div>
                        </h1>
                        <p class="text-muted"></p>
                        <br/>
                        <br/>
                        <div>
                            {{ csrf_field() }}
                            <div class="form-group has-feedback">
                                <label>PIN Code</label>
                                <input type="text"  style="height: 43px; background: #f9faff;" class="form-control" value="{{$random_number}}" required="autofocus" disabled>
                                <input type="hidden" name="pin"  value="{{$random_number}}">
                            </div>
                            <div class="form-group has-feedback">
                            <label>New Passowrd</label>
                                <input type="password" name="password" style="height: 43px; background: #f9faff;" class="form-control" required="autofocus">
                            </div>
                            <div class="form-group has-feedback">
                            <label>Confirm Passowrd</label>
                                <input type="password" name="c_password" style="height: 43px; background: #f9faff;" class="form-control" required="autofocus">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary btn-block btn-flat" style="border:none; background-color: #01cc84 !important;">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <p class="text-center" style="color: #9e9e9e;">Back to login page <a style="color: #01cc84 !important;" href="{{ route('login') }}">Sign In</a></p>
        </div>
    </div>
</div>
@endsection