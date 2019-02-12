<div class="tab-content">
    @include('user.profile.about')
    @includeWhen($user->id == auth()->id(), 'user.profile.settings')
    @includeWhen(auth()->check() && $user->id != auth()->id() && count($user->behaviors), 'user.profile.reflections')
</div>
