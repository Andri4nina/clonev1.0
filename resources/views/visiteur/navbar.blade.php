<nav class="fixed top-0 left-0  w-full navpublic">
    <ul class="max-w-7xl mx-auto flex justify-around gap-2 items-center">
        <li class="nav-item-public active"><a href="{{ route('public.acceuil') }}"><i></i>Acceuil</a></li>
        <li class="nav-item-public"><a href="{{ route('public.blog_reportage') }}"><i></i>Blogs & Reportages</a></li>
        <li class="nav-item-public"><a href="{{ route('public.domain') }}"><i></i>Domaine d'intervention</a></li>
        <li class="nav-item-public"><a href="{{ route('public.project') }}"><i></i>Nos project</a></li>
        <li class="nav-item-public"><a href="{{ route('public.partenaire') }}"><i></i>Nos partenaires</a></li>
        <li class="nav-item-public"><a href="{{ route('public.don') }}"><i></i>Don et Soutien</a></li>
        <li class="nav-item-public"><a href="{{ route('public.about') }}"><i></i>A propos</a></li>
    </ul>
</nav>


<header class="h-screen">
    <div class="container_public">
        <div id="slide">
            <div class="item" style="background-image: url({{ asset('images/component/image/couverture1.jpg') }});">
                <div class="content">
                    <div class="name">Enfants</div>
                    <div class="des">Les enfants sont l'avenir de notre pays</div>
                </div>
            </div>
            <div class="item" style="background-image: url(4.jpg);">
                <div class="content">
                    <div class="name">Environnement</div>
                    <div class="des">Notre environnement est en danger , il faut la sauver</div>
                </div>
            </div>
            <div class="item" style="background-image: url(3.jpg);">
                <div class="content">
                    <div class="name">Femme</div>
                    <div class="des">Le bien etre la femme est aussi une mission importante</div>
                </div>
            </div>
            <div class="item" style="background-image: url(4.jpg);">
                <div class="content">
                    <div class="name">Education</div>
                    <div class="des">L'education est un pilier du developpement</div>
                </div>
            </div>
            <div class="item" style="background-image: url(5.jpg);">
                <div class="content">
                    <div class="name">Benevolat</div>
                    <div class="des"></div>
                   
                </div>
            </div>
            <div class="item" style="background-image:url({{ asset('images/component/image/logo.jpg') }});">
                <div class="content">
                    <div class="name">Hope For a Future Madagascar </div>
                    <div class="des"></div>
                </div>
            </div>
        </div>
        <div class="buttons">
            <button id="prev"><i class="fa-solid fa-angle-left"></i></button>
            <button id="next"><i class="fa-solid fa-angle-right"></i></button>
        </div>
    </div>

</header>






<script>
    document.getElementById('next').onclick = function(){
        let lists = document.querySelectorAll('.item');
        document.getElementById('slide').appendChild(lists[0]);
    }
    document.getElementById('prev').onclick = function(){
        let lists = document.querySelectorAll('.item');
        document.getElementById('slide').prepend(lists[lists.length - 1]);
    }
      
</script>






















{{--      <header class="fixed top-0 w-full z-10">
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
  --}}
