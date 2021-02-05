<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet"/>
    @stack('styles')
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    @stack('scripts')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            @if (!Auth::guest())
            <style>
                .name-auth {
                    padding-left:10px;
                }
            </style>
            <ul id="nav-mobile" class="left name-auth">
                <li>
                    Вы вошли под именем: <b>{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}</b>
                </li>
            </ul>
            @endif
            <div class="container">
                <div class="navbar-header nav-wrapper">
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Авторизация</a></li>
                            <li><a href="{{ url('/register') }}">Регистрация</a></li>
                            <li><!-- Branding Image -->
                                <a class="navbar-brand" href="{{ url('/') }}">
                                    {{ config('app.name', 'Главная страница') }}
                                </a>
                            </li>
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

                    <!-- Collapsed Hamburger -->
                    <!--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Личные данные</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>-->


                </div>
            </div>
        </nav>

        <div class="row">

            @if (!Auth::guest())
            <div class="col s12 m4 l3">
                <div class="collection">
                    <a href="/users/" class="collection-item users"><?$usersNew=App\User::where('created_at', '>=', date('Y-m-d').' 00:00:00')->paginate(); $totalcount = $usersNew->total(); if($totalcount>0):?><span class="new badge"><?echo $totalcount; ?></span><?endif;?><span class="badge col s11"><? $users=App\User::paginate(); echo $users->total();?></span>Пользователи</a>
                    <a href="/permissions/" class="collection-item permissions"><?$permissionNew=App\Models\Permission::where('created_at', '>=', date('Y-m-d').' 00:00:00')->paginate(); $totalcountp = $permissionNew->total(); if($totalcountp>0):?><span class="new badge"><?echo $totalcountp; ?></span><?endif;?><span class="badge col s11"><? $permissions=App\Models\Permission::paginate(); echo $permissions->total();?></span>Права для пользователей</a>
                    <a href="/orders/" class="collection-item orders"><?$ordersNew=App\Orders::where('created_at', '>=', date('Y-m-d').' 00:00:00')->paginate(); $totalcounto = $ordersNew->total(); if($totalcounto>0):?><span class="new badge"><?echo $totalcounto; ?></span><?endif;?><span class="badge col s11"><? $orders=App\Orders::paginate(); echo $orders->total();?></span>Заказы</a>
                    <a href="/statuses/" class="collection-item statuses">Статусы заказа</a>
                    <a href="/goods/" class="collection-item goods">Товары</a>
                    <a href="/services/" class="collection-item services">Услуги</a>
                    <a href="/additional/" class="collection-item additional">Сервисы</a>
                </div>
            </div>
            @endif
            <div class="col s12 m12 l9">
                <div class="col s12 m12 l0 left">
                    @yield('content')
                </div>
            </div>

        </div>



    </div>
    
    <!-- Scripts -->
    <script src="/js/app.js"></script>

    <!-- Modal -->
    <div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-action modal-close waves-effect waves-green btn-flat right" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Добавить параметр</h4>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control paramenter_modal" name="parameter" placeholder="Наименование параметра"/><br>
                    <input type="text" class="form-control unit_modal" name="unit" placeholder="Единица измерения"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default modal-action modal-close waves-effect waves-green btn-flat" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary modal-action modal-close waves-effect waves-green btn-flat save_and_close">Сохранить изменения</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

</body>
</html>
