
@extends('layouts.admin')
@section('content')
<div>
    <h3 class="salesagent" style=> Sales Agents</h3> <span><button class="sales" style="float:right;">Follow</button></span> <span><button class="sales" style="float:right;">Follow</button></span>  </div>

<div class="container">
    
        <div class="row">
            <div class="col-sm-3 col-md-6">
                <div class="card">
                    
                    <div class="card-header">
                        <h5>Name</h5>
                    </div>
                    <div class="card-block ">
                        <div class="row">
                            <div class="col-sm-3 col-md-6 " >
                               <h6>Date  : </h6>
                               <h6>S.no. : </h6>
                               <h6>Email : </h6>
                        
                                
                            </div>
                            <div class="col-sm-3 col-md-6" >
                            
                                <h6>Phone :    000000</h6>
                                <h6>Allowed Discount</h6>
                            </div>

                        </div>
                        <div class="card-footer" style="background-color: grey;">
                            <p class="footer-left" style="float: left; margin-left: 15%;"> <a>Status</a> <span><label class="status"> Active</label></p>
                                <p class="footer-left" style="float: right; margin-right: 15%;"> <span><label class="icon1" > <i style="font-size:24px" class="fa  fa1">&#xf044;</i><i style="font-size:24px" class="fa fa-trash fa2" style=""></i></label></p></div>
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="card">
                    
                    <div class="card-header">
                        <h5>Name</h5>
                    </div>
                    <div class="card-block ">
                        <div class="row">
                            <div class="col-sm-3 col-md-6" >
                               <h6>Date  : </h6>
                               <h6>S.no. : </h6>
                               <h6>Email : </h6>
                        
                                
                            </div>
                            <div class="col-sm-12 col-md-6" >
                            
                                <h6>Phone :    000000</h6>
                                <h6>Allowed Discount</h6>
                            </div>

                        </div>
                        <div class="card-footer" style="background-color: grey;">
                            <p class="footer-left" style="float: left; margin-left: 15%;"> <a>Status</a> <span><label class="status"> Active</label></p>
                                <p class="footer-left" style="float: right; margin-right: 15%;"> <span><label class="icon1" > <i style="font-size:24px" class="fa  fa1">&#xf044;</i><i style="font-size:24px" class="fa fa-trash fa2" style=""></i></label></p></div>
                        
                    </div>
                </div>
            </div>
           
           
        </div>
    </div>
    @endsection