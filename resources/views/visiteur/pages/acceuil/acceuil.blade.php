@extends('welcome')

@section('content')
<section class="public-section">
    <div class="overflow-x-hidden w-full flex flex-col gap-5 lg:flex-row">
        <div class="mx-0 lg:mx-5 mb-5 w-full lg:w-1/4 ">
            <h2 class="mb-5">Nos partenaires</h2>
            <div class="w-full  overflow-x-scroll lg:overflow-x-visible  ">
                <div class="min-w-fit lg:w-auto gap-2 flex flex-nowrap lg:flex-wrap">
                    @if(count($partenaires) > 0)
                        @foreach ($partenaires as $partenaire)
                        <div class="bounceslideInFromLeft  mt-32 mx-auto w-80 max-w-sm text-center px-5 py-20 rounded-xl relative  partenaire-card">
                            <h3>{{ $partenaire->nom_partenaire }}</h3>
                            <br>
                            <h4>{{ $partenaire->abbrev_partenaire }}</h4>
                            <br>
                            <div class="overflow-hidden h-20 partenaire-collapse">
                                <p class="overflow-y-scroll h-full">
                                    {!! $partenaire->histoire_partenaire !!}
                                </p>
                            </div>
                            <br>

                            <a class="absolute  left-1/2 -translate-x-1/2" href="{{ $partenaire->siteOff_partenaire }}">
                                <button>
                                    Visiter
                                </button>
                            </a>

                            <div class="overflow-hidden w-40 h-40 rounded-xl absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2">
                                <img src="{{ asset('images/pdp-partenaire/'.$partenaire->logo_partenaire) }}" alt="" class="object-contain w-full h-full">
                            </div>
                        </div>


                        @endforeach

                    @else
                        <p>Aucune partenaire n'est disponible pour le moment.</p>
                    @endif
                </div>
            </div>
            <div class="w-full my-5 flex justify-center">
                <a href="{{ route('public.partenaire') }}" class="text-blue-500 hover:text-blue-600 hover:font-semibold text-right">Tous voir <i class="bx bx-chevron-right"></i></a>
            </div>


        </div>
        <div class=" mx-0 lg:mx-5 w-full lg:w-2/4 ">
            <h2 class="mb-5">Nos Activites</h2>
            @if(count($blogs) > 0)
                @foreach ($blogs as $blog)
                <a href="{{ route('public.comment', $blog->id ) }}">
                    <div class="bounceslideInFromRight relative max-w-5xl w-full mb-10 rounded-lg text-lg overflow-hidden cursor-pointer Blogcard">
                        <div class="absolute top-0 left-0 right-0 bottom-0">
                            <img class="absolute top-0 left-0 blog-img nophotocouv" src="{{ asset('images/couv-blog/'.$blog->couv_blog )}}" >
                            <div class="absolute blog-textbox">
                                <div class="blog-title">{{ $blog->titre_blog }}</div>
                                <div class="blog-subtitle">{{ $blog->sous_titre_blog }}</div>
                                <div class="blog-bar"></div>
                                <div class="blog-description">{!! $blog->contenu_blog !!}</div>
                                <div class="blog-tagbox">
                                    <span class="blog-tag">{{ $blog->date_publi_blog }} </span>
                                    <span class="blog-tag">0 Commentaire(s)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                @endforeach
            @else
                <p>Aucun blog n'est disponible pour le moment.</p>
            @endif




        </div>

        <div class="mx-0 lg:mx-5 w-full lg:w-1/4">
            <h2 class="my-5">A propos</h2>
            <div class="w-full h-40">
                <img src="{{ asset('images/component/image/logo.jpg') }}" alt="Logo" class="w-full h-full object-fill">

            </div>
            <p>
                Depuis ses humbles débuts, notre organisation non gouvernementale a tracé un chemin exceptionnel dans la réalisation de son engagement envers le progrès social. Fondée en [année de création], notre ONG a émergé de la vision commune de quelques individus passionnés, résolus à faire une différence significative dans le monde.
                Notre histoire commence avec la reconnaissance d'un besoin pressant au sein de notre communauté et au-delà. Nous avons constaté des défis, des inégalités et des opportunités non exploitées qui nécessitaient une réponse collective. Animés par une conviction profonde, nous avons rassemblé des esprits compatissants et des compétences diverses pour créer une organisation qui deviendrait le catalyseur du changement positif.
            </p>
            <div class="w-full text-center my-5 ">
                <a href="{{ route('public.about') }}" class="hover:text-blue-600 hover:font-semibold text-blue-500 text-right">Plus de details <i class="bx bx-chevron-right"></i></a>

            </div>

        </div>
    </div>
</section>



@endsection
