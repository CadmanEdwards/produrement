@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
<div class="col-lg-10"></div>    
<div class="col-lg-2">
        <a class="btn btn-success btn-block" href="{{ route('seller/agent/create')}}" style="color:#fff; background: #01cc84;">
            Add Seller Agent
        </a>
    </div>
</div>
<h3 style="margin-left: 5px;">Seller Agent</h3>
<div class="row">
    @if(count($users) > 0)
        @foreach($users as $user)
            <?php
                /*$company_assign = DB::table('comapny')
                ->join('agent_assign_company as ac','ac.company_id','=','comapny.id')
                ->where('ac.agent_id',$user->agent_id)
                ->get()->toArray();*/   
            ?>    
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body" style="padding: 5px;">
                        <h3>{{ucfirst($user->name)}}</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <p style="margin-bottom: 3px;"><b>Cell No:</b> {{$user->phone_number}}</p>
                                <p style="margin-bottom: 3px;"><b>Email:</b> {{$user->email}}</p>
                                <p style="margin-bottom: 3px;"><b>Allow Discount:</b> {{$user->discount_percentage}}%</p>
                            </div>
                            <div class="col-md-6">
                                @if(false)
                                    <p style="margin-bottom: 3px;"><b>Company Assign:</b> 
                                        @foreach($company_assign as $company)
                                            {{ ($company->company_name != "" ? ucfirst($company->company_name) : ucfirst($company->organization_name))}} , 
                                        @endforeach
                                    </p>
                                @endif
                                <p style="margin-bottom: 3px;"><b>Created On:</b> {{date('d/m/Y', strtotime( $user->created_at))}}</p>
                                <p style="margin-bottom: 3px;"><b>Area Assign:</b> {{$user->area_assign}}</p>
                            </div>                            
                        </div>                        
                    </div>
                    <div class="card-header text-center">

                        <a class="btn btn-xs btn-light" style="background: #01a36a; color: #fff;" href="{{ route('seller/agent/edit', $user->id) }}">
                            {{ trans('global.edit') }}
                        </a>

                        <form action="{{ route('seller/agent/destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-xs btn-light" style="background: #01a36a; color: #fff;" value="{{ trans('global.delete') }}">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-md-6">
                <div class="alert alert-danger">No agent record available</div> 
            </div>
        @endif            
</div>
@endsection
@section('scripts')
@parent

@endsection