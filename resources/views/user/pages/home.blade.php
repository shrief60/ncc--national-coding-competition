@extends('user.layout')

@section('content')
<div class="round-date">
    <div class="round-time-diff">
        <img src="{{ icon('hourglass', 'svg') }}" alt="Hourglass" class="svg">
        <div class="text">
            <span class="text-uppercase"> round 1 closing at</span>
            <span class="text-black bold"> 18days:1hr:20min </span>
        </div>
    </div>
    <div class="round-due-date">
        <p class="text"> Round one is now open due to 3 June </p>
        <span class="icon pointer"> <i class="fas fa-times"></i> </span>
    </div>
</div>

<div class="stepper">
</div>
@endsection

@push('css')
    {!! css('user/rounds/index') !!}
@endpush
