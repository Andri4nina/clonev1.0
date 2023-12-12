@extends('welcome')

@section('content')
<section class="public-section">
    <div class="mb-5  blogshow">
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

        <div class="bounceslideInFromLeft relative mb-5 mx-auto max-w-5xl  w-full h-80">
            <img src="{{ asset('images/couv-blog/'.$blog->couv_blog )}}" alt="" class="absolute top-0 left-0 w-full h-full nophotocouv">
            <div class="text-5xl absolute bottom-3 font-semibold right-3" style="color: white; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">
                '{{ $blog->titre_blog }}'
            </div>

        </div>
        <div class="max-w-5xl mx-auto bounceslideInFromRight">
            <h2 class="text-lg font-semibold">{{ $blog->titre_blog }}</h2>
            <br>
            <h5 class="text-lg font-semibold blog-subtitle">{{ $blog->sous_titre_blog }}</h5>
            <p class="px-2">
                {!! $blog->contenu_blog !!}
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

    @if($blog->type_blog==='reportage'|| $blog->type_blog==='Reportage')
    <div class="mb-5 mx-auto flex justify-center bounceInLeft max-w-5xl">
        <iframe width="560" height="315" src="{{ $blog->url_blog }}" frameborder="0" allowfullscreen></iframe>
    </div>

    @endif

    <div class="max-w-5xl mx-auto bounceslideInFromBottom h-96 blog-comment ">
        <h5 class="pl-2 mb-5">Les commentaires</h5>
        <div class="overflow-y-hidden h-full">
            <ul class="overflow-y-scroll h-5/6">
                @foreach ($comments as $com)
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

                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="mx-auto mb-16 p-10 pb-10 card_comment">
            <h3>Laissez un commentaire</h3>
            <form action="{{ route('public.storecomment') }}" method="post" enctype="multipart/form-data">

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
                    <input type="text" name='nom_vis' placeholder="Votre nom" class="w-11/12   bg-none" value="{{ old('nom_vis') }}">
                </div>
                <div class="mb-5  flex justify-center items-center input-field">
                    <input type="email" name='email_vis' placeholder="Votre adresse E-mail" class="w-11/12   bg-none" value="{{ old('email_vis') }}">
                </div>


              <div class="mb-5  flex justify-center items-center input-field">
                <textarea name="contenu_com" id="" cols="30" rows="10" class="w-11/12 bg-none"> {{ old('contenu_com') }}</textarea>
              </div>

              <div class="flex justify-end">
                <input type="hidden" name="hidden_id" value="{{$blog->id}}" >
                <button class=" bg-green-500 hover:bg-green-400 text-white" type="submit">Envoyer</button>
              </div>

            </form>
        </div>
    </div>
</section>

@endsection
