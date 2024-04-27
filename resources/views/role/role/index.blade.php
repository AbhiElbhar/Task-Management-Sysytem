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
                        <h4>Roles
                            <a href="{{route('role.create')}}" class="btn btn-primary float-right">Add Role</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-boardered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($role as $item)

                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        <a href="{{route('role.show',$item->id)}}" class="btn btn-success float-left mr-2">Add / Edit Role Permission</a>
                                        @can('Edit Role')
                                        <a href="{{route('role.edit',$item->id)}}" class="btn btn-primary float-left mr-2">Edit</a>
                                        @endcan
                                        @can('Delete Role')
                                        <form action="{{route('role.destroy',$item->id)}}" class= "action" method="POST"> @csrf  @method('DELETE') <button class="btn btn-danger">Delete</button></form>
                                        @endcan
                                    </td>
                                </tr>
                                                                    
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{$role->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection