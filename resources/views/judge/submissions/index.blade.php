
@extends('judge.layout')

@push ('css')
    {!! css('judge/progress') !!}
@endpush

@section('content')

<div class = "submissions">

<h2 class = "submissions_word"> Submissions </h2>
    @foreach($rounds as $round )
        <div class="round">
            <div class = "progress_header" >
                <span> {{ $round->name }} </span>
            </div>
            <div class = "progress_body">
                @foreach($submissions as $sub)
                    @if($sub->round_id == $round->id)
                        <div  class = "progess" id = "progress_{{ $sub->id }}">
                            <p> {{ $sub->user->name }} </p>
                            <p> {{ $sub->grade }}</p>
                            <p> Idea : {{ $sub->idea->name }}</p>

                            <button class = "btn orange" onclick ="viewSubmission({{ $sub->id }})"> Show  </button>

                        </div>

                    @endif

                @endforeach
            </div>
        </div>
    @endforeach
</div>
@stop

@push ('css')
    {!! css('judge/create') !!}
@endpush
@push('js')
    <script>
        $(".selector").flatpickr(optional_config);
        function viewSubmission(id){
            window.location = `show/${id}`;

        }
    </script>
@endpush
