@extends('layouts.app')

@section('content')
<section class=" block max-w-6xl w-full mx-auto ">
    @if ($message = Session::get('success'))
    <script type="text/javascript">
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: '{{ $message }}'
        })
    </script>


    @endif
    <div class="relative usersection">
        <h3 class="bounceslideInFromLeft text-2xl pl-2 mb-5 font-semibold"><a href="{{ route('blog.index') }}" ><i class="text-4xl bx bx-chevron-left"></i></a>Blogs / <small>Appercu & commentaire</small></h3>


        <h5 class="bounceslideInFromLeft pl-2 mb-5">Appercu</h5>
        <h6 class="bounceslideInFromLeft mb-5">Sur la page d'acceuil</h6>
        <div class="bounceslideInFromRight relative max-w-5xl w-full mb-10 rounded-lg text-lg overflow-hidden cursor-pointer Blogcard">
            <div class="absolute top-0 left-0 right-0 bottom-0">
                <img class="absolute top-0 left-0 blog-img nophotocouv" src="{{ asset('images/couv-blog/'.$blog->couv_blog )}}" >
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

        <h6 class="bounceslideInFromLeft mb-5">Lors de l'affichage apres clique</h6>
        <div class="mb-5 px-5 blogshow">
            <div class="bounceslideInFromLeft relative mb-5  max-w-5xl  w-full h-80">
                <img src="{{ asset('images/couv-blog/'.$blog->couv_blog )}}" alt="" class="absolute top-0 left-0 w-full h-full nophotocouv">
                <div class="text-5xl absolute bottom-3 font-semibold right-3" style="color: white; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">
                    '{{ $blog->titre_blog }}'
                </div>

            </div>
            <div class="max-w-5xl  bounceslideInFromRight">
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
                                        alt="image" class="nophoto">
                                </figure>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($blog->type_blog==='reportage'|| $blog->type_blog==='Reportage')
        <div class="mb-5 mx-auto bounceInLeft max-w-5xl">
            <iframe width="560" height="315" src="{{ $blog->url_blog }}" frameborder="0" allowfullscreen></iframe>
        </div>

        @endif
        @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_approv_blog == "1" && Auth::user()->id == $blog->user_id))
        <form class="bounceslideInFromLeft" action="{{ route('blog.approuved') }}" method="POST">
            @csrf
            <div class="flex max-w-5xl gap-2">
                <input type="hidden" name="the_user" value=" {{\Illuminate\Support\Facades\Auth::user()->name}}">
                <input type="hidden" name='hidden_id' value="{{ $blog->id }}">
                <button class="float-right mb-5 bg-green-500 hover:bg-green-600 text-white">Approuver</button>
            </div>
        </form>
        @else
        <div class="flex max-w-5xl gap-2">
            <button class="grayscale float-right mb-5 bg-green-500 hover:bg-green-600 text-white">Approuver</button>
        </div>
        @endif

        <div class="max-w-5xl bounceslideInFromBottom h-96 blog-comment ">
            <h5 class="pl-2 mb-5">Les commentaires</h5>
            <div class="overflow-y-hidden h-full">

                <ul class="overflow-y-scroll h-5/6">
                    @foreach ($comment as $com)
                        @if ( $com->type_com ==='commentaire_publi' )
                            <li class="mb-5 flex justify-center items-center blog-comment-card">
                                <div class="h-full w-3/12 blog-visiteur">
                                    <div class="text-2xl font-semibold blog-visiteur-name">
                                        {{ $com->nom_visiteur }}
                                    </div>
                                    <div class="text-xs">
                                        @if ($com->seconds_diff < 60)
                                        il y a {{ $com->seconds_diff }} secondes
                                        @elseif ($com->seconds_diff < 3600)
                                        il y a {{ floor($com->seconds_diff / 60) }} minutes
                                        @elseif ($com->seconds_diff < 86400)
                                        il y a {{ floor($com->seconds_diff / 3600) }} heures
                                        @elseif ($com->seconds_diff < 604800)
                                        il y a {{ floor($com->seconds_diff / 86400) }} jours
                                        @else
                                        le {{ $com->created_at}}
                                        @endif
                                    </div>
                                </div>
                                <div class="p-5 w-8/12">
                                    "{{ $com->libelle_com }}"
                                </div>
                                <div class="w-1/12 flex">
                                @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_approv_blog == "1"))
                                    <form action="{{ route('blog.delcomment', $com->id) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button onclick="deleteConfirm(event)"><i class="text-gray-500 bx bx-trash"></i></button>
                                    </form>
                                </div>
                                @endif

                            </li>
                        @else
                            <li class="mb-5 flex flex-row-reverse justify-center items-center blog-comment-card response">
                                <div class="h-full w-3/12 blog-visiteur">
                                    <div class="text-2xl font-semibold blog-visiteur-name">
                                        H4F
                                    </div>
                                    <div class="text-xs">
                                        @if ($com->seconds_diff < 60)
                                        il y a {{ $com->seconds_diff }} secondes
                                        @elseif ($com->seconds_diff < 3600)
                                        il y a {{ floor($com->seconds_diff / 60) }} minutes
                                        @elseif ($com->seconds_diff < 86400)
                                        il y a {{ floor($com->seconds_diff / 3600) }} heures
                                        @elseif ($com->seconds_diff < 604800)
                                        il y a {{ floor($com->seconds_diff / 86400) }} jours
                                        @else
                                        le {{ $com->created_at}}
                                        @endif
                                    </div>
                                </div>
                                <div class="p-5 w-8/12">
                                    "{{ $com->libelle_com }}"
                                </div>
                                <div class="w-1/12 flex">
                                    @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_approv_blog == "1"))
                                        <form action="{{ route('blog.delcomment', $com->id) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button onclick="deleteConfirm(event)"><i class="text-gray-500 bx bx-trash"></i></button>
                                        </form>
                                    @endif
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>



            <form class="mx-5 bounceslideInFromBottom" action="{{ route('blog.storeresponse') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                <script type="text/javascript">
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                          toast.addEventListener('mouseenter', Swal.stopTimer)
                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                      })

                      Toast.fire({
                        icon: 'warning',
                        title: 'Veuillez remplir les champs obligatoires'
                      })
                </script>

                @endif
                <div class="mb-5  flex justify-center items-center input-field">
                    <textarea name="contenu_com" id="" cols="30" rows="10" class="w-11/12 bg-none"> {{ old('contenu_com') }}</textarea>
                </div>

                <div class="flex justify-end">

                <input type="hidden" name="hidden_id" value="{{$blog->id}}" >
                @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_approv_blog == "1"))
                    <button class=" bg-green-500 hover:bg-green-400 text-white" type="submit">Repondre</button>
                @else
                    <button class="grayscale bg-green-500 hover:bg-green-400 text-white" disabled>Repondre</button>

                @endif
                </div>

          </form>
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

<script type="text/javascript">
    window.deleteConfirm = function(e) {
        e.preventDefault();
        var form = e.target.form;
        Swal.fire({
                title: 'Etes vous sur de vouloir supprimer ce message ?',
                text: "Vous ne pouvez plus retourner en arriere!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1F9B4F',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
            form.submit();
            }
        })
    }
</script>
@endsection
