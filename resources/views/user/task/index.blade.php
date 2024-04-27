@extends('layouts.admin.main')

@section('content')
<div class="container-fluid">
    
    
    
    @if (session('status'))
    <div class="alert alert-success">{{session('status')}}</div>
    @endif


    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <label>filter by date</label>
                                <input type="date" name="date" value="{{Request::get('date')?? date('Y-m-d')}}" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>filter by status</label>
                                <select name="status" class="form-control">
                                <option value="">select All status</option>
                                <option value="pending"{{Request::get('status') == 'pending' ? 'selected':''}}>pending</option>
                                <option value="pending"{{Request::get('status') == 'completed' ? 'selected':''}}>completed</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <br/>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                    <h5 class="mb-3 mt-0 pt-2 text-uppercase header-title">User Task
                        <a href="{{ route('tasks.create') }}" class="btn btn-primary float-right">Add New Task</a>
                    </h5>
                    
                    
                    <div class="ref-list" id="responsive-preview">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Due Date</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{ $tasks->firstItem() + $loop->index }}</td>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->description }}</td>
                                        <td>{{ $task->due_date }}</td>
                                        <td>{{ $task->priority }}</td>
                                        <td> <button type="button" class="btn btn-primary" id="changeStatusBtn" 
                                            data-toggle="modal" data-target="#confirmStatusChangeModal"
                                            data-task-id="{{ $task->id }}"
                                            data-task-status="{{ $task->status }}">
                                            {{ $task->status }}
                                        </button></td>
                                        <td class="table-action">
                                            <a href="{{route('tasks.edit',$task->id)}}" class="btn btn-primary float-left mr-2">Edit</a>
                                            
                                            <form action="{{route('tasks.destroy',$task->id)}}" class= "action" method="POST"> @csrf  @method('DELETE') <button class="btn btn-danger">Delete</button></form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{$tasks->links()}} --}}
                        </div> <!-- end table-responsive-->
                    </div> <!-- end preview-->
                    
                </div>
            </div>
        </div> <!-- end col-->
    </div>
    
    
    <!-- end row-->
    
</div> <!-- container -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all delete buttons
        var deleteButtons = document.querySelectorAll('.delete-jobrole');
        
        // Add click event listener to each delete button
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                
                // Get the job role ID from data-id attribute
                var workId = this.getAttribute('data-id');
                
                // Show confirmation dialog
                var isConfirmed = confirm('Are you sure you want to delete this job role?');
                
                // If user confirms deletion, proceed with deletion process
                if (isConfirmed) {
                    window.location.href = "{{ url('/tasks/delete/') }}/" + workId;
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const changeStatusBtn = document.getElementById('changeStatusBtn');
        const confirmStatusChangeBtn = document.getElementById('confirmStatusChange');
        
        changeStatusBtn.addEventListener('click', function () {
            const taskId = this.getAttribute('data-task-id');
            const currentStatus = this.getAttribute('data-task-status');
            
            // Check if the current status is 'pending'
            if (currentStatus === 'pending') {
                // Update the button text and data-task-status attribute
                this.textContent = 'completed';
                this.setAttribute('data-task-status', 'completed');
                
                // Send an AJAX request to update the task status
                fetch(`/tasks/${taskId}/change-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add CSRF token if using Laravel
                    },
                    body: JSON.stringify({
                        status: 'completed' // Set the new status here
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        console.error('Failed to change task status');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            } else {
                // If the current status is 'completed', do nothing or show a message
                console.log('Task is already completed');
            }
        });
    });
    
    
    
</script>


@endsection
