<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset( 'fontawesome-free-6.4.0-web/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('fontawesome-free-6.4.0-web/css/fonts/boxicons.css') }}">
  @vite('resources/css/app.css')
  <link rel="icon" href="{{asset( 'images/Logo-MEH.ico') }}" type="image/x-icon">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>


</head>
<body class="" >
    <header>
    {{ view('visiteur.navbar') }}
  </header>
  <div class="" >
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
