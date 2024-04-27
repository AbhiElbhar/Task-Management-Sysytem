@extends('layouts.admin.main')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4> Edit User
                            <a href="{{route('user.index')}}" class="btn btn-danger float-right">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('user.update',$user->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name">User name</label>
                                <input type="text" name="name" class="form-control" value="{{$user->name}}">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="roles">Roles</label>
                                <select name="roles[]" class="form-control" multiple>
                                    <option value="">--select Role--</option>
                                    @foreach ($roles as $role)
                                    <option value="{{$role->name}}" {{in_array($role->name,$userRoles)?'selected':''}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                                @error('roles') <span class="text-danger">{{ $message }}</span> @enderror
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