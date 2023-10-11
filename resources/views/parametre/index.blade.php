@extends('layouts.app')

@section('content')
<section class="block max-w-fit w-fit mx-auto ">
    <div class="usersection">
        <h3 class="text-base pl-2 mb-5">Parametre</h3>
        <form action="">
            <div class="bounceslideInFromLeft mx-auto w-2/3 flex justify-center items-center gap-8 parametre-card">
                <img src="{{ asset('images/pdp/' . Illuminate\Support\Facades\Auth::user()->pdp) }}" alt="" class="object-cover w-36 h-36">
                <div class="w-2/3">
                    <b>Mettre a jour votre photo de profil</b>
                    <input type="file" class="pdp">
                </div>
            </div>


            <div class="bounceslideInFromRight mx-auto my-5 w-2/3 parametre-card">
                <div class="mb-5  flex justify-center items-center input-field">
                    <div class="w-1/12"><i class="">@</i></div>
                    <input type="text" name='user-name' placeholder="Nom de l'utilisateur" class="w-11/12  bg-none" value='{{ \Illuminate\Support\Facades\Auth::user()->name }}'>
                </div>
                <div class="mb-5 flex justify-center items-center input-field">
                    <div class="w-1/12"><i class="bx bx-lock"></i></div>
                    <input type="password" name='user-mdp' id="password" placeholder="ancien mot de passe" class="w-10/12 bg-none">
                    <div class="w-1/12 cursor-pointer" id="togglePassword"><i class="bx bx-low-vision"></i></div>
                </div>

                <div class="mb-5 flex justify-center items-center input-field">
                    <div class="w-1/12"><i class="bx bx-lock"></i></div>
                    <input type="password" name='user-mdp' id="password" placeholder="nouvel mot de passe" class="w-10/12 bg-none">
                    <div class="w-1/12 cursor-pointer" id="togglePassword"><i class="bx bx-low-vision"></i></div>
                </div>

                <div class="mb-5 flex justify-center items-center input-field">
                    <div class="w-1/12"><i class="bx bx-lock"></i></div>
                    <input type="password" name='user-mdp' id="password" placeholder="confirmer mot de passe" class="w-10/12 bg-none">
                    <div class="w-1/12 cursor-pointer" id="togglePassword"><i class="bx bx-low-vision"></i></div>
                </div>
                <div class="mb-5 flex justify-center items-center input-field">
                    <div class="w-1/12"><i class="bx bx-envelope"></i></div>
                    <input type="text" name='user-mail' placeholder="Exemple.exemple" class="w-6/12  bg-none">
                    <input type="text" name='user-mail-adresse' placeholder="@exemple.com" class="w-5/12  bg-none">
                    <script>
                        // Fonction pour diviser l'adresse e-mail
                        function splitEmail() {
                            var email = "{{ \Illuminate\Support\Facades\Auth::user()->email }}"; 
                            var parts = email.split('@');
                
                            // Assigne chaque partie à un champ
                            document.querySelector('input[name="user-mail"]').value = parts[0];
                            document.querySelector('input[name="user-mail-adresse"]').value = '@' + parts[1];
                        }
               
                        window.onload = splitEmail;
                    </script>
                </div>
                <div class="mb-5  flex justify-center items-center input-field">
                    <div class="w-1/12"><i class="bx bx-phone"></i></div>
                    <input type="text" name='user-role' placeholder="032 32 032 32" class="w-11/12 bg-none" value="{{ \Illuminate\Support\Facades\Auth::user()->tel_user }}">
                </div>
                <button class="float-right mb-5 bg-green-500 hover:bg-green-600 text-white">Enregistrer</button>
          
            </div>

          
        </form>

    </div>
</section>
@endsection