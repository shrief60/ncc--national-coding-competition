<form action="{{ $formAction }}" method="POST">

    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group">
        <input type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" placeholder="@lang('auth.email')">
    </div>

    <div class="grid">

        <div class="form-group">
            <input type="password" placeholder="@lang('auth.password.title')" name="password" class="form-control" />
        </div>

        <div class="form-group">
            <input type="password" placeholder="@lang('auth.password.confirm')" name="password_confirmation" class="form-control" />
        </div>

    </div>

    <button type="submit" class="btn ">
        <img src="{{ getImageIcon('login', 'svg') }}" />
        <span> @lang('auth.password.reset') </span>
    </button>

</form>
