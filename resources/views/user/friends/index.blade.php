@extends('user.layout')

@section('content')
<section class="container">
    <div class="row active-with-click">

        @foreach($user->friends as $friend)
        <div class="col-md-4 col-sm-6 col-xs-12">
            <article class="material-card Red">
                <h2>
                    <span> {{ $friend->name }} </span>
                    <strong>
                        <i class="fas fa-fw fa-star"></i>
                        {{ $friend->email }}
                    </strong>
                </h2>
                <div class="mc-content">
                    <div class="img-container">
                        <img class="img-responsive" src="{{ $friend->avatar }}">
                    </div>
                    <div class="mc-description">
                        <form action="{{ route('user.friends.destroy', $friend) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"> Unfriend </button>
                        </form>
                    </div>
                </div>
                <a class="mc-btn-action">
                    <i class="fas fa-bars"></i>
                </a>
                <div class="mc-footer">
                    <h4>
                        Social
                    </h4>
                    <a class="fab fa-fw fa-facebook"></a>
                    <a class="fab fa-fw fa-twitter"></a>
                    <a class="fab fa-fw fa-linkedin"></a>
                </div>
            </article>
        </div>
        @endforeach
    </div>
</section>

@endsection

@push('css')
    {!! css('user/pages/friends') !!}
@endpush

@push('js')
    {!! js('user/pages/friends') !!}
@endpush
