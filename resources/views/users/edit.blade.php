@extends('layouts.master')
@section('styles')

@endsection
@section('title')
    Edit Profile
@endsection
@section('content')
    @include('front.partials.nav')
    @include('front.partials.login-notice')
    <ol class="breadcrumb blue-grey lighten-5">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Users</li>
        <li class="breadcrumb-item active">{{ $user->name }}</li>
        <li class="breadcrumb-item active">Edit Profile</li>
    </ol>
    

@endsection
