@extends('user.layout')

@section('content')

<div class="content">
    @foreach ($rounds as $round)
        @if($round->isStarted())
        <div class="round-date">
            <div class="round-time-diff">
                <img src="{{ icon('hourglass', 'svg') }}" alt="Hourglass" class="svg">
                <div class="text">
                    <span class="text-uppercase"> {{ $round->name }} closing at</span>
                    <span class="text-black bold"> {{ $round->remainingDate() }} </span>
                </div>
            </div>
            <div class="round-due-date">
                <p class="text"> {{ $round->name }} is now open due to {{ $round->dueDate() }} </p>
                <span class="icon pointer"> <i class="fas fa-times"></i> </span>
            </div>
        </div>

        @endif
    @endforeach

    <div class="progressbar">
        <div class="bar"></div>
        <img class="start_icon_progress" src="{{ asset('svg/rightcheck.svg') }}" alt="">
        @foreach ($rounds as $round)
        <div class="circle circle{{ $loop->iteration }} shadow {{ $round->status }}">
            @if($round->isStarted())
            <img class="icon_lock" src="{{ asset('svg/padlock-unlock.svg') }}" alt="" sizes="">
            @elseif($round->isFinished())
            <img class="icon_lock" src="{{ asset('svg/rightcheck.svg') }}" alt="" sizes="">
            @else
            <img class="icon_lock" src="{{ asset('svg/padlock.svg') }}" alt="" sizes="">
            @endif
            <p class="progress_round"> Round </p>
            <p class="progress_round_num"> #{{ $loop->iteration }} </p>
        </div>
        @endforeach
        <div class="circle_end shadow"></div>
    </div>

    @include('user.rounds.show')

    @include('user.ideas.show')
</div>


@endsection

@push('css')
    {!! css('user/rounds/index') !!}
    {!! css('user/rounds/round') !!}
@endpush


@push('js')
    {!! js('user/rounds/index') !!}
@endpush
