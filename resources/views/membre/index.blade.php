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
    <div class="usersection">
        <h3 class="bounceslideInFromLeft text-2xl pl-2 mb-5 font-semibold">Membres</h3>
        <div class="bounceslideInFromRight p-5 min-w-4xl crud-card">
            <div class="top-card">
                <h4>Tous les Membres</h4>
                <div class="w-full">
                    <div class="">
                        <form action="{{ route('membre.create') }}" class="float-right">
                            <button class="flex justify-around items-center btn-add"><span>Nouveau membre</span><div class="ml-2 relative"><i class="fas fa-users"></i><i class="text-sm">+</i></div></button>
                        </form>
                    </div>
                    <br>
                    <form action="{{ route('membre.index') }}" class="my-5">
                        <div class="flex justify-center items-center relative">
                            <button class="w-2/12 text-center btn-search"><span class="hidden sm:block">Rechercher</span>  <i class="block sm:hidden bx bx-search"></i></button>
                            <input class="w-10/12" type="text" name="search" placeholder="Chercher un blog">
                            <button class="absolute right-2 hidden sm:block">
                                <i class="bx bx-search "></i>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
            <div class="relative crud-list">
                <table class="text-center min-w-full tableMembre">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Profil</th>
                            <th class="px-4 py-2">Rôle</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($membre) > 0)
                            @foreach ($membre as $mem)
                                <tr class="">
                                    <td data-label="Profil" class="px-4 mt-3 flex justify-items-stretch align-middle gap-2 ">
                                        <img src="{{ asset('images/pdp-membre/'.$mem->pdp_membre )}}" alt="Pdp" class="object-cover w-10 h-10 rounded-full">
                                        <p class="px-4 py-1"><span>{{ $mem->nom_membre }}</span></p>
                                    </td>
                                    <td data-label="Role" class="px-4 py-2 ">{{ $mem->poste_membre }}</td>
                                    <td data-label="Actions" class="w-auto">
                                        <div class="flex justify-center items-center  gap-2  my-auto ">
                                            @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_membre == "1"))

                                            <form action="{{ route('membre.edit' ,$mem->id )}}">
                                                <button class="border text-blue-500 border-blue-500 hover:bg-blue-500 hover:text-white  font-bold "><i class="bx bx-pencil"></i></button>
                                            </form>

                                            <form action="{{ route('membre.destroy' ,$mem->id )}}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <input type="hidden" name="the_user" value=" {{\Illuminate\Support\Facades\Auth::user()->name}}">

                                                <button class="border text-red-500 border-red-500 hover:bg-red-500 hover:text-white font-bold "onclick="deleteConfirm(event)"><i class="bx bx-trash"></i></button>
                                            </form>
                                            @else
                                                <button class="grayscale border text-blue-500 border-blue-500 hover:bg-blue-500 hover:text-white  font-bold "><i class="bx bx-pencil"></i></button>
                                                <button class="grayscale border text-red-500 border-red-500 hover:bg-red-500 hover:text-white font-bold "onclick="deleteConfirm(event)"><i class="bx bx-trash"></i></button>
                                            @endif
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <div class="absolute top-16 text-center w-full h-14 ">
                                <p>Aucun enregistrement ne correspond a votre recherche </p>
                            </div>
                        @endif
                    </tbody>

                </table>
                <div class="mt-20  mb-5 flex justify-center items-center">
                    {{ $membre->links('layouts.pagination') }}
                </div>
            </div>

        </div>

       <div class="relative w-full min-vh-100 flex gap-5 my-20 justify-center items-center overflow-hidden thissection">

            <div class="bounceslideInFromBottom w-full h-auto py-14 swiper-container ">
                <div class="swiper-wrapper">
                @foreach ($membre as $membreCrad)
                    <div class="bg-center bg-cover w-96 h-96 swiper-slide">
                        <div class="w-full relative p-10 testimonial-Box">
                            <img src="{{asset( 'images/component/quote.png') }}" alt="" class="w-20 absolute top-5 right-7 quote">
                            <div class="testimonial-content">
                                <p>
                                    {{$membreCrad->descri_membre}}
                                </p>
                                <div class="flex items-center mt-5 details">
                                    <div class="relative w-16 h-16 rounded-full overflow-hidden mr-3 img-box">
                                        <img src="{{ asset('images/pdp-membre/'.$membreCrad->pdp_membre )}}" alt="" class=" object-cover w-10 h-10 rounded-full">
                                    </div>
                                    <h3 class="text-base font-semibold membre-details">
                                        {{ $membreCrad->nom_membre }}
                                        <br>
                                        <span class="text-xs">
                                            {{ $membreCrad->poste_membre }}
                                        </span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    window.deleteConfirm = function(e) {
        e.preventDefault();
        var form = e.target.form;
        Swal.fire({
                title: 'Etes vous sur de vouloir supprimer ce membre ?',
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

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js" ></script>
<script>
    var swiper = new Swiper(".swiper-container", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      coverflowEffect: {
        rotate: 20,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
      },

    });
  </script>
@endsection
