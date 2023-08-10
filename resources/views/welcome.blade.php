<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ 'fontawesome-free-6.4.0-web/css/all.min.css' }}">
  @vite('resources/css/app.css')
  <link rel="icon" href="{{asset( 'images/Logo-MEH.ico') }}" type="image/x-icon">
</head>
<body class="dark">
  <header>
    {{ view('visiteur.navbar') }}
  </header>
  <div class="mt-32">
    @yield('content')
  </div>
  <div class="absolute">
    {{ view('visiteur.themeMode') }}
  </div>
  <footer>
    {{ view('visiteur.footer') }}
  </footer>
</body>
</html>