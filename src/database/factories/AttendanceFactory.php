<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;


class AttendanceFactory extends Factory
{

    protected $model = Attendance::class;


    public function definition()
    {
        // 現在から過去1ヶ月以内のランダムな日付を取得
        $randomDate = $this->faker->dateTimeBetween('-1 month', 'now');

        // 8時45分から9時の間のランダムな分を生成
        $randomMinutes = $this->faker->numberBetween(0, 14); // 0から14のランダムな数値

        // 8時45分にランダムな分を加えて、勤務開始時間を設定
        $clockIn = Carbon::instance($randomDate)->setTime(8, 45, 0)->addMinutes($randomMinutes);

        // 勤務終了時間を9時間30分から11時間後のランダムな時刻で設定する
        $workHours = $this->faker->numberBetween(9, 10); // 9から10時間
        $workMinutes = 0;

        // 9時間30分から11時間になるように調整
        if ($workHours === 9) {
            $workMinutes = $this->faker->numberBetween(30, 59);
        } else {
            $workMinutes = $this->faker->numberBetween(0, 59);
        }
        $workSeconds = $this->faker->numberBetween(0, 59);

        $clockOut = Carbon::parse($clockIn)->addHours($workHours)->addMinutes($workMinutes)->addSeconds($workSeconds);

        // 休憩時間を60分から120分の間で設定し、秒単位で計算
        $breakMinutes = $this->faker->numberBetween(60, 120);
        $breakSeconds = $this->faker->numberBetween(0, 59);
        $totalBreakSeconds = ($breakMinutes * 60) + $breakSeconds;

        // 勤務記録を作成
        return [
            'clock_in' => $clockIn,
            'clock_out' => $clockOut,
            'work_date' => $clockIn->format('Y-m-d'),
            'total_break' => $totalBreakSeconds,
        ];
    }

}
