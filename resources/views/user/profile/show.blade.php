@extends('layouts.user')

@section('content')

@include('partials.header')

<div class="main">

    <aside class="sidebar shadow-lg">
        <div class="basic-info">
            <div class="profile">
                @if($user->id == auth()->id())
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="avatar"> <img src="{{ icon('pen', 'svg') }}" class="svg" /> </label>
                    <input type="file" name="avatar" id="avatar" accept="image/*">
                </form>
                @endif
                <div class="position-relative">
                    <div class="image" style="background-image: url({{ $user->avatar }})"></div>
                    <div class="points">
                        <img src="{{ icon('medal', 'svg') }}" class="svg medal">
                        <div>
                            <span class="number">
                                <span class="plus">+</span>{{ $user->points }}
                            </span>
                            <span class="text"> @lang('profile.points') </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="name">
                @include('user.profile.edit-icon', ['name' => 'name'])
                <h3 data-updatable="name"> {{ $user->name }} </h3>
                @include('user.profile.edit', ['name' => 'name'])
            </div>
            <div class="date_of_birth">
                <p class="text" data-updatable="birthday">  {{ $user->birthday }} </p>
                @include('user.profile.edit-icon', ['name' => 'birthday'])
                @if($user->id == auth()->id())
                <div class="editing" data-editable="birthday">
                    <form method="POST" action="{{ route('profile.update') }}">
                        <input type="date" class="form-control edit-input" name="date_of_birth" value="{{ $user->date_of_birth }}" placeholder="@lang('profile.placeholder.birthday')">
                        <img src="{{ icon('save', 'svg') }}" alt="" class="svg save">
                        <img src="{{ icon('close', 'svg') }}" alt="" class="svg cancel">
                    </form>
                </div>
                @endif
            </div>
            <p data-updatable="occupation" class="text"> {{ $user->occupation }} </p>
            <p data-updatable="school" class="text"> {{ $user->school }} </p>
        </div>

        @include('user.profile.tabs-nav')

    </aside>

    @include('user.profile.tabs-content')

</div>

@endsection


@push('css')

{!! css('user/pages/profile') !!}
@endpush


@push('scripts')
    {!! js('user/pages/profile') !!}
@endpush
