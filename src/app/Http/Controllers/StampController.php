<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Breaktime;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;



class StampController extends Controller
{
// ビューの表示ーーーーー

    public function index()
    {
        return view('index');
    }

// ーーーーーーー




// 勤務開始ボタンを押した時の処理ーーーーー

    public function startWork()
    {
        $userId = auth()->id();

        // 既に勤務が開始されているかをチェック
        if (Session::has('work_started')) {
            return redirect('/')->with('warning_message', '勤務はすでに開始されています');
        }

        // 勤務開始のフラグをセッションにセット
        Session::put('work_started', true);

        $attendance = Attendance::create([
            'user_id' => $userId,
            'clock_in' => Carbon::now(),
            'work_date' => Carbon::today(),
        ]);

        return redirect('/')->with('success_message', '勤務を開始しました');
    }

// ーーーーーーー




// 勤務終了ボタンを押した時の処理ーーーーー

    public function endWork()
    {
        $userId = auth()->id();

        $attendance = Attendance::where('user_id', $userId)
                        ->whereNull('clock_out')
                        ->latest()
                        ->first();

        if ($attendance) {
            // 勤務終了時に休憩が終了していないかを確認
            $breakTime = Breaktime::where('attendance_id', $attendance->id)
                ->whereNull('end_break')
                ->latest()
                ->first();

            if ($breakTime) {
                return redirect('/')->with('warning_message', '休憩を終了してから勤務を終了してください');
            }

            // 勤務終了時刻を更新
            $attendance->update(['clock_out' => Carbon::now()]);

            // セッションから勤務開始フラグを削除
            Session::forget('work_started');

            return redirect('/')->with('success_message', '勤務を終了しました');
        }

        return redirect('/')->with('warning_message', '勤務開始されていません');
    }

// ーーーーーーー




// 休憩開始ボタンを押した時の処理ーーーーー

    public function startBreak()
    {
        $userId = auth()->id();

        $attendance =
        Attendance::where('user_id',$userId)->whereNull('clock_out')->latest()->first();

            if (!$attendance) {
                return redirect('/')->with('warning_message', '勤務は開始されていません');
            }

        $breakTime = Breaktime::where('attendance_id', $attendance->id)
            ->whereNull('end_break')
            ->latest()
            ->first();

            if ($breakTime) {
                return redirect('/')->with('warning_message', '休憩は既に開始されています');
            }

        Breaktime::create([
            'attendance_id' => $attendance->id,
            'start_break' => Carbon::now(),
        ]);
            return redirect('/')->with('success_message','休憩を開始しました');
    }

// ーーーーーーー




// 休憩終了ボタンを押した時の処理ーーーーー

    public function endBreak()
    {
        $userId = auth()->id();

        $attendance = Attendance::where('user_id', $userId)
            ->whereNull('clock_out')
            ->latest()
            ->first();

        if ($attendance) {
            $breakTime = BreakTime::where('attendance_id', $attendance->id)
                ->whereNull('end_break')
                ->latest()
                ->first();

            if ($breakTime) {
                // 休憩時間を計算
                $startBreak = Carbon::parse($breakTime->start_break);
                $endBreak = Carbon::now();
                $breakDuration = $endBreak->diffInMinutes($startBreak);

                // 休憩終了時間を更新
                $breakTime->update(['end_break' => $endBreak]);

                // 勤怠記録に休憩時間を加算
                $attendance->total_break += $breakDuration;
                $attendance->save();

                return redirect('/')->with('success_message', '休憩を終了しました');
            }

            return redirect('/')->with('warning_message', '休憩が開始されていません');
        }

        return redirect('/')->with('error_message', '勤務が開始されていません');
    }

// ーーーーーーー

}
