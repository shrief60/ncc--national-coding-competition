@extends('layouts.auth')

@section('form')

@include('auth.general.passwords.reset', ['formAction' => route('judge.password.reset')])

@stop
