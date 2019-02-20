
@extends('judge.layout')

@push ('css')
    {!! css('judge/progress') !!}
@endpush

@section('content')

<div class = "submissions">

<h2 class = "submissions_word"> Submissions </h2>
        <div class="round">
            <div class = "progress_table_header" >
                <span class = "head_element"> NAME </span>
                <span class = "head_element"> ROUNDS </span>
                <span class = "head_element"> SCORE </span>
                <span class = "head_element"> SUBMISSIONS DATE</span>
                <span class = "head_element"> TOTAL SCORE </span>
            </div>
            <div class = "progress_body">
                @foreach($users as $user)
                        <div  class = "progress_table_body" id = "progress_{{ $user->id }}">
                            <div class = "userData">
                                <img src="{{ $user->avatar }}" alt="user Photo" class ="profileimage">
                                <p class = "body_element_name black_c textBold"> {{ $user->name }} </p>
                            </div>
                            <div>
                                @for($i = 0 ; $i < 3 ;$i++)
                                    <div class = "progress_table_body_operations">
                                        <p class = "body_element white_c">{{ $i+1 }}  <img src="{{ asset('svg/correct-symbol.svg') }}" alt="Finished" class = "FinishedBtn"></p>
                                        <p class = "body_element white_c">40 </p>
                                        <p class = "body_element_date white_c">12 FEB 2019 12.30PM </p>
                                    </div>
                                @endfor
                            </div>

                            <p class = "body_element white_c padding5"> 200 </p>
                            <span class = "show_btn" onclick = "viewSubmission( )"> view <img src="{{ asset('svg/angle-arrow-down.svg') }}" alt="" class = "arrow_down"> </span>

                        </div>
                @endforeach
            </div>
        </div>
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
