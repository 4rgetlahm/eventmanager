<!DOCTYPE HTML>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE_edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    <link href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>


    <!--ICONS !-->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- ICONS END !-->

    {!! htmlScriptTagJsApi() !!}
    <title>Renginių platforma</title>
  </head>
  <body>
    <nav class="navbar navbar-dark" style="background-color: #686868;">
          <div class="container-fluid">
            <div class="navbar-header">
                <div class="mobile">
                    <a class="navbar-brand" href="/" style="color: #FFFFFF;"><img src="{{asset('img/logo.png')}}"></a>
                </div>
            </div>
            @if(!(Auth::guest()))
              <form class="form-inline">
                <div class="mobile">
                    @if(\Auth::user()->role > 0)
                        <a style="margin-right: 10px" class="btn btn-outline-light my-2 my-sm-0" href="{{url('dashboard')}}">Administravimas</a>
                    @endif
                    <a class="btn btn-outline-light my-2 my-sm-0" href="{{url('logout')}}">Atsijungti</a>
                </div>
              </form>
            @else

                @include('modals.login_modal')

            <form class="form-inline">
                <div class="mobile">
                    <button type="button" class="btn btn-outline-light my-2 my-sm-0 float-right" onclick="login();">Prisijungti</button>
                </div>
            </form>
            @endif
        </div>
    </nav>
    <div class="container-fluid">
        <div class="container">
            @yield('content')
        </div>
    </div>
<!-- footer-->
    <div id="copyright">
      <div class="container">
        <hr class="my-4">
        <p style="text-align: center; color: #8a8a8a;">© 2020 renginiai.it All Rights Reserved</p>
      </div>
    </div>
  </body>

</html>
