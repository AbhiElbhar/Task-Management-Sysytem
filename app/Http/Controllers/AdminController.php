<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class AdminController extends Controller
{
    public function getAllUsers(){
        $userTasks = Task::with('user') // Assuming 'user' is the name of the relationship
        ->paginate(3);


                return view('admin.users',compact('userTasks'));
    }
    public function getAllActivity(){
        $activities=Activity::latest()->paginate(5);
        return view('admin.activity',compact('activities'));
    }
}
