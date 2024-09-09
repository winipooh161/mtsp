@extends('layouts.app')

@section('thanky')
    @include('layouts.header')
    @include('modals.profileModal')
    @include('modals.profileDelete')
    @include('thanky.thankyPage')
@endsection
