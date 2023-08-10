<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset( 'fontawesome-free-6.4.0-web/css/all.min.css') }}">
  <link rel="icon" href="{{asset( 'images/Logo-MEH.ico') }}" type="image/x-icon">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  
  @vite('resources/css/app.css','resources/js/app.js')



</head>


    <body class="{{\Illuminate\Support\Facades\Auth::user()->mode_user }} {{\Illuminate\Support\Facades\Auth::user()->theme_user }} min-h-screen">    
      <header>
        {{ view('layouts.navbar') }}
      </header>
      @yield('content')
    </body>

    <footer class="my-48 w-full max-w-4xl mx-auto"
      {{ view('layouts.footer') }}
    </footer>
</html>