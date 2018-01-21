<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="{{route('home.index')}}">Marketplace</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('advertisements.index')}}">Advertisements<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('profile.index')}}">Profile</a>
            </li>
        </ul>
        <ul class="navbar-nav login">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
            @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
            @endguest
        </ul>
        @guest
            @else
        <form class="form-inline my-2 my-lg-0" action="{{route('advertisements.search')}}" method="get">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" id="key" name="key" aria-label="Search">
            <button class="btn my-2 my-sm-0" type="submit">Search</button>
        </form>
            @endguest
    </div>
</nav>

