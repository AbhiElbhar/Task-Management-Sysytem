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
                        <h4>Permissions
                            <a href="{{route('permission.create')}}" class="btn btn-primary float-right">Add Permission</a>
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
                                @foreach ($permission as $item)

                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        @can('Edit permission')
                                        <a href="{{route('permission.edit',$item->id)}}" class="btn btn-primary float-left mr-2">Edit</a>
                                        @endcan
                                        @can('Delete permission')
                                        <form action="{{route('permission.destroy',$item->id)}}" class= "action" method="POST"> @csrf  @method('DELETE') <button class="btn btn-danger">Delete</button></form>
                                        @endcan
                                    </td>
                                </tr>
                                                                    
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{$permission->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection