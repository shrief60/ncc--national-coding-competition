@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

<form action="{{ $formAction }}" method="POST">

    @csrf

    <div class="form-group">
        <input id="email" type="email" class="form-control" placeholder="@lang('auth.email')" name="email" value="{{ old('email') }}" autofocus>
    </div>

    <button type="submit" class="btn">
        <img src="{{ getImageIcon('login', 'svg') }}" />
        <span> @lang('auth.password.email') </span>
    </button>

</form>
