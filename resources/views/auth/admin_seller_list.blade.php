@extends('layouts.admin')
@section('content')

<h3 style="margin-left: 5px; color: #9e9e9e;">Seller List</h3>

<div class="row">
  @foreach($buyer as $buy)
  <div class="col-md-3">
    <div class="card">
      
      <h4 style="padding: 7px; text-transform: uppercase;">{{$buy->name}}</h4>
      <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>E-mail:</b> {{$buy->email}}</p>
      <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Phone Number:</b> {{$buy->phone_number}}</p>
      <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Created On:</b> {{$buy->created_at}}</p>
      <p style="padding-left: 7px; margin-right:5px; margin-bottom: 3px;"><b>Created On:</b> <?= ($buy->status == 1) ? 'Active' : 'In-active' ?></p>
                <div class="card-header text-center" style="padding: 0.5rem 1.25rem;">
                        <a class="btn btn-xs btn-primary" href="{{route('view/seller/details',$buy->id)}}">
                            View Details 
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