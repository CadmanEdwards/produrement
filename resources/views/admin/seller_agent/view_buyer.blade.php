@extends('layouts.admin')
@section('content')
<style> 
            .custom-control-input:focus ~  
          .custom-control-label::before { 
                /* when the button is toggled off  
  it is still in focus and a violet border will appear */ 
                border-color: #01cc84 !important; 
                /* box shadow is blue by default 
  but we do not want any shadow hence we have set  
  all the values as 0 */ 
                box-shadow: 
                  0 0 0 0rem rgba(0, 0, 0, 0) !important; 
            } 
  
            /*sets the background color of 
          switch to violet when it is checked*/ 
            .custom-control-input:checked ~  
          .custom-control-label::before { 
                border-color: #01cc84 !important; 
                background-color: #01cc84 !important; 
            } 
  
            /*sets the background color of 
          switch to violet when it is active*/ 
            .custom-control-input:active ~  
          .custom-control-label::before { 
                background-color: #01cc84 !important; 
                border-color: #01cc84 !important; 
            } 
  
            /*sets the border color of switch 
          to violet when it is not checked*/ 
            .custom-control-input:focus: 
          not(:checked) ~ .custom-control-label::before { 
                border-color: #01cc84 !important; 
            } 

            @media (min-width: 992px){

              .nav-link.active.test {
                    color: #ccc !important;
                    border-color: #dee2e600 #dee2e600 #01cc84 !important;
                    text-align: center;
                    border-radius: 0px;
                    font-size: 13px;
                    margin-left: 2px;
                }
              }

              .nav-tabs .nav-link {
                  color: #ccc;
                  font-size: 13px;
                  border-bottom: 1px solid #ccc;
                  margin-left: 2px;
              }

              .tab-content {
                   border: none;
                }
            
            }
            .image_body img{
              width: 100%;
              border-top-right-radius: 10px; 
              border-top-left-radius: 10px;
              height: 164px;
              margin-bottom:10px ;
            }
            input[type=number]::-webkit-inner-spin-button, 
              input[type=number]::-webkit-outer-spin-button {  

                background-color: #000;
                opacity: 1;

              }
              
            </style>

<h3 style="margin-left: 5px; color: #9e9e9e;">Buyer List</h3>
<div class="row">
  @foreach($confirm_data as $confirm)
  <div class="col-md-5">
<div class="card">
  <div class="row">
<div class="col-md-8">
  <h4 style="padding: 7px; text-transform: uppercase;">{{$confirm->user_name}}</h4>
  <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>POS:</b>{{$confirm->user_name}}</p>
</div>
<div class="col-md-4 text-center" style="padding: 17px;">
<a class="btn btn-xs btn-primary" style="color:#fff;">
                                    Verified 
                                </a>
</div>
  </div>
  <div class="row">
    <div class="col-md-5">
    <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Cell Number:</b>{{$confirm->phone_number}}</p>
    <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>NTN Number:</b>{{$confirm->ntn_number}}</p>
    </div>
    <div class="col-md-7">
    <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Landline Number:</b>{{$confirm->landline_number}}</p>
    <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>STRN Number:</b>{{($confirm->strn_number)}}</p>
    </div>
  </div>
  <div class="card-header text-center" style="padding: 0.5rem 1.25rem;">
                            <a class="btn btn-xs btn-primary" href="#">
                                    Create Order 
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