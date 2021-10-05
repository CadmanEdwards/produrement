@extends('layouts.admin')
@section('content')
@can('users_manage')
    <div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-10"></div>    
    <div class="col-lg-2">
            <a class="btn btn-success btn-block" href="{{ route("admin.users.create") }}" style="color:#fff; background: #01cc84;">
                Add Sub Admin
            </a>
        </div>
    </div>
@endcan
<h3 style="margin-left: 5px;">Sub Admin</h3>
<div class="row">
@foreach($users as $user)
    <div class="col-md-6">
    <div class="card">
    

            <div class="card-body">
                <h3>{{$user->name}}</h3>
                <p><b>Cell No:</b> {{$user->phone_number}}</p>
                <p><b>Created On:</b> {{date("d-m-Y", strtotime($user->created_at))}}</p>
                @foreach($user->roles()->pluck('name') as $role)
                                <span class="label label-info label-many" style="background-color: #01cc84;">{{ $role }}</span>
                            @endforeach

            </div>
            <div class="card-header text-center">
                <a class="btn btn-xs btn-light" style="background: #01a36a; color: #fff;" href="{{ route('admin.users.show', $user->id) }}">
                                    {{ trans('global.view') }}
                                </a>

                                <a class="btn btn-xs btn-light" style="background: #01a36a; color: #fff;" href="{{ route('admin.users.edit', $user->id) }}">
                                    {{ trans('global.edit') }}
                                </a>

                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-light" style="background: #01a36a; color: #fff;" value="{{ trans('global.delete') }}">
                                </form>
            </div>
    </div>
    </div>
    @endforeach
</div>

@endsection
@section('scripts')
@parent

@endsection