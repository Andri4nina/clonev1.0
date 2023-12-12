<nav class=" fixed top-0 left-0  w-full navpublic">
    <div class=" h-20  absolute top-0 left-0 public_logo">
        <a href="">
            <div class="flex justify-between items-center">
                <div class="w-14">
                    <img src="{{ asset('images/component/image/logo_court.png') }}" alt="" class="w-full">
                </div>
                <div>
                   Hope For future Madagascar
                </div>
            </div>
        </a>


    </div>


    <ul class=" mx-auto flex justify-end gap-2 items-center" id="publicaside">
        <div class=" w-full h-20  top-0 left-0">
            <div class="flex justify-around items-center">
                <div class="w-14">
                    <img src="{{ asset('images/component/image/logo_court.png') }}" alt="" class="w-full">
                </div>
                <div>
                   Hope For future Madagascar
                </div>
            </div>

        </div>

        <li class="nav-item-public active"><a href="{{ route('public.acceuil') }}"><i></i>Acceuil</a></li>
        <li class="nav-item-public"><a href="{{ route('public.blog_reportage') }}"><i></i>Blogs & Reportages</a></li>
        <li class="nav-item-public"><a href="{{ route('public.domain') }}"><i></i>Domaine d'intervention</a></li>
        <li class="nav-item-public"><a href="{{ route('public.project') }}"><i></i>Nos project</a></li>
        <li class="nav-item-public"><a href="{{ route('public.partenaire') }}"><i></i>Nos partenaires</a></li>
        <li class="nav-item-public"><a href="{{ route('public.don') }}"><i></i>Don et Soutien</a></li>
        <li class="nav-item-public"><a href="{{ route('public.about') }}"><i></i>A propos</a></li>

    </ul>
    <div class="absolute -translate-y-5 h-8  publicmenufritepos  cursor-pointer "  onclick="showhidemenupublic() ">
        <div class="publicmenuFrite translate-y-5" >

        </div>
    </div>
</nav>


<header class="top-0 left-0 h-screen" id="publicBody">
    <div class="overflow-hidden container_public">
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
        <div class="flex justify-center gap-4 w-full buttons">
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

<script>
function moveElement() {
    let lists = document.querySelectorAll('.item');
    document.getElementById('slide').appendChild(lists[0]);
}
moveElement();
setInterval(moveElement, 7000);

</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const Publicbody = document.querySelector('#publicBody');
        document.addEventListener('scroll', function() {
            var rect = Publicbody.getBoundingClientRect();
            var topSection = rect.top;
            if(topSection<=-5 && topSection>=-150){
                document.querySelector('.navpublic').classList.add('hidenavpublic')
            }else if(topSection< -150){
                document.querySelector('.navpublic').classList.remove('hidenavpublic')
                document.querySelector('.navpublic').classList.add('bgnavpublic')
            }
            else{
                document.querySelector('.navpublic').classList.remove('hidenavpublic')
                document.querySelector('.navpublic').classList.remove('bgnavpublic')
            }
        });
    });
</script>

<script>
    const publicaside = document.querySelector('#publicaside');
    const publicmenuFrite = document.querySelector('.publicmenuFrite');
    const publicmenuPosition = document.querySelector('.publicmenufritepos');


    function showhidemenupublic(){
        publicaside.classList.toggle('active');
        publicmenuFrite.classList.toggle('active');
        publicmenuPosition.classList.toggle('active');
    }
</script>


















