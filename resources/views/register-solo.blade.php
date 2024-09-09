@extends('layouts.app')

@section('register-solo')
    @include('layouts.header')
    @include('modals.profileModal')
    @include('modals.profileDelete')
    @include('register.register-solo')
@endsection
