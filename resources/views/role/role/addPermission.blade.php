@extends('layouts.admin.main')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
            <div class="alert alert-success">{{session('status')}}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Role : {{$role->name}}
                        <a href="{{route('role.index')}}" class="btn btn-danger float-right">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{route('rolePermission',$role->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            @error('permission') <span class="text-danger">{{ $message }}</span> @enderror
                            <label for="">Permissions</label>
                            <div class="row">
                                @foreach ($permission as $item)
                                
                                <div class="col-md-2">
                                    <label>
                                        <input type="checkbox" name="permission[]" value="{{$item->name}}" {{ in_array($item->id,$rolePermission)?'checked':''}}>
                                        {{$item->name}}
                                    </label>
                                </div>
                                
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection