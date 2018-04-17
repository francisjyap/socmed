<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SOCMED - @yield('title')</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-table.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome-all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-table.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>


  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">SOCMED Tracker</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            @guest
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('register') }}">Register
                <span class="sr-only">(current)</span>
              </a>
            </li>
            @else
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('home') }}">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                 {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
      @yield('content')
    </div>
    <!-- /.container -->
  </body>

</html>