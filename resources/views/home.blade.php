@extends('layouts.app')
@section('home')
    @include('layouts.header')
    @include('home.slider')
    @include('home.games')
    @include('modals.profileModal')
    @include('modals.profileDelete')
    @php
        $offlineStatus = App\Models\UserOfflineStatus::where('user_id', Auth::id())->first();
    @endphp
    @if ($offlineStatus === null || $offlineStatus->offline === 'Нет')
        @include('modals.offlineModal')
        @include('modals.offlineModalYES')
    @endif
@endsection
