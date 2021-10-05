@extends('layouts.admin')
@section('content')
<style>
.custome_box {
    border: 1px solid #ccc;
    border-radius: 7px;
    padding: 14px;
    box-shadow: 1px 1px 1px 1px #ccc;
}
</style>
<h3 style="margin-left: 5px; color: #9e9e9e;">Buyer Details</h3>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <div class="custome_box">
      <div class="row">
      <div class="col-md-10">
      <h5 style="text-transform: uppercase;">{{$buyer->name}}</h5>
      <p><b style="font-weight:bold;">Email: </b> {{$buyer->email}}</p>
        <p><b style="font-weight:bold;">Phone Number: </b> {{$buyer->phone_number}}</p>
        <p><b style="font-weight:bold;">CNIC Number: </b> 566565656464</p>
        <p><b style="font-weight:bold;">Created On: </b> {{$buyer->created_at}}</p>
        </div>
        <div class="col-md-1 text-right">
          <button class="btn btn-primary" data-toggle="modal" data-target="#EditUserByAdmin">Edit</button>
        </div>
        <div class="col-md-1 text-right">
        <?php if($buyer->status == 1){ ?>
        <button class="btn btn-secondary" onclick="BlockFunctionCall(<?= $buyer->id ?>)">Block</button>
        <?php }else{ ?>
          <button class="btn btn-secondary" onclick="UnBlockFunctionCall(<?= $buyer->id ?>)">Un Block</button>
        <?php } ?>
        </div>
        </div>
    <hr/>
    <h4>Buyer Company Details</h4>
    <br/>
    <?php
    $company = DB::table('comapny')
        ->where('user_id',$buyer->id)
        ->get();
    ?>
    <div class="row">
    @foreach($company as $c)
    <div class="col-md-6">
    <h5 style="text-transform: uppercase;">{{$c->company_name}}</h5>
      <p><b style="font-weight:bold;">Company Type: </b> {{$c->comapny_type}}</p>
        <p><b style="font-weight:bold;">Comapny Status: </b> {{$c->comapny}}</p>
        <p><b style="font-weight:bold;">CNIC Number: </b> {{$c->cnic_number}}</p>
        <p><b style="font-weight:bold;">Registered Address: </b> {{$c->registered_address}}</p>
        <p><b style="font-weight:bold;">Delivery Address: </b> {{$c->delivery_address}}</p>
    </div>
    @endforeach
    </div>
    </div>
    <div class="col-md-2"></div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="EditUserByAdmin" tabindex="-1" role="dialog" aria-labelledby="EditUserByAdminTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditUserByAdminTitle">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('edit_user_data') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{$buyer->id}}" name="user_id">
            <div class="form-group">
                <label for="user_name">User Name</label>
                <input type="text" id="user_name" value="{{$buyer->name}}" name="user_name" class="form-control" style="height: 32px;" required>
            </div>
            <div class="form-group">
                <label for="user_email">User Email</label>
                <input type="text" id="user_email" value="{{$buyer->email}}" name="user_email" class="form-control" style="height: 32px;" required>
            </div>
            <div class="form-group">
                <label for="user_phone_number">User Phone Number</label>
                <input type="text" id="user_phone_number" value="{{$buyer->phone_number}}" name="user_phone_number" class="form-control" style="height: 32px;" required>
            </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input class="btn btn-danger" style="background: #01cc84; border: none; float: right;" type="submit" value="{{ trans('global.save') }}">
        </form>
      </div>
    </div>
  </div>
</div>


@endsection
@section('scripts')
<script>
function BlockFunctionCall(id){
  $.ajax({
				type:    'post',
				url:     '{{route('block_user')}}',
				data:    {
					_token: "{{ csrf_token() }}",
                    id:id,
				},success: function (data) {
          alert(data);
          location.reload();
        },
				error: function () {
                }
            });
}

function UnBlockFunctionCall(id){
  $.ajax({
				type:    'post',
				url:     '{{route('unblock_block_user')}}',
				data:    {
					_token: "{{ csrf_token() }}",
                    id:id,
				},success: function (data) {
          alert(data);
          location.reload();
        },
				error: function () {
                }
            });
}
</script>
@parent
@endsection