<aside class="sidebar">
    <button class="btn btn-icon notification-btn" id="">
        <img src="{{ icon('notification', 'svg') }}" alt="Notification" class="svg">
    </button>

    <div class="avatar">
        <div class="shadow" style="background-image: url('{{ auth()->user()->avatar }}')"></div>
    </div>

    <div class="info">
        <h3 class="name"> Ahmed Ali </h3>
        <p class="shool"> Al-Jazera School </p>
        <p class="grade"> Grade 5 </p>
    </div>

    <ul class="links">
        <li>
            <a href="{{ route('user.rounds.index') }}" class="btn"> Rounds </a>
        </li>
        <li>
            <a href="{{ route('user.friends.index') }}" class="btn"> Friends </a>
        </li>
        <li>
            <a href="{{ route('user.community.index') }}" class="btn"> Community </a>
        </li>
    </ul>

    <ul class="footer">
        <li>
            <a href="{{ route('user.rounds.index') }}" class="btn btn-link"> Help </a>
        </li>
        <li>
            <a href="{{ route('user.logout') }}" class="btn btn-link"> Logout </a>
        </li>
    </ul>
</aside>
