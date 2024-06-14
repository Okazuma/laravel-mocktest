<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function employees()
    {
        // $users = User::all();
        // $attendances = Attendance::with('user')->paginate(5);

        // return view('employee', compact('attendances', 'users'));
    }
}
