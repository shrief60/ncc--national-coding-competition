@if($user->id == auth()->id())
<img editable="{{ $name }}" src="{{ icon('pen', 'svg') }}" alt="" class="svg edit">
@endif
