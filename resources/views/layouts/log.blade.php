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
    <body class="min-h-screen">   
      @yield('content')
    </body>
</html>