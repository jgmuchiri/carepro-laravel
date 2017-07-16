@extends('emails.template')
@section('header')
<h2>@lang('Verify Your Email Address')</h2>
@endsection
@section('content')
    @lang('Thanks for creating an account.')
    @lang('Please follow the link below to verify your email address')
    <a href="{{ route('auth.verify', $confirmation_code) }}">@lang('Verify Account')</a>.<br/>

    <p>@lang('Or copy paste this link to your browser') {{ route('auth.verify', $confirmation_code) }}</p>
@endsection
