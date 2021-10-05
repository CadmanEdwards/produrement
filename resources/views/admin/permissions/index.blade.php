@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-10"></div>
    <div class="col-lg-2">
        <a class="btn btn-success btn-block" style="color: #fff; background: #01a36a;" href="{{ route("admin.permissions.create") }}">
            {{ trans('global.add') }} {{ trans('cruds.permission.title_singular') }}
        </a>
    </div>
</div>
<h3 style="margin-left: 5px;">Permissions List</h3>
<div class="row">
@foreach($permissions as $permission)
    <div class="col-md-6">
    <div class="card">
    

            <div class="card-body">
                <h3>{{$permission->name}}</h3>
                <p><b>Created On:</b> {{date("d-m-Y", strtotime($permission->created_at))}}</p>
                
            </div>
            <div class="card-header text-center">
            <a class="btn btn-xs btn-primary" href="{{ route('admin.permissions.show', $permission->id) }}">
                                    {{ trans('global.view') }}
                                </a>

                                <a class="btn btn-xs btn-info" href="{{ route('admin.permissions.edit', $permission->id) }}">
                                    {{ trans('global.edit') }}
                                </a>

                                <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
