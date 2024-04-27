@extends('layouts.admin.main')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Task</div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                            @csrf
                           @method('PUT')

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ $task->title }}" >
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" >{{ $task->description }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="due_date">Due Date</label>
                                <input type="date" class="form-control" id="due_date" name="due_date"
                                    value="{{ $task->due_date }}" >
                                    @error('due_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="priority">Priority</label>
                                <select class="form-control" id="priority" name="priority" >
                                    <option value="low" {{ $task->priority === 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ $task->priority === 'medium' ? 'selected' : '' }}>Medium
                                    </option>
                                    <option value="high" {{ $task->priority === 'high' ? 'selected' : '' }}>High</option>
                                </select>
                                @error('priority')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            

                            <div class="form-group">
                                <label for="status1">Status</label>
                                <select class="form-control" id="status1" name="status" >
                                    <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            

                            <button type="submit" class="btn btn-primary">Update Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
