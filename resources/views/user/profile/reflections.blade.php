<div class="tab-pane fade" id="reflections" role="tabpanel" aria-labelledby="reflections-tab">
    <div id="reflections-wrapper">
        <div class="my-card basic">
            <div class="header">
                <h3> @lang('profile.reflections.title') </h3>
            </div>
            <div class="body">
                <div class="reflections shadow-lg p-3">

                    <form method="POST" action="{{ route('learner.reflections.store', $user) }}">
                        @csrf
                        <div class="form-group">
                        <label for="behavior"> @lang('profile.reflections.choose') </label>
                        <select data-placeholder="@lang('profile.reflections.choose')" name="behavior_id" id="behavior">
                            @foreach ($user->behaviors as $behavior)
                            <option value="{{ $behavior->id }}"> {{ $behavior->description }} </option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control input__outline__primary" placeholder='@lang("profile.placeholder.reflection")' name="text">
                        </div>

                        <button class="btn btn__primary"> @lang('profile.reflections.add') </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
