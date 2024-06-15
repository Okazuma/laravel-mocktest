<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    // ユーザー一覧ページの表示
    public function employee()
    {
        $users = User::paginate(2);

        return view('employees.employee', compact('users'));
    }


    // ユーザーの詳細情報の表示
    public function detail($id)
    {
        $user = User::findOrFail($id);
        $attendances = $user->attendances()->orderBy('work_date', 'desc')->paginate(2);
        return view('employees.detail', compact('user', 'attendances'));
    }
}
