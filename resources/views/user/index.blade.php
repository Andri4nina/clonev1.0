@extends('layouts.app')

@section('content')
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
<section class="bounceslideInFromRight block w-10/12 mx-auto ">
    
    <div class="usersection">
        <h3 class="text-base pl-2 mb-5">Utilisateurs</h3>
        <div class="p-5 min-w-4xl crud-card">
            <div class="top-card">
                <h4>Tous les utilisateurs</h4>
                <div class="w-full">
                    <div class="">
                        <form action="{{ route('utilisateur.create') }}" class="float-right">
                            <button class="flex justify-around items-center btn-add"><span>Nouvel utilisateur</span><div class="relative"><i class=" bx bx-user-plus"></i></div></button>
                        </form>
                    </div>
                    <br>
                    <form action="{{ route('utilisateur.index') }}" class="my-5">
                        <div class="flex justify-center items-center relative">
                            <button class="w-2/12 text-center btn-search">Rechercher</button>
                            <input class="w-10/12" type="text" placeholder="Chercher un utilisateur" name="search"  value="{{ request('search') }}">
                            <button class="absolute right-2">
                                <i class="bx bx-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
               
            </div>
            <div class="relative crud-list">
                <table class=" text-center min-w-full">
                    <thead class="">
                        <tr>
                            <th class="px-4 py-2">Profil</th>
                            <th class="px-4 py-2">Rôle</th>
                            <th class="px-4 py-2">Ancienneté</th>
                            <th class="px-4 py-2">Adresse e-mail</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($utilisateur) > 0)
                            @foreach ($utilisateur as $user)
                                <tr class="">
                                    <td class="px-4 pt-4 flex justify-center items-center gap-2 ">
                                        <img src="{{ asset('images/pdp/'.$user->pdp )}}"alt="{{ $user->name }} pdp" class="w-10 h-10 object-cover rounded-full">
                                        <a href="{{ route('utilisateur.profil') }}" class="px-4 py-1"><span>{{ $user->name }}</span></a>
                                    </td>
                                    <td class="px-4 py-2">{{ $user->role_user }}</td>
                                    <td class="px-4 py-2">{{ $user->anciennete }}</td>
                                    <td class="px-4 py-2">{{ $user->email }}</td>
                                    <td class="flex justify-center items-center  gap-2 px-4 py-2 -translate-y-1/4">
                                        <form action="">
                                            <button class="border text-purple-500 border-purple-500 hover:bg-purple-500 hover:text-white font-bold"><i class="bx bx-message"></i></button>
                                        </form>
                                        <form action="{{ route('utilisateur.edit' ,$user->id )}}">
                                            <button class="border text-blue-500 border-blue-500 hover:bg-blue-500 hover:text-white  font-bold "><i class="bx bx-pencil"></i></button>
                                        </form>
                                        <form action="{{ route('utilisateur.destroy' ,$user->id )}}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button class="border text-red-500 border-red-500 hover:bg-red-500 hover:text-white font-bold "onclick="deleteConfirm(event)"><i class="bx bx-trash"></i></button>
                                        </form>
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
                
                <div class=" mt-20  mb-5 flex justify-center items-center">
                    {{ $utilisateur->links('layouts.pagination') }}
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
                title: 'Etes vous sur de vouloir supprimer cette utilisateur ?',
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