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

<?php
$company_data = DB::table('comapny')
   ->select('comapny.*','users.name as user_name','users.phone_number as user_phone_number','users.email as user_email')
   ->join('users','comapny.user_id', '=', 'users.id')
   ->where('comapny.id',$id)
   ->first();
?>

              
    <div class="row justify-content-center">
        <div class="col-md-8">
            
                <div class="login_heading text-center">
                    <h2 style="padding: 10px; width: 90%; margin: 0 auto;"><i class="fa fa-thumbs-up" aria-hidden="true" style="border-radius: 50%; background: #01cc84; padding: 7px; color: #fff; margin-right: 10px;"></i>Verification Of Company</h2>
                
                    </div>

                    <table class="table">
                        <thead>
                           
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="col">
                                <input type="checkbox" class="select_all_verify">
                             </th>
                            <th scope="col">Select All</th>
                            <th scope="col"></th>
                            </tr>

                        <tr>
                            <th scope="col">
                                <input type="checkbox" class="verification_code" onchange="check_btn_disable()">
                             
                             </th>
                            <th scope="col">Organization Name</th>
                            <th scope="col">{{$company_data->company_name}}</th>
                            </tr>
                            <tr>
                            <th scope="col">
                            <input type="checkbox" class="verification_code" onchange="check_btn_disable()">
                             </th>
                            <th scope="col">Owner Name</th>
                            <th scope="col">{{$company_data->user_name}}</th>
                            </tr>
                            <tr>
                            <th scope="col">
                            <input type="checkbox" class="verification_code" onchange="check_btn_disable()">
                             </th>
                            <th scope="col">Email Address</th>
                            <th scope="col">{{$company_data->user_email}}</th>
                            </tr>
                            <tr>
                            <th scope="col">
                            <input type="checkbox" class="verification_code" onchange="check_btn_disable()">
                             </th>
                            <th scope="col">NTN Number </th>
                            <th scope="col">{{$company_data->ntn_number}}<button class="btn btn-primary" data-toggle="modal" data-target="#ntn_modal" style="margin-left: 4px;">View NTN image</button></th>
                            </tr>
                            @if($company_data->strn_number)
                            <tr>
                            <th scope="col">
                            <input type="checkbox" class="verification_code" onchange="check_btn_disable()">
                             </th>
                            <th scope="col">STRN Number</th>
                            <th scope="col">{{$company_data->strn_number}} <button class="btn btn-primary" data-toggle="modal" data-target="#strn_modal" style="margin-left: 4px;">View STRN image</button></th>
                            </tr>
                            @endif
                            <tr>
                            <th scope="col">
                            <input type="checkbox" class="verification_code" onchange="check_btn_disable()">
                             </th>
                            <th scope="col">CNIC Number</th>
                            <th scope="col">{{$company_data->cnic_number}}<button class="btn btn-primary" data-toggle="modal" data-target="#cnic_modal" style="margin-left: 4px;">View Cnic Images</button></th>
                            </tr>
                            <tr>
                            <th scope="col">
                            <input type="checkbox" class="verification_code" onchange="check_btn_disable()">
                             </th>
                            <th scope="col">R-Address</th>
                            <th scope="col">{{$company_data->registered_address}}</th>
                            </tr>
                            <tr>
                            <th scope="col">
                            <input type="checkbox" class="verification_code" onchange="check_btn_disable()">
                             </th>
                            <th scope="col">D-Address</th>
                            <th scope="col">{{$company_data->delivery_address}}</th>
                            </tr>
                            <tr>
                            <th scope="col">
                            <input type="checkbox" class="verification_code" onchange="check_btn_disable()">
                             </th>
                            <th scope="col">Landline Number</th>
                            <th scope="col">{{$company_data->landline_number}}</th>
                            </tr>
                            <tr>
                            <th scope="col">
                            <input type="checkbox" class="verification_code" onchange="check_btn_disable()">
                             </th>
                            <th scope="col">Cell Number</th>
                            <th scope="col">{{$company_data->user_phone_number}}</th>
                            </tr>

                            <tr>
                            <th scope="col">
                            <input type="checkbox" class="verification_code" onchange="check_btn_disable()">
                             </th>
                            <th scope="col" colspan="3">Under taking<br/>
                            the above information is true and i verify the same on behalf of comapny representative
                            </th>
                            </tr>
                        </tbody>
                        </table>

                        <form method="POST" action="{{ route('company/verification/submite') }}">
                                    @csrf 

                                    <input type="hidden" name="company_id" value="{{$id}}">

                                    <div class="form-group mb-0">
                           
                           <button type="submit" class="btn btn-success btn_enable_all_select" disabled style="float: right; background-color: #01cc84;color: #fff; border: none; height: 39px; margin-top:10px;">
                               {{ __('Verify Company') }}
                           </button>
                       
                   </div>
                   </form>
                    
                </div>
                
                                
                             
            
        </div>
        
    
<!-- Modal -->
<div class="modal fade" id="cnic_modal" tabindex="-1" role="dialog" aria-labelledby="cnic_modalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cnic_modalTitle">CNIC Images</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ntn_modal" tabindex="-1" role="dialog" aria-labelledby="ntn_modalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ntn_modalTitle">NTN Images</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-md-6">
        <h3>NTN Image</h3>
        <img  src="{{url('cnic_images/'.$company_data->ntn_image)}}" style="width:100%">
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="strn_modal" tabindex="-1" role="dialog" aria-labelledby="strn_modalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ntn_modalTitle">STRN Images</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-md-6">
        <h3>NTN Image</h3>
        <img  src="{{url('cnic_images/'.$company_data->strn_image)}}" style="width:100%">
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script>

function check_btn_disable() {
    if (document.querySelectorAll('.verification_code:not(:checked)').length) {
      $('.btn_enable_all_select').prop('disabled', true);

    } else {
        $('.btn_enable_all_select').prop('disabled', false);
    }
  }
  check_btn_disable()

</script>
@endsection