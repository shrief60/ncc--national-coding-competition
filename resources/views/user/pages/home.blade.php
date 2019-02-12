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
                    <span class="text-black bold"> 18days:1hr:20min </span>
                </div>
            </div>
            <div class="round-due-date">
                <p class="text"> {{ $round->name }} is now open due to {{ $round->due_date }} </p>
                <span class="icon pointer"> <i class="fas fa-times"></i> </span>
            </div>
        </div>

        @endif
    @endforeach

    @include('user.rounds.index')
</div>


@endsection

@push('css')
    {!! css('user/rounds/index') !!}
    {!! css('user/rounds/round') !!}
@endpush
