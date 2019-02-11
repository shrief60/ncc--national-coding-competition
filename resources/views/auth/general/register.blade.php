<form action="{{ $formAction }}" method="POST">

    @csrf

    <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="@lang('main.name')" value="{{ old('name') }}" />
    </div>

    <div class="form-group">
        <input type="text" class="form-control" name="username" placeholder="@lang('auth.username')" value="{{ old('username') }}" />
    </div>

    <div class="form-group">
        <input type="text" class="form-control" name="email" placeholder="@lang('auth.email')" value="{{ old('email') }}" />
    </div>

    <div class="grid">

        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="@lang('auth.password.title')" />
        </div>

        <div class="form-group">
            <input type="password" placeholder="@lang('auth.password.confirm')" name="password_confirmation" class="form-control" />
        </div>

    </div>

    @isset($userType)
    <input type="hidden" name="type" value="{{ $userType }}">
    @endisset

    <button type="submit" class="btn ">
        <img src="{{ getImageIcon('login', 'svg') }}" />
        <span> @lang('auth.register') </span>
    </button>
</form>
