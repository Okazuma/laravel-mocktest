<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Breaktime;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

        public function run()
    {
        // ユーザーを10人作成
        User::factory(10)->create()->each(function ($user) {
            // 各ユーザーに対して10個の勤怠記録を作成
            Attendance::factory(20)->create(['user_id' => $user->id])->each(function ($attendance) {
                // 各勤怠記録に対して2個の休憩記録を作成
                $attendance->breaktimes()->saveMany(Breaktime::factory(2)->make());
            });
        });
    }

}
