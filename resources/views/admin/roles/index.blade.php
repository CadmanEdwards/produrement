@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
<div class="col-lg-10"></div>
    <div class="col-lg-2">
        <a class="btn btn-success btn-block" style="color: #fff; background: #01a36a;" href="{{ route("admin.roles.create") }}">
            {{ trans('global.add') }} {{ trans('cruds.role.title_singular') }}
        </a>
    </div>
</div>

<h3 style="margin-left: 5px;">Roles List</h3>
<div class="row">
@foreach($roles as $role)
    <div class="col-md-6">
    <div class="card">
    

            <div class="card-body">
                <h3>{{$role->name}}</h3>
                <p><b>Created On:</b> {{date("d-m-Y", strtotime($role->created_at))}}</p>
                @foreach($role->permissions()->pluck('name') as $permission)
                                <span class="label label-info label-many" style="background-color: #01cc84;">{{ $permission }}</span>
                            @endforeach

            </div>
            <div class="card-header text-center">
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.roles.show', $role->id) }}">
                                    {{ trans('global.view') }}
                                </a>

                                <a class="btn btn-xs btn-info" href="{{ route('admin.roles.edit', $role->id) }}">
                                    {{ trans('global.edit') }}
                                </a>

                                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form>
            </div>
    </div>
    </div>
    @endforeach
</div>
@endsection