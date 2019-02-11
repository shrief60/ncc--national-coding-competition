@extends('layouts.auth')

@section('form')

@include('auth.general.login', [
    'formAction' => route('judge.login'),
    'forgetPassword' => route('judge.password.reset'),
])
<div class="social">

    <div class="or">
        <div class="hr"></div>
        <h3> @lang('auth.social') </h3>
        <div class="hr"></div>
    </div>

    <div class="links">

        <a target="_blank" href="{{ url('/login/facebook') }}">
            <img src="{{ icon('facebook', 'svg') }}" class="svg"/>
        </a>

        <a target="_blank" href="{{ url('/login/google') }}">
            <img src="{{ icon('gmail', 'svg') }}" class="svg"/>
        </a>

    </div>
</div>
@stop
