@extends('layouts.admin.main')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <!-- <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box">
                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                                <li class="breadcrumb-item active">Work Location list</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Profile</h4>
                                    </div>
                                </div>
                            </div>      -->
        <!-- end page title -->

        {{-- <div class="row mt-3">
            <div class="col-sm-4">
                <a href="{{ url('create-user') }}" class="btn btn-danger rounded-pill mb-3"><i class="mdi mdi-plus"></i>Create
                    User</a>
            </div>
        </div> --}}



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3 mt-0 pt-2 text-uppercase header-title">Users</h5>
                        @if (session('success'))
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif


                        <div class="ref-list" id="responsive-preview">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Log Name</th>
                                            <th>Description</th>
                                            <th>Event</th>
                                            <th>Subject Id </th>
                                            <th>Causer Id </th>
                                            <th>Properties</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($activities as $activity)
                                            <tr>
                                                <td>{{ $activities->firstItem() + $loop->index }}</td>
                                                <td>{{ $activity->log_name  }}</td>
                                                <td>{{ $activity->description }}</td>
                                                <td>{{ $activity->event }}</td>
                                                <td>
                                                    @php
                                                        $subject_name =  DB::table('tasks')
                                                            ->where('id', $activity->subject_id)
                                                             ->value('title');
                                                    @endphp
                                                    {{ $subject_name }}
                                                </td>
                                                <td>{{ $activity->causer_id   }}</td>
                                                <td>
                                                    @php
                                                         $data = json_decode($activity->properties, true);
                                                    @endphp
                                                    {{$activity->properties}}
                                                  
                                                

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$activities->links()}}
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
        document.addEventListener('DOMContentLoaded', function() {
            const changeStatusBtn = document.getElementById('changeStatusBtn');
            const confirmStatusChangeBtn = document.getElementById('confirmStatusChange');

            changeStatusBtn.addEventListener('click', function() {
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
