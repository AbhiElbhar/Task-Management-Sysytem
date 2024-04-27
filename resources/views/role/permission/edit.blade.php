@extends('layouts.admin.main')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4> Edit Permission
                            <a href="{{route('permission.index')}}" class="btn btn-danger float-right">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('permission.update',$permission->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name">Permission name</label>
                                <input type="text" name="name" class="form-control" value="{{$permission->name}}">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
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