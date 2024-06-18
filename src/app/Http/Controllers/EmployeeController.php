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
        $users = User::paginate(5);

        return view('employees.employee', compact('users'));
    }

    // ユーザーの詳細情報の表示
    public function detail($id)
    {
        // 勤務者を取得
        $user = User::findOrFail($id);

        // 勤務者の出勤記録を取得
        $attendances = $user->attendances()->orderBy('work_date', 'desc')->paginate(5);

        // 各出勤記録の休憩時間合計を計算
        foreach ($attendances as $attendance) {
            $attendance->formatted_total_break = $attendance->getFormattedTotalBreakAttribute();
        }

        return view('employees.detail', compact('user', 'attendances'));
    }

}
