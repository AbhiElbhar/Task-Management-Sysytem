<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class AdminController extends Controller
{
    public function getAllUsers(){
        $userTasks = Task::join('users', 'tasks.user_id', '=', 'users.id')
                ->select('tasks.*', 'users.name', 'users.email') // Assuming name and email are user details you want to fetch
                ->paginate(3);
                return view('admin.users',compact('userTasks'));
    }
    public function getAllActivity(){
        $activities=Activity::latest()->paginate(3);
        return view('admin.activity',compact('activities'));
    }
}
