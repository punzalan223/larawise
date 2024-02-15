@extends('backend.main-layout')

{{-- Module Title --}}
@section('title', 'User Accounts')

@section('content')
    @livewire('content.add-user')
@endsection