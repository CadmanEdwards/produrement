@extends('layouts.admin')
@section('content')
<?php
$category = DB::table('category')
          ->where('created_by',auth()->user()->id)
          ->get();
          
?>
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
              color: #fff !important;
              background-color: #1a966a !important;
              border-color: #dee2e6 #dee2e6 #fff !important;
              text-align: center;
              border-radius: 12px;
              }

              .nav-tabs .nav-link {
                  background: #01cc84;
                  margin-left: 2px;
                  text-align: center;
                  border-radius: 17px;
                  margin-top: -6px;
                  color: #fff;
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
            </style>

<div class="row">

    <div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h4 style="color: #01cc84;"><i class="fa fa-thumbs-up" aria-hidden="true" style="border-radius: 50%; background: #01cc84; padding: 4px; color: #fff;"></i> Pending Request For Buyer</h4>
				<div class="row">
				 
				@if($buyer_request->count() > 0)
            @foreach($buyer_request as $confirm) 
           
            <?php
            $assign_company_data = DB::table('agent_assign_company')
            ->select('agent_assign_company.*','saller_agent.agent_name','saller_agent.agent_email','saller_agent.agent_phone','saller_agent.discount_percentage')
            ->join('saller_agent','agent_assign_company.agent_id', '=','saller_agent.agent_id')
            ->where('agent_assign_company.company_id',$confirm->buyer_company_id)
            ->first();
            ?>
              <div class="col-md-6">
            <div class="card" onclick="ShowCopmanySeller(<?= $confirm->buyer_company_id ?>)">
              <div class="row">
            <div class="col-md-8">
            @if($confirm->comapny == "registered")
                            
                            <h4 style="padding: 7px; text-transform: uppercase;">{{$confirm->user_name}}</h4>
                      @else
                      <h4 style="padding: 7px; text-transform: uppercase;">{{$confirm->organization_name}}</h4>
                      @endif
              
              <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>POS:</b>{{$confirm->user_name}}</p>
              <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Status:</b>{{$confirm->status}}</p>
            </div>
            <div class="col-md-4 text-right" style="padding: 17px;">
            <a class="btn btn-xs btn-dark" style="color:#fff;">
                              @if($confirm->comapny == "registered")
                              Registered
                              @else
                              Un Registered
                              @endif 
                                            </a>
            </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                <h4 style="padding-left: 7px;">Company Details</h4>
                <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Company Name:</b>
                      @if($confirm->comapny == "registered")
                      {{$confirm->user_name}}
                      @else
                      {{$confirm->organization_name}}
                      @endif
                </p>
                <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Cell Number:</b>{{$confirm->phone_number}}</p>
                <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>NTN Number:</b>{{$confirm->ntn_number}}</p>
                <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Landline Number:</b>{{$confirm->landline_number}}</p>
                <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>STRN Number:</b>{{($confirm->strn_number)}}</p>
                </div>
                <div class="col-md-6">
                <h4 style="padding-left: 7px;">Agent Details</h4>
                <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Agent Name:</b>{{$assign_company_data->agent_name ?? ''}}</p>
                <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Agent Email:</b>{{$assign_company_data->agent_email ?? ''}}</p>
                <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Agent Contact No:</b>{{$assign_company_data->agent_phone ?? ''}}</p>
                <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Agent Discount:</b>{{($assign_company_data->discount_percentage ?? '')}}</p>
                </div>
              </div>
              
            </div>

            </div>
            @endforeach
            @else 
            <h4 style="padding: 5px;">No data found</h4>
            @endif
				

			   </div>
		</div>
		</div>
		
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="company_append_modal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="inner_html_company_data_2">
      
      </div>
    </div>
  </div>
</div>

@endsection
@section('scripts')
@parent

@endsection