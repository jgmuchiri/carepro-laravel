@extends('emails.template')
@section('header')
<h2>@lang('Parent registered a child')</h2>
@endsection
@section('content')
    @lang('Parent registered a child')
    <a href="{{ route('children.index') }}">@lang('Activate Child')</a>.<br/>

    <p>@lang('Or copy paste this link to your browser') {{ route('children.index') }}</p>
@endsection
