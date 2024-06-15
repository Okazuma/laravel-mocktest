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

            return $workDuration - ($this->total_break * 60);
        }
        return null;
    }


    // 休憩合計時間を時間、分、秒でフォーマットするアクセサ
    public function getFormattedTotalBreakAttribute()
    {
    if ($this->total_break !== null) {
        $hours = intdiv($this->total_break, 3600);
        $minutes = intdiv($this->total_break % 3600, 60);
        $seconds = $this->total_break % 60;
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
    return '00:00:00';
    }


    // 勤務合計時間を時間、分、秒でフォーマットするアクセサ
    public function getFormattedTotalWorkTimeAttribute()
    {
        if ($this->totalWorkTime !== null) {
            $hours = intdiv($this->totalWorkTime, 3600);
            $minutes = intdiv($this->totalWorkTime % 3600, 60);
            $seconds = $this->totalWorkTime % 60;
            return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        }
        return '00:00:00';
    }


    // public function getFormattedWorkDateAttribute()
    // {
    //     if ($this->work_date) {
    //         return Carbon::parse($this->work_date)->format('m/d');
    //     }
    //     return null;
    // }

}