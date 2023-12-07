<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset( 'fontawesome-free-6.4.0-web/css/all.min.css') }}">
 {{--   <link rel="icon" href="{{asset( 'images/Logo-MEH.ico') }}" type="image/x-icon">  --}}
  <link rel="stylesheet" href="{{ asset('fontawesome-free-6.4.0-web/css/fonts/boxicons.css') }}"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" ></script>

  @vite('resources/css/app.css','resources/js/app.js')
  <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
  <script src="https://cdn.jsdelivr.net/npm/chart.js" ></script>

</head>
   <body class=" min-h-screen">


    <body class="min-h-screen">
      <header class="relative z-30">
        {{ view('layouts.navbar') }}
      </header>
      <section class="z-0">
        @yield('content')
      </section>

{{--


    <footer class="">
      {{ view('layouts.footer') }}
    </footer>
  --}}

    <script>
          // Récupérer les valeurs mode_user et theme_user
          const modeUser = "{{ \Illuminate\Support\Facades\Auth::user()->mode_user }}";
          const themeUser = "{{ \Illuminate\Support\Facades\Auth::user()->theme_user }}";

          // Stocker les valeurs dans le localStorage
          localStorage.setItem('mode_user', modeUser);
          localStorage.setItem('theme_user', themeUser);
      </script>
      <script>

        window.addEventListener('DOMContentLoaded', () => {
          const mode = document.querySelector('.mode');
          const modeIcon = document.querySelector('.mode i');


          const storedMode = localStorage.getItem('mode_user');
          const storedTheme = localStorage.getItem('theme_user');


          document.body.classList.add(storedTheme);

          if (storedMode === 'dark') {
            document.body.classList.add('dark');
            modeIcon.classList.add('bx-moon');
            modeIcon.classList.remove('bx-sun');
            modeIcon.classList.add('text-blue-600');
            modeIcon.classList.remove('text-yellow-400');
          } else {
            modeIcon.classList.add('bx-sun');
            modeIcon.classList.remove('bx-moon');
            modeIcon.classList.remove('text-blue-600');
            modeIcon.classList.add('text-yellow-400');
          }


        });
      </script>

    </body>



</html>
