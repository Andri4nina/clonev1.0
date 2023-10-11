    <header class="fixed top-0 w-full z-10">
        <div class="relative h-20 w-full publicnavbar">
          <ul class="m-0 p-0 inline-block float-right pr-20 pt-5 nav">
            <li class="list-none inline-block text-lg p-1 font-light mr-5 item">
              <a class="text-decoration-none text-inherit" href="{{ route('public.acceuil') }}">Actualite</a>
            </li>
            <li class="list-none inline-block text-lg p-1 font-light mr-5 item">
                <a class="text-decoration-none text-inherit" href="{{ route('public.domain') }}">Domaine d'intervention</a>
            </li>
            <li class="list-none inline-block text-lg p-1 font-light mr-5 item">
                <a class="text-decoration-none text-inherit" href="{{ route('public.project') }}">Nos projects</a>
            </li>
            <li class="list-none inline-block text-lg p-1 font-light mr-5 item">
                <a class="text-decoration-none text-inherit" href="{{ route('public.about') }}">A propos</a>
            </li>
            <li class="list-none inline-block text-lg p-1 font-light mr-5 item">
                <a class="text-decoration-none text-inherit" href="{{ route('public.don') }}">Don et soutien</a>
            </li>
        
          </ul>
  
          <div class="float-left inline-block mt-2 ml-5 w-16 h-16 bg-red-500 logo">
            <img src="#">
          </div>
        </div>
      </header>

      <script>
        $(document).ready(function() {
            $(window).on('scroll', function() {
                if (Math.round($(window).scrollTop()) > 100) {
                $('.publicnavbar').addClass('scrolled');
                } else {
                $('.publicnavbar').removeClass('scrolled');
                }
            });
            });
      </script>
