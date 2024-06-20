@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
@endsection



@section('content')
    <div class="atte__container">
        <div class="atte__heading">
            <div class="atte__button">
                <button class="atte__button-prev" id="prev-date">&lt;</button>
            </div>
            <h2 class="atte__ttl">{{ $date }}</h2>
            <div class="atte__button">
                <button class="atte__button-next" id="next-date">&gt;</button>
            </div>
        </div>

        <table class="atte__group__content">
            <tr class="atte-table__row">
                <th class="atte-table__heading">名前</th>
                <th class="atte-table__heading">勤務開始</th>
                <th class="atte-table__heading">勤務終了</th>
                <th class="atte-table__heading">休憩時間</th>
                <th class="atte-table__heading">勤務時間</th>
            </tr>

            @foreach($attendances as $attendance)
            <tr class="atte-table__row">
                <td class="atte-table__item">{{ $attendance->user->name }}</td>
                <td class="atte-table__item">{{ $attendance->clock_in ? $attendance->clock_in->format('H:i:s') : '-' }}</td>
                <td class="atte-table__item">{{ $attendance->clock_out ? $attendance->clock_out->format('H:i:s') : '-' }}</td>
                <td class="atte-table__item">{{ $attendance->formatted_total_break }}</td>
                <td class="atte-table__item">{{ $attendance->formatted_total_work_time }}</td>
            </tr>
            @endforeach
        </table>

        <div class="footer__paginate">
            {{ $attendances->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const prevDateLink = document.getElementById('prev-date');
            const nextDateLink = document.getElementById('next-date');

            prevDateLink.addEventListener('click', function(e) {
                e.preventDefault();
                updateDate(-1); // 前の日
            });

            nextDateLink.addEventListener('click', function(e) {
                e.preventDefault();
                updateDate(1); // 次の日
            });

            function updateDate(daysToAdd) {
                const currentUrl = new URL(window.location.href);
                let currentDate = currentUrl.searchParams.get('date');
                if (!currentDate) {
                    // URLに日付が含まれていない場合は、本日の日付を使用する
                    currentDate = new Date();
                } else {
                    currentDate = new Date(currentDate);
                }

                currentDate.setDate(currentDate.getDate() + daysToAdd);
                const year = currentDate.getFullYear();
                const month = String(currentDate.getMonth() + 1).padStart(2, '0');
                const day = String(currentDate.getDate()).padStart(2, '0');
                const formattedDate = `${year}-${month}-${day}`;

                currentUrl.searchParams.set('date', formattedDate);
                window.location.href = currentUrl.toString();
            }
        });
    </script>

@endsection

