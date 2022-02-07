<header id="app">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <div class="row">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="navbar-brand" href="{{ route('home') }}">Vai al sito</a>
                        </li>
                        @auth()
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('admin.index')}}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.posts.index')}}">Elenco Post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.posts.create')}}">Crea nuovo post</a>
                        </li>
                        @endauth
                    </ul>
                </div>
                <div>
                    @auth
                        <div class="navbar-nav">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    @endauth
                    @guest
                    <div class="navbar-nav">
                        <a class="nav-link" href="{{ route('login')}}">Login</a>
                        <a class="nav-link" href="{{ route('register')}}">Register</a>
                    </div>
                    @endguest
                </div>
            </div>
      </nav>
</header>