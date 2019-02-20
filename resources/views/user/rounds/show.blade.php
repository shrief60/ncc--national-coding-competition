<div class="main_round_selection">
    <h2 class="ideaHeader center margin-bottom "> SELECT IDEA TO IMPLEMENT </h2>
    <input type="hidden" id="selected-idea">
    <div class="ideas">
        @foreach ($rounds as $round)
            @if($round->isStarted())
                @foreach ($round->ideas as $idea)
                <div class="select_idea_div pointer {{ $idea->isSelected() ? 'border_active' : 'border_native' }}" data-idea="{{ $idea->id }}">
                    <div class="round_left">
                        <h2 class="ideaHeader_select"> APP IDEA #{{ $loop->iteration }} </h2>
                        <p class="ideaDescription_select"> {{ $idea->description }} </p>
                    </div>
                    <div class="round_right">
                        <img class="image_round_select selected {{ $idea->isSelected() ? 'shown' : 'hidden' }}"
                        src="{{ asset('svg/rightcheck.svg') }}" alt="">
                        <img class="image_round_select not-selected {{ !$idea->isSelected() ? 'shown' : 'hidden' }}" src="{{ asset('svg/verified.svg') }}" alt="">
                    </div>
                </div>
                @endforeach
            @endif
        @endforeach
    </div>

    <center>
        <button class="nextStep btn">NEXT STEP ></button>
    </center>
</div>
