@extends('layouts.log')

@section("content")
<div class="absolute top-5 left-3 ">
    <a href="#" class="w-full top-0 left-10 inline mr-20 text-1xl logo">
        <div class="flex">
           <img src="" class="w-20"  alt="logo"> 
           <h3 class="text-3xl font-extrabold pt-12 text-center ">Hope for a future <br>
            <small>-Madagascar-</small>
            </h3> 
        </div> 
    </a>
</div> 


<div  class="relative w-full h-screen">
    <div
    class="absolute w-full top-1/2 -translate-y-1/2 md:grid md:grid-cols-1 signin">
        <form action="{{  route('auth.dologin') }}" method="post" class="flex items-center justify-center flex-col max-w-xs mx-auto  sign-in-form">
            
            @csrf
            @if ($errors->any())
            <script type="text/javascript">
                document.addEventListener('DOMContentLoaded', function() {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });
        
                    Toast.fire({
                        icon: 'warning',
                        title: 'Champs vide ou invalide'
                    });
                });
            </script>
        @endif
        

    
                    <div class="mb-5 w-full  flex justify-center items-center input-field">
                        <div class="w-1/12"><i class="">@</i></div>
                        <input type="text" name='name' value="{{ old('name') }}" placeholder="Nom de l'utilisateur" class="w-11/12  bg-none">
                    </div>
                    <div class="mb-5 w-full  flex justify-center items-center input-field">
                        <div class="w-1/12"><i class="bx bx-envelope"></i></div>
                        <input type="email" name='email' value="{{ old('email') }}" placeholder="Adresse mail" class="w-11/12  bg-none">
                    </div>
                    <div class="mb-5 w-full flex justify-center items-center input-field">
                        <div class="w-1/12"><i class="bx bx-lock"></i></div>
                        <input type="password" name='password' id="password" placeholder="mot de passe" class="w-10/12 bg-none">
                        <div class="w-1/12 cursor-pointer" id="togglePassword"><i class="bx bx-low-vision"></i></div>
                    </div>
        
            <button type="submit" value="login" name="connect_btn" class=" text-white rounded-xl p-3 mt-4 submit">
                Se connecter
            </button>
        </form>
    </div>
</div>



<footer class=" text-center -translate-y-20 mb-10 ">
    {{ view('layouts.footer') }}
  </footer>
@endsection