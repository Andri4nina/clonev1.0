@extends('layouts.log')

@section("content")
<div class="absolute top-5 left-3 ">
    <a href="#" class="w-full top-0 left-10 inline mr-20 text-1xl logo">
        <div class="flex">
           <img src="{{asset( 'images/Logo-MEH.png') }}" class="w-20"  alt="logo"> 
           <h3 class="text-sm font-extrabold pt-12 text-center ">  Ministere de l'Energie et de l'Hydrocarbure</h3> 
        </div> 
    </a>
</div> 



<div
    class="absolute w-full top-1/2 -translate-y-1/2 md:grid md:grid-cols-1 signin">
    <form action="{{  route('auth.dologin') }}" method="post" class="flex items-center justify-center flex-col  sign-in-form">
        
        @csrf
        @if ($errors->any())
                <script type="text/javascript">
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
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
                        title: 'Champs vide ou invalide'
                      })
                </script>
                   
                @endif

  {{--        <h2 class="text-4xl mb-3 title">Bienvenue sur E-publa </h2>  --}}
        <div class="max-w-sm w-full h-14 my-3 mx-0 py-0 px-2 relative  flex input_field">
            <i class="text-center text-base absolute top-1/2 right-5 -translate-y-2/4  fa fa-user"></i>
            <input type="text" placeholder="Nom d'utilisateur"
                class="bg-transparent outline-none border-none font-semibold text-lg" name="nom_user">
        </div>

        <div class="max-w-sm w-full h-14 my-3 mx-0 py-0 px-2 relative  flex input_field">
            <i class="text-center text-base absolute top-1/2 right-5 -translate-y-2/4  fa fa-envelopes"></i>
            <input type="email" placeholder="xxxxxxx@gmail.com"
                class="bg-transparent outline-none border-none font-semibold text-lg" name="email">
            </div>

        <div class="  max-w-sm w-full h-14 my-3 mx-0  relative py-0 px-2 flex input_field">
            <i class="text-center text-base  absolute top-1/2 right-5 -translate-y-2/4  fa fa-lock"></i>
            <input type="password" placeholder="Mot de passe"
                class="bg-transparent outline-none border-none font-semibold text-lg" name="password">
        </div>
        <button type="submit" value="login" name="connect_btn" class=" text-white rounded-xl p-3 mt-4 submit">
            Se connecter
        </button>
    </form>
</div>


<footer class="absolute bottom-5 left-3 ">
    {{ view('layouts.footer') }}
  </footer>
@endsection