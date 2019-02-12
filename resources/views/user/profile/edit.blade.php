@if($user->id == auth()->id())
<div class="editing" data-editable="{{ $name }}">
    <form method="POST" action="{{ route('profile.update') }}" >
        @php
        $value = isset($profile) ? $user->$name : $user->$name;
        @endphp
        <input type="text" class="form-control edit-input" placeholder='@lang("profile.placeholder.{$name}")' name="{{ $name }}" value="{{ $value }}">
        <img src="{{ icon('save', 'svg') }}" alt="" class="svg save">
        <img src="{{ icon('close', 'svg') }}" alt="" class="svg cancel">
    </form>
    @isset($help)
        <small class="help"> {{ $help }} </small>
    @endisset
</div>
@endif
