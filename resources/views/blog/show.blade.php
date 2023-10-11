@extends('layouts.app')

@section('content')
<section class=" block w-10/12 mx-auto ">
    <div class="relative usersection">
        <h3 class="text-base pl-2 mb-5">Blogs / Appercu & commentaire</h3>

        <h5 class="pl-2 mb-5">Appercu</h5>
        <h6 class="mb-5">Sur la page d'acceuil</h6>
        <div class="relative w-full mb-10 rounded-lg text-lg overflow-hidden cursor-pointer Blogcard">
            <div class="absolute top-0 left-0 right-0 bottom-0">
                <img class="absolute top-0 left-0 blog-img" src="{{ asset('images/couv-blog/'.$blog->couv_blog )}}" >
                <div class="absolute blog-textbox">
                    <div class="blog-title">{{ $blog->titre_blog }}</div>
                    <div class="blog-subtitle">{{ $blog->sous_titre_blog }}</div>
                    <div class="blog-bar"></div>
                    <div class="blog-description">{{ $blog->contenu_blog }}</div>
                    <div class="blog-tagbox">
                        <span class="blog-tag">{{ $blog->date_publi_blog }} </span>
                        <span class="blog-tag">0 Commentaire(s)</span>
                    </div>
                </div>
            </div>
        </div>

        <h6 class="mb-5">Lors de l'affichage apres clique</h6>
        <div class="mb-5 blogshow">
            <div class="relative mb-5 w-full h-80">
                <img src="{{ asset('images/couv-blog/'.$blog->couv_blog )}}" alt="" class="absolute top-0 left-0 w-full h-full">
                <div class="text-white text-5xl absolute bottom-3 font-semibold right-3">
                   ' {{ $blog->titre_blog }} '
                </div>
            </div>
            <div>
                <h4 class="text-lg font-semibold">{{ $blog->titre_blog }}</h4>
                <h5 class="text-lg font-semibold blog-subtitle">{{ $blog->sous_titre_blog }}</h5>
                <p>
                    {{ $blog->contenu_blog }}
                </p>

                <div class="galerie">
               
                    <div class="my-5 project-gallery">
                        <div class="image-accordion">
                            @foreach  ($photos as $key => $photo)
                                <figure class="{{ $key === 0 ? 'selected-image' : '' }}">
                                    <img src="{{ asset($photo->img) }}"
                                        alt="image">
                                </figure>
                            @endforeach
                        </div>
                    </div>
                </div>   
            </div>
        </div>
        <form action="">
            <div class="flex max-w-5xl gap-2">
                <button class="float-right mb-5 bg-green-500 hover:bg-green-600 text-white">Approuver</button>
            </div>
        </form>

        <div class="h-96 blog-comment ">
            <h5 class="pl-2 mb-5">Les commentaires</h5>
            <div class="overflow-y-hidden h-full">
                <ul class="overflow-y-scroll h-5/6">
                    <li class="mb-5 flex justify-center items-center blog-comment-card">
                        <div class="h-full w-3/12 blog-visiteur">
                            <div class="text-2xl font-semibold blog-visiteur-name">
                                Bob
                            </div>
                            <div class="text-xs">
                                il y a 2 heures
                            </div>
                        </div>
                        <div class="p-5 w-8/12">
                            ' Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                            Quae, suscipit quaerat quisquam temporibus mollitia ea eius aliquam,
                            sunt aperiam, autem facilis animi voluptatem excepturi alias blanditiis? 
                            Omnis porro dolorem optio? '
                        </div>
                        <div class="w-1/12 flex">
                            <form action="">
                                <button><i class="text-gray-500 bx bx-trash"></i></button>
                            </form>
                            <form action="">
                                <button><i class="text-blue-500 bx bx-reply"></i></button>
                            </form>
                        </div>
                    </li>

                    <li class="mb-5 flex flex-row-reverse justify-center items-center blog-comment-card response">
                        <div class="h-full w-3/12 blog-visiteur">
                            <div class="text-2xl font-semibold blog-visiteur-name">
                                H4F
                            </div>
                            <div class="text-xs">
                                il y a 2 heures
                            </div>
                        </div>
                        <div class="p-5 w-8/12">
                            ' Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                            Quae, suscipit quaerat quisquam temporibus mollitia ea eius aliquam,
                            sunt aperiam, autem facilis animi voluptatem excepturi alias blanditiis? 
                            Omnis porro dolorem optio? '
                        </div>
                        <div class="w-1/12 flex">
                            <form action="">
                                <button><i class="text-gray-500 bx bx-trash"></i></button>
                            </form>
                            <form action="">
                                <button><i class="text-blue-500 bx bx-reply"></i></button>
                            </form>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
        <a href="{{ route('blog.index') }}" class="absolute -top-2 -left-10  "><i class="text-4xl bx bx-chevron-left"></i></a>
    </div>

  
</section>



            

<script>
    const Projectimages = document.querySelectorAll(".image-accordion img");

    Projectimages.forEach(function (image) {
        image.onclick = function (event) {
            document.querySelector(".selected-image").classList.remove("selected-image");
            const clickParent = event.target.parentNode;
            clickParent.classList.add("selected-image");
        }
    
    })
</script>


@endsection