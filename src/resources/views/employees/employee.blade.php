@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/employee.css') }}">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="employee__container">

        <div class="employee__heading">
            <h2 class="employee__ttl">勤務者一覧</h2>
        </div>

        <table class="employee__group__content">
            <tr class="employee-table__row">
                <th class="employee-table__heading">名前</th>
                <th class="employee-table__heading">勤務情報</th>
            </tr>

            @foreach($users as $user)
            <tr class="employee-table__row">
                <td class="employee-table__item">{{ $user->name }}</td>
                <td class="employee-table__item">
                    <div class="employee__button">
                        <a class="employee__button-detail" href="{{ route('employees.detail', $user->id) }}">詳細</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>

        <div class="footer__paginate">
            {{ $users->links('vendor.pagination.bootstrap-4') }}
        </div>

    </div>
@endsection