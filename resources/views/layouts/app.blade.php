<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Assessment</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script>
    <script type='text/javascript' src='public/js/jquery.ba-hashchange.min.js'></script>
    <script type='text/javascript' src='public/js/dynamicpage.js'></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        Assessment
                    </a>

                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                      @can('view_roles')
                      <li class="{{ Request::is('roles*') ? 'active' : '' }}">
                        <a href="{{ route('roles.index') }}">
                          <span class="text-danger"></span> Roles Management
                        </a>
                      </li>
                      @endcan
                      @can('view_questionnaire')
                      <li class="{{ Request::is('roles*') ? 'active' : '' }}">
                        <a href="{{ route('questionnaire.index') }}">
                          <span class="text-danger"></span> Questionnaire Management
                        </a>
                      </li>
                      @endcan
                      @can('view_data_stored')
                      <li class="{{ Request::is('roles*') ? 'active' : '' }}">
                        <a href="{{ route('data_stored.index') }}">
                          <span class="text-danger"></span> Score stored
                        </a>
                      </li>
                      @endcan
                      @can('view_data_stored_comment')
                      <li class="{{ Request::is('roles*') ? 'active' : '' }}">
                        <a href="{{ route('data_stored_comment.index') }}">
                          <span class="text-danger"></span> Comment stored
                        </a>
                      </li>
                      @endcan


                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                  <li class="{{ Request::is('roles*') ? 'active' : '' }}">
                                    <a href="{{ route('users.edit', Auth::id()) }}">
                                      <span class="text-danger"></span> Update profile
                                    </a>
                                  </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
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
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container form-container">
                      <div id="flash-msg">
                          @include('flash::message')
                      </div>
                    @yield('content')
                  </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(function () {
            // flash auto hide
            $('#flash-msg .alert').not('.alert-danger, .alert-important').delay(6000).slideUp(500);
        })
    </script>
</body>
</html>
