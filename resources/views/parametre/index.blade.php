@extends('layouts.app')

@section('content')
<section class="block max-w-fit w-fit mx-auto ">
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
        <h3 class="bounceslideInFromLeft text-2xl pl-2 mb-5 font-semibold">Parametre</h3>
        <form action="{{ route('parametre.update') }}" method='POST' enctype="multipart/form-data">
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
            <div class="bounceslideInFromLeft mx-auto w-2/3 flex justify-center items-center gap-8 parametre-card">
                <img src="{{ asset('images/pdp/' . Illuminate\Support\Facades\Auth::user()->pdp) }}" alt="" class="object-cover w-36 h-36">
                <div class="w-2/3">
                    <b>Mettre a jour votre photo de profil</b>
                    <input type="file" class="pdp" name="user-pdp">
                </div>
                 <div class="hidden">
                                <input type="hidden" name='hidden_user_pdp' value='{{ Illuminate\Support\Facades\Auth::user()->pdp }}'>
                                <input type="file" name="user-pdp" accept="images/*" >
                    </div>
            </div>


            <div class="bounceslideInFromRight mx-auto my-5 w-2/3 parametre-card">
                <div class="mb-5  flex justify-center items-center input-field">
                    <div class="w-1/12"><i class="">@</i></div>
                    <input type="text" name='user-name' placeholder="Nom de l'utilisateur" class="w-11/12  bg-none" value='{{ \Illuminate\Support\Facades\Auth::user()->name }}'>
                </div>
                <div class="mb-5 flex justify-center items-center input-field" id='mdpremember'>
                    <div class="w-1/12"><i class="bx bx-lock"></i></div>
                    <input type="password"  id="passwordOld" placeholder="ancien mot de passe" class="w-10/12 bg-none"  onblur="mdpremember()"> 
                    <div class="w-1/12 cursor-pointer toggle-password" data-target="passwordOld"><i class="bx bx-low-vision"></i></div>
                </div>
                
                <div class="mb-5 flex justify-center items-center input-field">
                    <div class="w-1/12"><i class="bx bx-lock"></i></div>
                    <input type="password" name='user-mdp' id="passwordNew" placeholder="nouveau mot de passe" class="w-10/12 bg-none">
                    <div class="w-1/12 cursor-pointer toggle-password" data-target="passwordNew"><i class="bx bx-low-vision"></i></div>
                </div>
                
                <div class="mb-5 flex justify-center items-center input-field " id="mdpmatching">
                    <div class="w-1/12"><i class="bx bx-lock"></i></div>
                    <input type="password" id="passwordConfirm" placeholder="confirmer mot de passe" onblur="mdpmatch()" class="w-10/12 bg-none">
                    <div class="w-1/12 cursor-pointer toggle-password" data-target="passwordConfirm"><i class="bx bx-low-vision"></i></div>
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
                    <input type="text" name='user-tel' placeholder="032 32 032 32" class="w-11/12 bg-none" value="{{ \Illuminate\Support\Facades\Auth::user()->tel_user }}">
                </div>
                 <input type="hidden" value="{{ Illuminate\Support\Facades\Auth::user()->id }}" name="hidden_id">
                <button class="float-right mb-5 bg-green-500 hover:bg-green-600 text-white">Enregistrer</button>
          
            </div>

          
        </form>

    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePasswordButtons = document.querySelectorAll('.toggle-password');

        togglePasswordButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const targetId = this.dataset.target;
                const passwordInput = document.getElementById(targetId);

                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                const icon = this.querySelector('i');
                icon.classList.toggle('bx-low-vision');
                icon.classList.toggle('bx-show');
            });
        });
    });
</script>

<script>
    const passwordConfirm = document.querySelector('#passwordConfirm');
    const passwordNew = document.querySelector('#passwordNew');
    const mdpmatching = document.querySelector('#mdpmatching');

    function mdpmatch(){
        if (passwordNew.value === passwordConfirm.value) {
            mdpmatching.classList.add('match');
            mdpmatching.classList.remove('nomatch');
        } else {
            mdpmatching.classList.remove('match');
            mdpmatching.classList.add('nomatch');
        }
    }
</script>



@endsection