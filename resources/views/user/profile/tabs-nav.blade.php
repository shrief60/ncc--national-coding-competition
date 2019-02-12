<div class="tabs">
    <ul class="nav nav-tabs"  role="tablist">

        <li class="nav-item">
            <a class="nav-link active" id="about-tab" data-toggle="tab" href="#about">
                <img src="{{ icon('about', 'svg') }}" alt="" class="svg">
                <span> @lang('profile.sidebar.about') </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="credits-tab" data-toggle="tab" href="#credits">
                <img src="{{ icon('credits', 'svg') }}" alt="" class="svg">
                <span> @lang('profile.sidebar.credits') </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="activities-tab" data-toggle="tab" href="#activities">
                <img src="{{ icon('activities', 'svg') }}" alt="" class="svg">
                <span> @lang('profile.sidebar.activities') </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="achievments-tab" data-toggle="tab" href="#achievments">
                <img src="{{ icon('achievments', 'svg') }}" alt="" class="svg">
                <span> @lang('profile.sidebar.achievements') </span>
            </a>
        </li>

        @if($user->id == auth()->id())
        <li class="nav-item">
            <a class="nav-link" id="preferences-tab" data-toggle="tab" href="#preferences">
                <img src="{{ icon('settings', 'svg') }}" alt="" class="svg">
                <span> @lang('profile.sidebar.preferences') </span>
            </a>
        </li>
        @endif
    </ul>
</div>
