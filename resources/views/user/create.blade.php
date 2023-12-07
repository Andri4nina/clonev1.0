@extends('layouts.app')

@section('content')
<section class=" block max-w-6xl w-full mx-auto ">
    <div class="relative usersection">
        <h3 class="bounceslideInFromLeft text-2xl pl-2 mb-5 font-semibold">        <a href="{{ route('utilisateur.index') }}"  >
            <i class="text-4xl bx bx-chevron-left"></i></a> Utilisateurs / <small> Creation </small></h3>

        <form action="{{ route('utilisateur.store')}}" method="POST"  enctype="multipart/form-data">
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

            <div class="mx-auto block md:flex max-w-5xl gap-2">

                <div class="bounceslideInFromLeft w-full md:w-1/2 p-5 crud-card">
                    <h4 class="font-semibold">Information Personnel de l'utilisateur</h4>
                    <div class="my-5 flex justify-center items-center">
                        <div class="relative h-20 w-20">
                            <img src="{{asset( 'images/sans-image/nopdp.png') }}" alt="" id="pdp" class=" h-full w-full object-cover   border rounded-full">
                            <label class="cursor-pointer absolute bottom-0 right-0" for="user-pdp"><i class="text-white bg-gray-600 border border-gray-600 rounded-full bx bx-camera"></i></label>
                            <div class="hidden">
                                <input type="file" name="user-pdp" accept="images/*" >
                            </div>
                        </div>
                    </div>
                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class="w-1/12"><i class="">@</i></div>
                        <input type="text" name='user-name' value="{{ old('user-name') }}" placeholder="Nom de l'utilisateur" class="w-11/12  bg-none">
                    </div>
                    <div class="mb-5 flex justify-center items-center input-field">
                        <div class="w-1/12"><i class="bx bx-lock"></i></div>
                        <input type="password" name='user-mdp' id="password" placeholder="mot de passe" class="w-10/12 bg-none">
                        <div class="w-1/12 cursor-pointer" id="togglePassword"><i class="bx bx-low-vision"></i></div>
                    </div>
                    <input type="hidden" name="the_user" value=" {{\Illuminate\Support\Facades\Auth::user()->name}}">

                    <div class="mb-5 flex justify-center items-center input-field">
                        <div class="w-1/12"><i class="bx bx-envelope"></i></div>
                        <input type="text" name='user-mail' placeholder="Exemple.exemple" value="{{ old('user-mail') }}" class="w-6/12  bg-none">
                        <input type="text" name='user-mail-adresse' placeholder="@exemple.com" value="{{ old('user-mail-adresse') }}" class="w-5/12  bg-none">
                    </div>
                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class="w-1/12"><i class="bx bx-badge"></i></div>
                        <input type="text" name='user-role' placeholder="Role" value="{{ old('user-role') }}"  class="w-11/12 bg-none">
                    </div>
                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class="w-1/12"><i class="bx bx-phone"></i></div>
                        <input type="text" name='user-tel' placeholder="032 32 032 32" value="{{ old('user-tel') }}" class="w-11/12 bg-none">
                    </div>
                </div>

                <div class="bounceslideInFromRight w-full mt-5 md:mt-0 md:w-1/2 p-5 crud-card">
                    <h4 class="mb-5 font-semibold">Privilege</h4>
                    <div class="mb-5 flex justify-center items-center">
                        <h5 class="w-10/12">Super utilisateur</h5>
                        <div class="w-2/12">
                            <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                <input class="form-checkbox" type="checkbox" id="super-user" name="super-user" {{ old('super-user') ? 'checked' : '' }}>
                                <label class="ml-2" for="super-user"></label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5 flex justify-center items-center">
                        <h5 class="w-10/12">Gestion des taches</h5>
                        <div class="w-2/12">
                            <div class="flex justify-center items-center prvlg-switcher">
                                <input class="form-checkbox" type="checkbox" id="tache" name="tache" {{ old('tache') ? 'checked' : '' }} >
                                <label class="ml-2" for="tache"></label>
                            </div>
                        </div>
                    </div>
                    <h5 class="w-10/12">Gestion des utilisateurs</h5>
                    <div class=" mb-5 block sm:flex justify-end sm:justify-center  sm:items-center">
                        <div class="w-1/2  mt-5 sm:flex justify-end sm:justify-center items-center">
                            <div>Creation</div>
                            <div class="">
                                <div class="flex justify-center items-center prvlg-switcher">
                                    <input class="form-checkbox" type="checkbox" id="create-user" name="create-user" {{ old('create-user') ? 'checked' : '' }}>
                                    <label class="ml-2" for="create-user"></label>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2 mt-5 sm:flex justify-end sm:justify-centeritems-center">
                            <div>Modification</div>
                            <div class="">
                                <div class="flex justify-center items-center prvlg-switcher">
                                    <input class="form-checkbox" type="checkbox" id="updat-user" name="updat-user" {{ old('updat-user') ? 'checked' : '' }}>
                                    <label class="ml-2" for="updat-user"></label>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2 mt-5 sm:flex justify-end sm:justify-center items-center">
                            <div>Suppression</div>
                            <div class="">
                                <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                    <input class="form-checkbox" type="checkbox" id="del-user" name="del-user" {{ old('del-user') ? 'checked' : '' }}>
                                    <label class="ml-2" for="del-user"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5 flex justify-center items-center">
                        <h5 class="w-10/12">Gestion des membres</h5>
                        <div class="w-2/12">
                            <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                <input class="form-checkbox" type="checkbox" id="membre" name="membre" {{ old('membre') ? 'checked' : '' }} >
                                <label class="ml-2" for="membre"></label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5 flex justify-center items-center">
                        <h5 class="w-10/12">Gestion des project</h5>
                        <div class="w-2/12">
                            <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                <input class="form-checkbox" type="checkbox" id="project" name="project" {{ old('project') ? 'checked' : '' }} >
                                <label class="ml-2" for="project"></label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5 flex justify-center items-center">
                        <h5 class="w-10/12">Gestion des partenaires</h5>
                        <div class="w-2/12">
                            <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                <input class="form-checkbox" type="checkbox" id="partenaire" name="partenaire" {{ old('partenaire') ? 'checked' : '' }}>
                                <label class="ml-2" for="partenaire"></label>
                            </div>
                        </div>
                    </div>

                    <h5 class="w-10/12">Gestion des blog</h5>
                    <div class="mb-5 grid grid-cols-2 justify-start items-center">
                        <div class="w-1/2  mt-5 grid items-center">
                            <div>Creation</div>
                            <div class="">
                                <div class="flex justify-center items-center prvlg-switcher">
                                    <input class="form-checkbox" type="checkbox" id="create-blog" name="create-blog" {{ old('create-blog') ? 'checked' : '' }}>
                                    <label class="ml-2" for="create-blog"></label>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2 mt-5  grid items-center">
                            <div>Modification</div>
                            <div class="">
                                <div class="flex justify-center items-center prvlg-switcher">
                                    <input class="form-checkbox" type="checkbox" id="updat-blog" name="updat-blog" {{ old('updat-blog') ? 'checked' : '' }}>
                                    <label class="ml-2" for="updat-blog"></label>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2 mt-5  grid items-center">
                            <div>Suppression</div>
                            <div class="">
                                <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                    <input class="form-checkbox" type="checkbox" id="del-blog" name="del-blog" {{ old('del-blog') ? 'checked' : '' }}>
                                    <label class="ml-2" for="del-blog"></label>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2 mt-5  grid items-center">
                            <div>Approbation</div>
                            <div class="">
                                <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                    <input class="form-checkbox" type="checkbox" id="approb-blog" name="approb-blog" {{ old('approb-blog') ? 'checked' : '' }}>
                                    <label class="ml-2" for="approb-blog"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_create_user == "1"))
                    <div class="mt-5 flex w-full justify-center md:justify-end ">
                        <button class=" mb-5 bg-green-500 hover:bg-green-600 text-white">Enregistrer</button>
                    </div>
                    @else
                    <div class="mt-5 flex w-full justify-center md:justify-end ">
                        <button class=" grayscale mb-5 bg-green-500 hover:bg-green-600 text-white" disabled>Enregistrer</button>
                    </div>
                    @endif
                </div>

            </div>
        </form>
      </div>


</section>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const label = document.querySelector('label[for="user-pdp"]');
        const inputFile = document.querySelector('input[type="file"]');
        const pdpImage = document.getElementById('pdp');

        label.addEventListener('click', function() {
            inputFile.click();
        });

        inputFile.addEventListener('change', function() {
            const selectedFile = this.files[0];
            if (selectedFile) {
                const reader = new FileReader();
                reader.onload = function() {
                    pdpImage.src = reader.result;
                }
                reader.readAsDataURL(selectedFile);
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            const icon = this.querySelector('i');
            icon.classList.toggle('bx-low-vision');
            icon.classList.toggle('bx-show');
        });
    });
</script>


@endsection
