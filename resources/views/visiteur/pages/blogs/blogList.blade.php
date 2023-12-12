@extends('welcome')

@section('content')
<section class=" public-section">
    <form action="{{ route('public.blog_reportage') }}" class="my-5">
        <div class="flex justify-center items-center relative">
            <button class="w-2/12 text-center btn-search"><span class="hidden sm:block">Rechercher</span>  <i class="block sm:hidden bx bx-search"></i></button>
            <input class="w-10/12" type="text" name="search" placeholder="Chercher un blog">
            <button class="absolute right-2 hidden sm:block">
                <i class="bx bx-search "></i>
            </button>
        </div>
    </form>

    <div class="relative w-full blog_reportage_container">
        <h2 class="text-2xl my-5 font-semibold">Blogs</h2>
        <div class="flex flex-wrap md:flex-nowrap">
            @if(count($blogs) > 0)
                @foreach ($blogs as $blog)
                    <a href="{{ route('public.comment', $blog->id ) }}" class="mx-2 w-full md:w-1/2 xl:w-1/4">
                        <div class="bounceslideInFromRightbg-red-500 relative max-w-5xl w-full mb-10 rounded-lg text-lg overflow-hidden cursor-pointer Blogcard list">
                            <div class=" absolute top-0 left-0 right-0 bottom-0">
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
            <p class="text-center">Aucun blog n'est disponible pour le moment ou aucun blog ne correspond pas a votre recherche.</p>
        @endif

        </div>
    </div>

    <div class="relative w-full blog_reportage_container">
        <h2 class="text-2xl my-5 font-semibold">Reportages</h2>

        <div class="flex flex-wrap md:flex-nowrap">
                @if(count($reportages) > 0)
                    @foreach ($reportages as $blog)
                        <a href="{{ route('public.comment', $blog->id ) }}" class="mx-2 w-full md:w-1/2 xl:w-1/4">
                            <div class="bounceslideInFromRightbg-red-500 relative max-w-5xl w-full mb-10 rounded-lg text-lg overflow-hidden cursor-pointer Blogcard list">
                                <div class=" absolute top-0 left-0 right-0 bottom-0">
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
                    <p class="text-center">Aucune reportages n'est disponible pour le moment ou aucune reportage ne correspond pas a votre recherche.</p>
                @endif

        </div>
    </div>
</section>
@endsection
