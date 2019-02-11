<form action="{{ $formAction }}" method="POST">

    @csrf

    <div class="input-group">
        <input type="text" class="form-control" name="username" placeholder="@lang('auth.username_or_email')" value="{{ old('username') }}" />
    </div>

    <div class="form-group">
        <input type="password" placeholder="@lang('auth.password.title')" name="password" class="form-control" />
    </div>

    @isset($forgetPassword)
    <a id="password-forget" href="{{ $forgetPassword }}"> @lang('auth.password.forget')   </a>
    @endisset

    <button type="submit" class="btn ">
        <img src="{{ getImageIcon('login', 'svg') }}" />
        <span> @lang('auth.sign_in') </span>
    </button>

</form>
