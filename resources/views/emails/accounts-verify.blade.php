@extends('emails.template')
@section('header')
<h2>Verify Your Email Address</h2>
@endsection
@section('content')
    Thanks for creating an account.
    Please follow the link below to verify your email address
    <a href="{{ route('auth.verify', $confirmation_code) }}">Verify Account</a>.<br/>

    <p>Or copy paste this link to your browser {{ route('auth.verify', $confirmation_code) }}</p>
@endsection
