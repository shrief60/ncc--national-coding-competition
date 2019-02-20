
@extends('judge.layout')
@section('content')

<div class = "form_addition">

<h2 class = "submissions_word"> Create Round </h2>
    <form method="post" action = "{{ route('judge.rounds.create') }}" >
     @csrf
        <div class="form-group">
            <label for="roundNAme"> Round Name</label>
            <input type="text" class="form-control" id="roundName" name="roundName" placeholder="Enter Round Name">
        </div>
        <div class="form-group">
             <label for="roundNAme"> Due Date</label>
             <input type="text" class = "selector form-control" name="duedate">
        </div>
        <input type="submit" class = "btn btn-secondary" value="Save" >
    </form>
</div>
@stop

@push ('css')
    {!! css('judge/create') !!}
@endpush
@push('js')
<script>
    $(".selector").flatpickr(
        {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    }
    );
</script>
@endpush
