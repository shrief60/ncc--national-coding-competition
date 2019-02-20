<div class="tab-pane fade" id="preferences" role="tabpanel" aria-labelledby="preferences-tab">
    <div id="preferences-wrapper">
        <div class="my-card basic">
            <div class="header">
                <h3> @lang('profile.sidebar.preferences') </h3>
            </div>
            <div class="body">

                <div class="gender shadow-lg">
                    <div class="grid">
                        <div class="left">
                            <img src="{{ icon('gender', 'svg') }}" alt="" class="svg">
                            <span> @lang('profile.preferences.gender.title') </span>
                        </div>
                        <div class="right" data-updatable="gender">  {{ $user->gender }} </div>
                        @include('user.profile.edit-icon', ['name' => 'gender'])
                    </div>
                    <div class="editing" data-editable="gender">
                        <form method="POST" class="gender" action="{{ route('user.profile.update') }}">
                            <div>
                                <div class="pretty p-jelly p-image p-plain">
                                    <input type="radio" name="gender" value="Male" />
                                    <div class="state">
                                        <img src="{{ icon('male', 'svg') }}" alt="" class="icon">
                                        <label> @lang('profile.preferences.gender.male') </label>
                                    </div>
                                </div>

                                <div class="pretty p-jelly p-image p-plain">
                                    <input type="radio" name="gender" value="Female" />
                                    <div class="state">
                                        <img src="{{ icon('female', 'svg') }}" alt="" class="icon">
                                        <label> @lang('profile.preferences.gender.female') </label>
                                    </div>
                                </div>
                            </div>
                            <img src="{{ icon('save', 'svg') }}" alt="" class="svg save">
                            <img src="{{ icon('close', 'svg') }}" alt="" class="svg cancel">
                        </form>
                    </div>
                </div>

                <div class="password shadow-lg">

                    <div class="grid">
                        <div class="left">
                            <img src="{{ icon('password', 'svg') }}" alt="" class="svg">
                            <span> @lang('profile.preferences.password.title') </span>
                        </div>
                        <div class="right"></div>
                    </div>
                    <form action="{{ route('user.profile.update') }}" method="POST" class="mx-4 pt-2 pb-4">
                        @csrf
                        <div class="form-group">
                            <input type="password" class="form-control input__outline__primary" name="password"
                            placeholder="@lang('profile.preferences.password.title')">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control input__outline__primary" name="password_confirmation"
                            placeholder="@lang('profile.preferences.password.confirm')">
                        </div>
                        <button class="btn btn__primary"> @lang('profile.preferences.password.change') </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
