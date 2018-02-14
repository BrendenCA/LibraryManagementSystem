<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #375064;">
  <div class="container">
      <a class="navbar-brand" href="/">
        <img src="/logo.svg" width="30" height="30" class="d-inline-block align-top" alt="">
        {{ config('app.name', 'Laravel') }}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-navbar-collapse" aria-controls="app-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

    <div class="collapse navbar-collapse" id="app-navbar-collapse">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li><a class="nav-item nav-link" href="/search">Search</a></li>
        <li><a class="nav-item nav-link" href="/catalog">Catalog</a></li>
        <li><a class="nav-item nav-link" href="/author">Author</a></li>
        <li><a class="nav-item nav-link" href="/genre">Genre</a></li>
      </ul>

      <ul class="nav navbar-nav my-2 my-lg-0">
        @guest
          <li><a class="nav-item nav-link" href="{{ route('login') }}">Login</a></li>
          <li><a class="nav-item nav-link" href="{{ route('register') }}">Register</a></li>
        @else
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Logout
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </li>
          </ul>
        </li>
      @endguest
    </ul>
  </div>
</div>
</nav>
