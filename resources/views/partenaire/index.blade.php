@extends('layouts.app')

@section('content')
<section class="block w-10/12 mx-auto ">
    <div class="usersection">
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
        <h3 class="text-base pl-2 mb-5">Partenaires</h3>
        <div class="bounceslideInFromRight p-5 min-w-4xl crud-card">
            <div class="top-card">
                <h4>Tous les partenaires</h4>
                <div class="w-full">
                    <div class="">
                        <form action="{{ route('partenaire.create') }}" class="float-right">
                            <button class="flex justify-around items-center btn-add"><span>Nouvel partenaire</span><div class="pl-2 relative"><i class="fa fa-handshake"></i><i class="text-sm">+</i></div></button>
                        </form>
                    </div>
                    <br>
                    <form action="{{ route('partenaire.index') }}" class="my-5">
                        <div class="flex justify-center items-center relative">
                            <button class="w-2/12 text-center btn-search">Rechercher</button>
                            <input class="w-10/12" type="text" name="search" placeholder="Chercher un partenaire">
                            <button class="absolute right-2">
                                <i class="bx bx-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
               
            </div>
            <div class="relative crud-list">
                <table class="text-center min-w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Logo</th>
                            <th class="px-4 py-2">Nom du partenaire</th>
                            <th class="px-4 py-2">Abbreviation</th>
                            <th class="px-4 py-2">Date de relation</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Actions</th>
                            <th class="px-4 py-2">Publier</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($partenaire) > 0)
                            @foreach ($partenaire as $part)
                            <tr class="">
                                <td class="px-4 py-2 flex justify-center  gap-2 ">
                                    <div class=" h-10 w-10 rounded-full overflow-hidden">
                                    <a href="{{ route('partenaire.show',$part->id) }}"> <img src="{{ asset('images/pdp-partenaire/'.$part->logo_partenaire) }}" alt="" class="object-cover w-full h-full"></a> 
                                    </div>
                                </td>
                                <td class="px-4 py-2"><a href="{{ route('partenaire.show',$part->id) }}">{{ $part->nom_partenaire }}</a></td>
                                <td class="px-4 py-2">{{ $part->abbrev_partenaire }}</td>
                                <td class="px-4 py-2">{{ $part->date_relation_partenaire }}</td>
                                <td class="px-4 py-2">{{ $part->status_partenaire }}</td>
                                <td class="flex justify-center items-center gap-2 px-4 -translate-y-1/3">
                                
                                    <form action="{{ route('partenaire.edit' ,$part->id )}}">
                                        <button class="border text-blue-500 border-blue-500 hover:bg-blue-500 hover:text-white  font-bold "><i class="bx bx-pencil"></i></button>
                                    </form>
                                    <form action="{{ route('partenaire.destroy' ,$part->id )}}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="border text-red-500 border-red-500 hover:bg-red-500 hover:text-white font-bold "onclick="deleteConfirm(event)"><i class="bx bx-trash"></i></button>
                                    </form>
                                </td>

                                <td class="px-4 py-2">
                                    <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                        <input class="form-checkbox" type="checkbox" id="publier" name="publier" >
                                        <label class="ml-2" for="publier"></label>
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
                    {{ view('layouts.pagination') }}
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
                title: 'Etes vous sur de vouloir supprimer ce partenaire ?',
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