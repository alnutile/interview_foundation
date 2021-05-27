<div class="flex-center position-ref">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
            @else
                @if(!request()->routeIs('login'))
                    <a href="{{ route('login') }}">Login</a>
                @endif
                @if (!request()->routeIs('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif
</div>
