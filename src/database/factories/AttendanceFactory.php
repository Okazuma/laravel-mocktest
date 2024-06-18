<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class AttendanceFactory extends Factory
{

    protected $model = Attendance::class;


    public function definition()
    {

        // 勤務開始時間を現在から過去1ヶ月の期間内の午前9時に固定する
        $clockIn = $this->faker->dateTimeBetween('-1 month', 'now')->setTime(9, 0, 0);

        // 例えば、勤務終了時間を8時間後から12時間後のランダムな時刻で設定する場合（15分単位）
        $workMinutes = $this->faker->numberBetween(8 * 60, 12 * 60); // 分単位で計算
        $clockOut = clone $clockIn;
        $clockOut->modify("+$workMinutes minutes");

        // 休憩時間を60分から120分の間でランダムに設定（15分単位）
        $breakMinutes = $this->faker->numberBetween(60, 120);

        // 休憩時間を時間単位で保存
        $totalBreakHours = $breakMinutes / 60;

        // 勤務記録を作成
        return [
            // 'user_id' => $user->id,
            'clock_in' => $clockIn,
            'clock_out' => $clockOut,
            'work_date' => $clockIn->format('Y-m-d'),
            'total_break' => $breakMinutes, // 休憩時間を分単位で保存
        ];
    }

}
