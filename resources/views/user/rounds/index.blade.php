<div class="progressbar">
    <div class="bar"></div>
    <img class="start_icon_progress" src="{{ asset('svg/rightcheck.svg') }}" alt="">
    @foreach ($rounds as $round)
    <div class="circle circle{{ $loop->iteration }} shadow {{ $round->status }}">
        @if($round->isStarted())
        <img class="icon_lock" src="{{ asset('svg/padlock-unlock.svg') }}" alt="" sizes="">
        @else
        <img class="icon_lock" src="{{ asset('svg/padlock.svg') }}" alt="" sizes="">
        @endif
        <p class="progress_round"> Round </p>
        <p class="progress_round_num"> #{{ $loop->iteration }} </p>
    </div>
    @endforeach
    <div class="circle_end shadow"></div>
</div>

<div class="main_round_selection">
    <h2 class="ideaHeader center margin-bottom "> SELECT IDEA TO IMPLEMENT </h2>
    <div class="ideas">
        @foreach ($rounds->first()->ideas as $idea)
        <div class="select_idea_div  {{ $idea->isFinished() ? 'border_active' : 'border_native' }}">
            <div class="round_left">
                <h2 class="ideaHeader_select"> APP IDEA #{{ $loop->iteration }} </h2>
                <p class="ideaDescription_select"> {{ $idea->description }} </p>
            </div>
            <div class="round_right">
                @if($idea->isFinished())
                <img class="image_round_select" src="{{ asset('svg/rightcheck.svg') }}" alt="">
                @else
                <img class="image_round_select" src="{{ asset('svg/verified.svg') }}" alt="">
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <center>
        <button class="nextStep btn">NEXT STEP ></button>
    </center>
</div>

