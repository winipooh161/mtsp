@extends('layouts.app')

@section('register-group')
    @include('layouts.header')
    @include('modals.profileModal')
    @include('modals.profileDelete')
    @include('register.register-group')
@endsection
