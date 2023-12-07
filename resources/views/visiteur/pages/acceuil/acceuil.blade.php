@extends('welcome')

@section('content')
<div class=" flex flex-col md:flex-row">
    <div class="mx-5 w-1/4 ">
        <h2 class="mb-5">Nos partenaires</h2>
        @if(count($partenaires) > 0)
            @foreach ($partenaires as $partenaire)
            <div class="bounceslideInFromLeft mt-20 mx-auto max-w-sm text-center px-5 py-20 rounded-xl relative  partenaire-card">
                <h3>{{ $partenaire->nom_partenaire }}</h3>
                <br>
                <h4>{{ $partenaire->abbrev_partenaire }}</h4>
                <br>
                <div class="overflow-hidden h-20 partenaire-collapse">
                    <p>
                        {{ $partenaire->histoire_partenaire }}
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
            <a href="#" class="text-center">Tous voir</a>
        @else
            <p>Aucune partenaire n'est disponible pour le moment.</p>
        @endif

    </div>
    <div class="mx-5 w-2/4 ">
        <h2 class="mb-5">Nos Activites</h2>
        @if(count($blogs) > 0)
            @foreach ($blogs as $blog)
            <a href="{{ route('public.comment', $blog->id ) }}">
                <div class="bounceslideInFromRight relative max-w-5xl w-full mb-10 rounded-lg text-lg overflow-hidden cursor-pointer Blogcard">
                    <div class="absolute top-0 left-0 right-0 bottom-0">
                        <img class="absolute top-0 left-0 blog-img" src="{{ asset('images/couv-blog/'.$blog->couv_blog )}}" >
                        <div class="absolute blog-textbox">
                            <div class="blog-title">{{ $blog->titre_blog }}</div>
                            <div class="blog-subtitle">{{ $blog->sous_titre_blog }}</div>
                            <div class="blog-bar"></div>
                            <div class="blog-description">{{ $blog->contenu_blog }}</div>
                            <div class="blog-tagbox">
                                <span class="blog-tag">{{ $blog->date_publi_blog }} </span>
                                <span class="blog-tag"> {{ $blog->comment_count }} Commentaire(s)</span>
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
    <div class="mx-5 w-1/4">
        <h2 class="mb-5">A propos</h2>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo, maxime doloribus numquam illo odit totam, omnis id minima voluptate possimus rem dolores exercitationem similique modi dignissimos. Voluptatem fugiat reprehenderit assumenda.
        </p>
    </div>
</div>


@endsection