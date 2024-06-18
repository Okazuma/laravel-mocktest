@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
@endsection


@section('content')
    <div class="detail__container">
        <div class="detail__heading">
            <h2 class="detail__ttl">{{ $user->name }}の勤怠記録</h2>
        </div>

        <table class="detail__group__content">
            <tr class="detail-table__row">
                <th class="detail-table__heading">Date</th>
                <th class="detail-table__heading">勤務開始</th>
                <th class="detail-table__heading">勤務終了</th>
                <th class="detail-table__heading">休憩時間</th>
                <th class="detail-table__heading">就業時間</th>
            </tr>

            @foreach($attendances as $attendance)
                <tr class="detail-table__row">
                    <td class="detail-table__item">{{ \Carbon\Carbon::parse($attendance->work_date)->format('m/d') }}</td>
                    <td class="detail-table__item">{{ \Carbon\Carbon::parse($attendance->clock_in)->format('H:i:s') }}</td>
                    <td class="detail-table__item">{{ \Carbon\Carbon::parse($attendance->clock_out)->format('H:i:s') }}</td>
                    <td class="detail-table__item">{{ $attendance->formatted_total_break }}</td>
                    <td class="detail-table__item">{{ $attendance->formatted_total_work_time }}</td>
                </tr>
            @endforeach
        </table>

        <div class="footer__paginate">
        {{ $attendances->links('vendor.pagination.bootstrap-4') }}
        </div>

    </div>
@endsection