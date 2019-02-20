
@extends('judge.layout')

@push ('css')
    {!! css('judge/progress') !!}
    {!! css('judge/dashboard') !!}
@endpush

@section('content')
      <div class = "container">
        <div class= "activeRound border">
            <div class ="header border d_flex">
                <span class="fontWord_h "> ROUND 1 </span>
                <img class = "small_icon" src="{{ asset('svg\G_circle.svg') }}" alt="">
                <span class="green_color fontword_el">ACTIVE</span>
            </div>
            <div class ="header border">
                <span class="fontWord_el"> Remaining Time   </span>
                <div class = "d_flex_active rounded_">
                    <div class = "remainingTime margin_p shadow rounded_border">
                        <div class ="header d_flex_time ">
                            <p class = "gray_c fontWord_h"> 20</p>
                            <p class = "gray_c fontWord_h"> 10</p>
                            <p class = "gray_c fontWord_h"> 5</p>
                            <p class = "gray_c fontWord_h"> 20</p>
                        </div>
                        <div class ="header margin_m d_flex_time">
                            <p class = "gray_c fontword_time_el"> Days</p>
                            <p class = "gray_c fontword_time_el"> Hours</p>
                            <p class = "gray_c fontword_time_el"> Minutes</p>
                            <p class = "gray_c fontword_time_el"> Seconds</p>
                        </div>
                    </div>
                    <div class = "remainingTime margin_p">
                        <div class ="header d_flex_time ">
                            <p class = "gray_c fontWord_h" style = "text-align:center"> 314</p>
                        </div>
                        <div class ="header margin_m d_flex_time">
                            <p class = "gray_c fontword_time_el" style = "text-align:center"> Total Submissions</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
      </div>

@stop

@push ('css')

@endpush

<script>
    $(".selector").flatpickr(optional_config);
</script>
