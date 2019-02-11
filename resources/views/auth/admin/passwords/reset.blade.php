@extends('layouts.auth')

@section('form')

@include('auth.layouts.passwords.reset', ['formAction' => route('admin.password.reset')])

@stop
