@extends('layouts.admin.main')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">{{session('status')}}</div>
                @endif
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Users
                            <a href="{{route('user.create')}}" class="btn btn-primary float-right">Add User</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-boardered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)

                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>
                                        @if(!empty($item->getRoleNames()))
                                        @foreach ($item->getRoleNames() as $roleName)
                                            <label class="badge bg-primary mx-1">{{$roleName}}</label>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @can('Edit user')
                                        <a href="{{route('user.edit',$item->id)}}" class="btn btn-primary float-left mr-2">Edit</a>
                                        @endcan
                                        @can('Delete user')
                                        <form action="{{route('user.destroy',$item->id)}}" class= "action" method="POST"> @csrf  @method('DELETE') <button class="btn btn-danger">Delete</button></form>
                                        @endcan
                                    </td>
                                </tr>
                                                                    
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{$user->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection