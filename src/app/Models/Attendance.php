<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'clock_in',
        'clock_out',
        'work_date',
        'total_break'
    ];

    protected $dates = ['clock_in', 'clock_out'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function breaktimes()
    {
        return $this->hasMany(Breaktime::class);
    }


    // 勤務合計時間を計算するアクセサ

    public function getTotalWorkTimeAttribute()
    {
        if ($this->clock_in && $this->clock_out)
        {
            $start = $this->clock_in;
            $end = $this->clock_out;
            $workDuration = $end->diffInSeconds($start);

            // getTotalBreakTimeInSecondsAttribute() メソッドで計算した休憩時間を取得
            $breakTimeInSeconds = $this->getTotalBreakTimeInSecondsAttribute();

            return $workDuration - $breakTimeInSeconds;
        }
        return null;
    }

    // ーーーーーーーーーー



    // 休憩合計時間を計算するアクセサ

    public function getTotalBreakTimeInSecondsAttribute()
    {
        return $this->total_break;
    }

    // ーーーーーーーーーー



    // 休憩合計時間を時間、分、秒でフォーマットするアクセサ

    public function getFormattedTotalBreakAttribute()
    {
        $totalBreakInSeconds = $this->getTotalBreakTimeInSecondsAttribute();

        if ($totalBreakInSeconds !== null) {
            $hours = intdiv($totalBreakInSeconds, 3600);
            $minutes = intdiv($totalBreakInSeconds % 3600, 60);
            $seconds = $totalBreakInSeconds % 60;
            return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        }
        return '00:00:00';
    }

    // ーーーーーーーーーー



    // 勤務合計時間を時間、分、秒でフォーマットするアクセサ

    public function getFormattedTotalWorkTimeAttribute()
    {
        $totalWorkTimeInSeconds = $this->getTotalWorkTimeAttribute();

        if ($totalWorkTimeInSeconds !== null) {
            $hours = intdiv($totalWorkTimeInSeconds, 3600);
            $minutes = intdiv($totalWorkTimeInSeconds % 3600, 60);
            $seconds = $totalWorkTimeInSeconds % 60;
            return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        }
        return '00:00:00';
    }

    // ーーーーーーーーーー

}
