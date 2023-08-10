@extends('layouts.app')

@section('content')
    <main class="w-full max-w-4xl mt-20 ">
        <section>
            <form action="{{ route('utilisateur.update',$utilisateur->id) }}" method="post" enctype="multipart/form-data">
                @csrf

                @method('PUT')
                <div class="flex justify-between items-center mb-5 ">
                    <h1 class="show_to_Top">Modifier Utilisateur</h1>
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
                         <input type="text" name="name" value={{ $utilisateur->name }}>
                         <label class="text-lg font-bold">Email</label>
                         <input type="email" name="email" value={{ $utilisateur->email }}>
                        
                         <label class="text-lg font-bold">Role</label>
                         <select name="role_user" id="role_user">
                            <option value="Administrateur" @if ($utilisateur->role_user === 'Administrateur') selected @endif>Administrateur</option>
                            <option value="Moderateur" @if ($utilisateur->role_user === 'Moderateur') selected @endif>Moderateur</option>
                            <option value="Stagiaire" @if ($utilisateur->role_user === 'Stagiaire') selected @endif>Stagiaire</option>
                        </select>
                     </div>
                    <div class="show_to_Right">
                         <label class="text-lg font-bold">Privilege de l'utilisateur</label>
                       
                        <hr>
                        <label for="super_privi"><span  class="text-base font-bold">Super-utilisateur </span></label>
                        
                            <label for="super_creat_privi"><span  class="text-base font-bold">Creation des Super-utilisateurs </span><input class="global_check super_check" type="checkbox" name="check_crea_super" id="check_crea_super" @if ($utilisateur->prvlg_creation_super_user) checked @endif></label>
                            <label for="super_suppr_privi"><span  class="text-base font-bold">Suppression des Super-utilisateurs </span><input class="global_check super_check" type="checkbox" name="check_suppr_super" id="check_suppr_super" @if ($utilisateur->prvlg_suppression_super_user) checked @endif></label>
                       
                        <hr>
                        <label for="admin_privi"><span  class="text-base font-bold">Administration </span></label>
             
                            <label for="user_creat_privi"><span  class="text-base font-bold">Creation des utilisateurs </span><input class="global_check  admin_check" type="checkbox" name="check_creat_user" id="check_creat_user" @if ($utilisateur->prvlg_creation_user) checked @endif></label>
                            <label for="user_suppr_privi"><span  class="text-base font-bold">Suppression des utilisateurs </span><input class="global_check  admin_check" type="checkbox" name="check_suppr_user" id="check_suppr_user" @if ($utilisateur->prvlg_suppression_user) checked @endif></label>
                            <label for="approb_privi"><span  class="text-base font-bold">Approbation des blogs </span><input class="global_check  admin_check" type="checkbox" name="check_approb_blog" id="check_approb_blog" @if ($utilisateur->prvlg_approb_blog ) checked @endif></label>
                            <label for="blog_privi"><span  class="text-base font-bold"> Gestion des blogs </span><input class="global_check  admin_check" type="checkbox" name="check_gest_blog" id="check_gest_blog" @if ($utilisateur->prvlg_publi_blog ) checked @endif></label>
                        <hr>
                        <label for="donne_privi"><span  class="text-base font-bold">Donnee </span></label>
                        
                            <label for="creat_privi"><span  class="text-base font-bold">Creation  </span><input class="global_check donne_check" type="checkbox" name="check_creat" id="check_creat"  @if ($utilisateur->prvlg_creation ) checked @endif ></label>
                            <label for="suppr_privi"><span  class="text-base font-bold">Suppression </span><input class="global_check donne_check" type="checkbox" name="check_suppr" id="check_suppr" @if ($utilisateur->prvlg_suppression ) checked @endif></label>
                            <label for="modif_privi"><span  class="text-base font-bold">Modification  </span><input class="global_check donne_check" type="checkbox" name="check_modif" id="check_modif" @if ($utilisateur->prvlg_modification ) checked @endif></label>              
                        
                    </div>
                 </div>

                 <div class="flex sm:float-right sm:mr-5 items-center mb-5 titlebar show_to_Right">
                    <input type="hidden" name="hidden_id" value='{{ $utilisateur->id }}'>
                     <button class="bg-green-500 hover:bg-green-600 text-white">Enregistrer</button>
                 </div>


            </form>
        </section>
    </main>


@endsection





