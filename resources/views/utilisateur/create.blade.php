@extends('layouts.app')

@section('content')
    <main class="w-full max-w-4xl mt-20 ">
        <section>
            <form action="{{ route('utilisateur.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex justify-between items-center mb-5 ">
                    <h1 class="show_to_Top">Ajouter Utilisateur</h1>
                </div>
          
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
                        title: 'Veuillez remplir les champs obligatoires'
                      })
                </script>
                   
                @endif

                <div class="grid gap-5  card">
                    <div class="show_to_Left">
                         <label class="text-lg font-bold">Nom d'utilisateur *</label>
                         <input type="text" name="name">
                         <label class="text-lg font-bold">Email</label>
                         <input type="email" name="email">
                         <label class="text-lg font-bold">Mot de passe</label>
                         <input type="password" name="password">
                         <label class="text-lg font-bold">Confirmation de mot de passe</label>
                         <input type="password" name="confirmation">
                         <label class="text-lg font-bold">Role</label>
                        <select name="role_user" id="role_user">
                            <option value="Administrateur">Administrateur</option>
                            <option value="Moderateur">Moderateur</option>
                            <option value="Stagiaire">Stagiaire</option>
                        </select>
                         
                     </div>
                    <div class="show_to_Right">
                         <label class="text-lg font-bold">Privilege de l'utilisateur</label>
                                <hr>
                                <label for="super_privi"><span  class="text-base font-bold">Super-utilisateur </span></label>
                                
                                <label for="super_creat_privi"><span  class="text-base font-bold">Creation des Super-utilisateurs </span><input class="global_check super_check" type="checkbox" name="check_crea_super" id="check_crea_super"></label>
                                <label for="super_suppr_privi"><span  class="text-base font-bold">Suppression des Super-utilisateurs </span><input class="global_check super_check" type="checkbox" name="check_suppr_super" id="check_suppr_super"></label>
      
                         
                                <hr>
                                <label for="admin_privi"><span  class="text-base font-bold">Administration </span></label>     
                                <label for="user_creat_privi"><span  class="text-base font-bold">Creation des utilisateurs </span><input class="global_check  admin_check" type="checkbox" name="check_creat_user" id="check_creat_user"></label>
                                <label for="user_suppr_privi"><span  class="text-base font-bold">Suppression des utilisateurs </span><input class="global_check  admin_check" type="checkbox" name="check_suppr_user" id="check_suppr_user"></label>
                                <label for="approb_privi"><span  class="text-base font-bold">Approbation des blogs </span><input class="global_check  admin_check" type="checkbox" name="check_approb_blog" id="check_approb_blog"></label>
                                <label for="blog_privi"><span  class="text-base font-bold"> Gestion des blogs </span><input class="global_check  admin_check" type="checkbox" name="check_gest_blog" id="check_gest_blog"></label>
                                
                                <hr>

                                <label for="donne_privi"><span  class="text-base font-bold">Donnee </span></label>                              
                                <label for="creat_privi"><span  class="text-base font-bold">Creation  </span><input class="global_check donne_check" type="checkbox" name="check_creat" id="check_creat"></label>
                                <label for="suppr_privi"><span  class="text-base font-bold">Suppression </span><input class="global_check donne_check" type="checkbox" name="check_suppr" id="check_suppr"></label>
                                <label for="modif_privi"><span  class="text-base font-bold">Modification  </span><input class="global_check donne_check" type="checkbox" name="check_modif" id="check_modif"></label>
                    
                    </div>
                 </div>
                 <div class="flex sm:float-right sm:mr-5 items-center mb-5 titlebar show_to_Right">
                     <button class="bg-green-500 hover:bg-green-600 text-white">Enregistrer</button>
                 </div>


            </form>
        </section>
    </main>

    <script>
        function setCheckAllBehavior(masterCheckbox, checkboxes) {
            masterCheckbox.addEventListener("change", function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = masterCheckbox.checked;
                });
            });
    
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", function() {
                    if (!this.checked) {
                        masterCheckbox.checked = false;
                    } else {
                        const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
                        masterCheckbox.checked = allChecked;
                    }
                });
            });
        }

    
        const superCheckbox = document.getElementById("check_super");
        const checksuperboxes = document.querySelectorAll('.super_check');
        setCheckAllBehavior(superCheckbox, checksuperboxes);

        const AdminCheckbox = document.getElementById("check_admin");
        const checkadminboxes = document.querySelectorAll('.admin_check');
        setCheckAllBehavior(AdminCheckbox, checkadminboxes);

        const donneCheckbox = document.getElementById("check_donne");
        const checkdonneboxes = document.querySelectorAll('.donne_check');
        setCheckAllBehavior(donneCheckbox, checkdonneboxes);
    </script>

    <script>
        const globalCheckbox = document.getElementById("check_all");
        const checkboxes = document.querySelectorAll('.global_check');
       
        globalCheckbox.addEventListener("change", function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = globalCheckbox.checked;
            });
        });
    
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", function() {
                if (!this.checked) {
                    globalCheckbox.checked = false;
                } else {
                    const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
                    globalCheckbox.checked = allChecked;
                }
            });
        });
    </script>

    <script>
        const globalCheckbox = document.getElementById("check_all");
        const checkboxes = document.querySelectorAll('.global_check');
       
        globalCheckbox.addEventListener("change", function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = globalCheckbox.checked;
            });
        });
    
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", function() {
                if (!this.checked) {
                    globalCheckbox.checked = false;
                } else {
                    const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
                    globalCheckbox.checked = allChecked;
                }
            });
        });
    </script>

@endsection


