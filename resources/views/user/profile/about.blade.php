<div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">

    <div id="about-wrapper">

        <!-- BASIC INFO -->
        <div class="my-card basic">
            <div class="header">
                <h3> @lang('profile.about.basic.title') </h3>
            </div>
            <div class="body">

                <div class="school shadow-lg">
                    <div class="grid">
                        <div class="left">
                            <img src="{{ icon('school', 'svg') }}" alt="" class="svg">
                            <span> @lang('profile.about.basic.school') </span>
                        </div>
                        <div class="right" data-updatable="school">  {{ $user->school }} </div>
                        @include('user.profile.edit-icon', ['name' => 'school'])
                    </div>
                    @include('user.profile.edit', ['name' => 'school', 'profile' => true])
                </div>


                <div class="occupation shadow-lg">
                    <div class="grid">
                        <div class="left">
                            <img src="{{ icon('portfolio', 'svg') }}" alt="" class="svg">
                            <span> @lang('profile.about.basic.occupation') </span>
                        </div>
                        <div class="right" data-updatable="occupation">  {{ $user->occupation }} </div>
                        @include('user.profile.edit-icon', ['name' => 'occupation'])
                    </div>
                    @include('user.profile.edit', ['name' => 'occupation', 'profile' => true])
                </div>

                <div class="subjects shadow-lg">
                    <div class="grid">
                        <div class="left">
                            <img src="{{ icon('subjects', 'svg') }}" alt="" class="svg">
                            <span> @lang('profile.about.basic.subjects') </span>
                        </div>
                        <div class="right" data-updatable="subjects">
                            {{ $user->subjects }}
                        </div>
                        @include('user.profile.edit-icon', ['name' => 'subjects'])
                    </div>
                    @include('user.profile.edit', ['name' => 'subjects', 'profile' => true, 'help' => trans('profile.about.basic.subjects_help')
                    ])

                </div>

                <div class="levels shadow-lg">
                    <div class="grid">
                        <div class="left">
                            <img src="{{ icon('levels', 'svg') }}" alt="" class="svg">
                            <span> @lang('profile.about.basic.levels') </span>
                        </div>
                        <div class="right" data-updatable="levels">
                            {{ $user->levels }}
                        </div>
                        @include('user.profile.edit-icon', ['name' => 'levels'])
                    </div>
                    @include('user.profile.edit', ['name' => 'levels', 'profile' => true, 'help' => trans('profile.about.basic.levels_help') ])
                </div>

            </div>
        </div>
        <!-- BASIC INFO -->


        <!-- BIO INFO -->
        <div class="my-card bio">
            <div class="title"> @lang('profile.about.bio.title') </div>
            <div class="body">
                @include('user.profile.edit-icon', ['name' => 'bio'])
                <div class="text">
                    <img src="{{ icon('quote', 'svg') }}" class="svg quote">
                    <p data-updatable="bio">{!! $user->bio !!}</p>
                </div>
                @if($user->id == auth()->id())
                <div class="editing" data-editable="bio">
                    <form method="POST" class="bio-form" action="{{ route('user.profile.update') }}">
                        <textarea placeholder="@lang('profile.about.bio.bio')" rows="13" class="form-control" name="bio">{{ $user->bio }}</textarea>
                        <button type="submit" class="btn save"> <img src="{{ icon('save', 'svg') }}" alt="" class="svg"> </button>
                        <button type="button" class="btn cancel"> <img src="{{ icon('close', 'svg') }}" alt="" class="svg"> </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
        <!-- BIO INFO -->


        <!-- EDUCATION INFO -->
        <div class="my-card education">
            <div class="header">
                <h3>  @lang('profile.about.education.title') </h3>
            </div>
            <div class="body">

                <div>
                    @include('user.profile.edit-icon', ['name' => 'graduation', 'profile' => true])
                    <h5 class="title"> @lang('profile.about.education.graduation') </h5>
                    <p data-updatable="graduation"> {{ $user->graduation }} </p>
                    @include('user.profile.edit', ['name' => 'graduation', 'profile' => true])
                </div>

                <div>
                    @include('user.profile.edit-icon', ['name' => 'university', 'profile' => true])
                    <h5 class="title">@lang('profile.about.education.university') </h5>
                    <p data-updatable="university"> {{ $user->university }} </p>
                    @include('user.profile.edit', ['name' => 'university', 'profile' => true])
                </div>

            </div>
        </div>
        <!-- EDUCATION INFO -->

        <!-- CONTACT INFO -->
        <div class="my-card contact">
            <div class="header">
                <h3> @lang('profile.about.contact.title') </h3>
            </div>
            <div class="body">

                <div>
                    @include('user.profile.edit-icon', ['name' => 'location'])
                    <div class="grid">
                        <img src="{{ icon('placeholder', 'svg') }}" alt="" class="svg">
                        <h3 class="title"> @lang('profile.about.contact.location') </h3>
                        <span data-updatable="location"> {{ $user->location }}  </span>
                    </div>
                    @if($user->id == auth()->id())
                    <div class="editing" data-editable="location">
                        <form method="POST" class="location" action="{{ route('user.profile.update') }}">
                            <div>
                                <input type="text" class="form-control edit-input" name="country" value="{{ $user->country }}" placeholder="@lang('profile.placeholder.country')">
                                <input type="text" class="form-control edit-input" name="city" value="{{ $user->city }}" placeholder="@lang('profile.placeholder.city')">
                            </div>
                            <button type="submit" class="btn save"> <img src="{{ icon('save', 'svg') }}" alt="" class="svg"> </button>
                            <button type="button" class="btn cancel"> <img src="{{ icon('close', 'svg') }}" alt="" class="svg"> </button>
                        </form>
                    </div>
                    @endif
                </div>

                <div>
                    @include('user.profile.edit-icon', ['name' => 'email'])
                    <div class="grid">
                        <img src="{{ icon('email', 'svg') }}" alt="" class="svg">
                        <h3 class="title"> @lang('profile.about.contact.email') </h3>
                        <span data-updatable="email"> {{ $user->email }}  </span>
                    </div>
                    @include('user.profile.edit', ['name' => 'email'])
                </div>

                <div>
                    @include('user.profile.edit-icon', ['name' => 'phone_number'])
                    <div class="grid">
                        <img src="{{ icon('phone', 'svg') }}" alt="" class="svg">
                        <h3 class="title"> @lang('profile.about.contact.phone') </h3>
                        <span data-updatable="phone_number"> {{ $user->phone_number }}  </span>
                    </div>
                    @include('user.profile.edit', ['name' => 'phone_number'])
                </div>

                <div>
                    @include('user.profile.edit-icon', ['name' => 'facebook_account'])
                    <div class="grid">
                        <img src="{{ icon('facebook', 'svg') }}" alt="" class="svg">
                        <h3 class="title"> @lang('profile.about.contact.facebook') </h3>
                        <span data-updatable="facebook_account"> {{ $user->facebook_account }}  </span>
                    </div>
                    @include('user.profile.edit', ['name' => 'facebook_account'])
                </div>

                <div>
                    @include('user.profile.edit-icon', ['name' => 'youtube_account'])
                    <div class="grid">
                        <img src="{{ icon('youtube', 'svg') }}" alt="" class="svg">
                        <h3 class="title"> @lang('profile.about.contact.youtube') </h3>
                        <span data-updatable="youtube_account"> {{ $user->youtube_account }}  </span>
                    </div>
                    @include('user.profile.edit', ['name' => 'youtube_account'])
                </div>

                <div>
                    @include('user.profile.edit-icon', ['name' => 'twitter_account'])
                    <div class="grid">
                        <img src="{{ icon('twitter', 'svg') }}" alt="" class="svg">
                        <h3 class="title"> @lang('profile.about.contact.twitter') </h3>
                        <span data-updatable="twitter_account"> {{ $user->twitter_account }}  </span>
                    </div>
                    @include('user.profile.edit', ['name' => 'twitter_account'])
                </div>

                {{--  <button id="message-btn" class="btn btn__primary">
                    <img src="{{ icon('message', 'svg') }}" alt="" class="svg">
                </button>  --}}
            </div>
        </div>
        <!-- CONTACT INFO -->

    </div>
</div>
