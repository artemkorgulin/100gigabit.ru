<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--<!-- CSRF Token -->--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    {{--<!-- Styles -->--}}
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <div class="nav-wrapper">
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="https://laravel.com/docs">Documentation</a></li>
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Авторизация</a></li>
                        <li><a href="{{ url('/register') }}">Регистрация</a></li>
                    @else
                        <li><a href="/home/#">Личные данные</a></li>
                        <li>
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Выйти
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        <li>
                            <!-- Branding Image -->
                            <a class="navbar-brand" href="{{ url('/') }}">
                                {{ config('app.name', 'Главная страница') }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="center-align">
                <h1>
                    Laravel 5.3
                </h1>

                <i class="material-icons small grey-text text-darken-2">tag_faces</i>
            </div>

            <div class="row">
                <div class="col s12 m6 offset-m3">
                    <example></example>
                </div>
            </div>
        </div>
    </main>

    <footer class="page-footer">
      <div class="container">
        <div class="row">
          <div class="col l6 s12">
            <h5 class="white-text">Footer Content</h5>
            <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
          </div>
          <div class="col l4 offset-l2 s12">
              <h5 class="white-text">Links</h5>
              <ul>
                <li><a class="grey-text text-lighten-3" href="https://laravel.com/docs">Documentation</a></li>
                <li><a class="grey-text text-lighten-3" href="https://laracasts.com">Laracasts</a></li>
                <li><a class="grey-text text-lighten-3" href="https://laravel-news.com">News</a></li>
                <li><a class="grey-text text-lighten-3" href="https://forge.laravel.com">Forge</a></li>
                <li><a class="grey-text text-lighten-3" href="https://github.com/laravel/laravel">GitHub</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="footer-copyright">
        <div class="container">
          © {{ Carbon\Carbon::now()->format('Y') }} Copyright Text
          <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
        </div>
      </div>
    </footer>

{{--<!-- JavaScripts -->--}}
<script src="{{ elixir('js/app.js') }}"></script>
</body>
</html>
