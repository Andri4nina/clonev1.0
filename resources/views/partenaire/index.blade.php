@extends('layouts.app')

@section('content')
<section class=" block max-w-6xl w-full mx-auto ">
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
    <h3 class="bounceslideInFromLeft text-2xl pl-2 mb-5 font-semibold">Partenaires</h3>
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
                <table class="text-center min-w-full tablePart">
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
                                <td data-label="Logo" class="px-4 py-2 flex justify-center  gap-2 ">
                                    <div class=" h-10 w-10 rounded-full overflow-hidden">
                                    <a href="{{ route('partenaire.show',$part->id) }}"> <img src="{{ asset('images/pdp-partenaire/'.$part->logo_partenaire) }}" alt="" class="nopdpimg object-cover w-full h-full"></a>
                                    </div>
                                </td>
                                <td data-label="Nom du partenaire" class="px-4 py-2"><a href="{{ route('partenaire.show',$part->id) }}">{{ $part->nom_partenaire }}</a></td>
                                <td data-label="Abbreviation" class="px-4 py-2">{{ $part->abbrev_partenaire }}</td>
                                <td data-label="Date de relation" class="px-4 py-2">{{ $part->date_relation_partenaire }}</td>
                                <td data-label="Status" class="px-4 py-2">{{ $part->status_partenaire }}</td>
                                <td data-label="Actions" class="w-auto">
                                    <div class="flex justify-center items-center  gap-2 ">
                                        @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_partenaire == "1"))
                                            <form action="{{ route('partenaire.edit' ,$part->id )}}">
                                                <button class=" border text-blue-500 border-blue-500 hover:bg-blue-500 hover:text-white  font-bold "><i class="bx bx-pencil"></i></button>
                                            </form>
                                            <form action="{{ route('partenaire.destroy' ,$part->id )}}" method="POST">
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

                                <td data-label="Publier" class="px-4 py-2">

                                @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_partenaire == "1"))
                                    <form action="{{ route('partenaire.publish') }}" method="POST">
                                        @csrf
                                        <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                            <input type="hidden" name="the_user" value=" {{\Illuminate\Support\Facades\Auth::user()->name}}">

                                            <input type="hidden" name='hidden_id' value="{{ $part->id }}">
                                            <input class="form-checkbox" type="checkbox" id="publier{{ $part->id }}" name="status" @if ($part->status_partenaire =='Publier') @checked(true)  @endif   onchange="publishConfirm(event)" >
                                            <label class="ml-2" for="publier{{ $part->id }}"></label>
                                        </div>
                                    </form>
                                @else
                                <div class="grayscale flex justify-center items-center mb-2 prvlg-switcher">

                                    <input disabled class="form-checkbox" type="checkbox" id="publier" name="status" @if ($part->status_partenaire =='Publier') @checked(true)  @endif   onchange="publishConfirm(event)" >
                                    <label class="ml-2" for="publier"></label>
                                </div>
                                @endif
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
                    {{ $partenaire->links('layouts.pagination') }}
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



<script>
    window.publishConfirm = function(e) {
       var form = e.target.form;
       var checkbox = form.querySelector('.form-checkbox');

       if (checkbox.checked==true) {
               Swal.fire({
                   title: 'Voulez vous publier ce partenaire ?',
                   icon: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#1F9B4F',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Oui, publier!',
                   cancelButtonText: 'Annuler'
               }).then((result) => {
                   if (result.isConfirmed) {
                   form.submit();
                   }else{
                       checkbox.checked = false;
                   }
               })
           }else{
               Swal.fire({
                   title: 'Voulez-vous archiver ce partenaire ?',
                   text:'vous pouvez toujours publier ce partenaire',
                   icon: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#1F9B4F',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Oui, archiver!',
                   cancelButtonText: 'Annuler'
               }).then((result) => {
                   if (result.isConfirmed) {
                   form.submit();
                   }else{
                       checkbox.checked = true;
                   }
               })
           }
       }

</script>

@endsection
