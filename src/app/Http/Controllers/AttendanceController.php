<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    //
    public function index(Request $request)
    {
        // リクエストから日付を取得する。もしリクエストに日付が含まれていない場合は、本日の日付を使用する
        $date = $request->input('date', Carbon::today()->toDateString());

        // 指定された日付の勤務データを取得する
        $attendances = Attendance::with('user')->whereDate('work_date', $date)->paginate(5);

        return view('attendance', compact('attendances', 'date'));
    }


}