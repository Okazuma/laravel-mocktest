<!-- @extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/employee.css') }}">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
@endsection


@section('content')


<div class="employee__container">

    <table class="employee__group__content">
        <tr class="employee-table__row">
            <th class="employee-table__heading">名前</th>
            <th class="employee-table__heading">勤務開始</th>
            <th class="employee-table__heading">勤務終了</th>
            <th class="employee-table__heading">休憩時間</th>
            <th class="employee-table__heading">勤務時間</th>
        </tr>

        @foreach($attendances as $attendance)
        <tr class="employee-table__row">
            <td class="employee-table__item">{{ $attendance->user->name }}</td>
            <td class="employee-table__item">{{ $attendance->clock_in ? $attendance->clock_in->format('H:i:s') : '-' }}</td>
            <td class="employee-table__item">{{ $attendance->clock_out ? $attendance->clock_out->format('H:i:s') : '-' }}</td>
            <td class="employee-table__item">{{ $attendance->formatted_total_break }}</td>
            <td class="employee-table__item">{{ $attendance->formatted_total_work_time }}</td>
        </tr>
        @endforeach
    </table>



</div>




@endsection -->