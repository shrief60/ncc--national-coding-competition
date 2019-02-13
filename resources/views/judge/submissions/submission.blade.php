
@extends('judge.layout')

@push ('css')
    {!! css('judge/progress') !!}
@endpush

@section('content')

<div class = "submissions">

    <h2 class = "submissions_word"> Submission </h2>

    <div class = "sub_data">
        <div class = "element">
            <p> User :</p>
            <p>{{ $sub->user->name }}</p>
        </div>
        <div class = "element">
            <p> Round :</p>
            <p>{{ $sub->round->name }}</p>
        </div>
        <div class = "element">
            <p> Idea :</p>
            <p>{{ $sub->idea->name }}</p>
        </div>
        <div class = "element">
            <p> Grade :</p>
            <p>{{ $sub->grade }}</p>
        </div>
        <div class = "element">
            <p> Submission :</p>
             <button type="button" class="btn btn-primary" style = "width : 50%;"> Show </button>
        </div>


    </div>
    <center style = "margin-top:10%;">
         <button type="button" class="btn btn-primary" style = "width : 50%;"> Select As Winner  </button>
    </center>
</div>
@stop

@push ('css')
    {!! css('judge/create') !!}
@endpush

<script>
    $(".selector").flatpickr(optional_config);
</script>
