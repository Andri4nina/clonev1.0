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
    <h3 class="bounceslideInFromLeft text-2xl pl-2 mb-5 font-semibold">Projects</h3>
        <div class="bounceslideInFromRight  p-5 min-w-4xl crud-card">
            <div class="top-card">
                <h4>Tous les projects</h4>
                <div class="w-full">
                    <div class="">
                        <form action="{{ route('project.create') }}" class="float-right">
                            <button class="flex justify-around items-center btn-add"><span>Nouvel project</span><div class="ml-2 relative"><i class=" fas fa-cogs"></i><i class="text-sm">+</i></div></button>
                        </form>
                    </div>
                    <br>
                    <form action="{{ route('project.index') }}" class="my-5">
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
                <table class="text-center min-w-full tableProj">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Titre</th>
                            <th class="px-4 py-2">Date de creation</th>
                            <th class="px-4 py-2">Date de publication</th>
                            <th class="px-4 py-2">Zone d'activite</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Actions</th>
                            <th class="px-4 py-2">Publier</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($project) > 0)
                            @foreach ($project as $proj)
                                <tr class="">
                                    <td data-label="Titre" class="px-4 py-2 flex justify-center  gap-2 ">
                                        <a href="{{ route('project.show',$proj->id ) }}" class="px-4 py-1"><span>{{ $proj->titre_project }}</span></a>
                                    </td>
                                    <td data-label="Date de creation" class="px-4 py-2">{{ $proj->created_at }}</td>
                                    <td data-label="Date de publication" class="px-4 py-2">{{ $proj->date_publi_project }}</td>
                                    <td data-label="Zone d'activite" class="px-4 py-2">{{ $proj->zone_project }}</td>
                                    <td data-label="Status" class="px-4 py-2">{{ $proj->status_project }}</td>
                                    <td data-label="Actions" class="w-auto">
                                        <div class="flex justify-center items-center  gap-2 ">
                                            @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_partenaire == "1"))
                                                <form action="{{ route('project.edit',$proj->id) }}">
                                                    <button class="border text-blue-500 border-blue-500 hover:bg-blue-500 hover:text-white  font-bold "><i class="bx bx-pencil"></i></button>
                                                </form>
                                                <form action="{{ route('project.destroy' ,$proj->id )}}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                        <input type="hidden" name="the_user" value=" {{\Illuminate\Support\Facades\Auth::user()->name}}">

                                                    <button class="border text-red-500 border-red-500 hover:bg-red-500 hover:text-white font-bold "onclick="deleteConfirm(event)"><i class="bx bx-trash"></i></button>
                                                </form>
                                                @else
                                                    <button disabled class="grayscale border text-blue-500 border-blue-500 hover:bg-blue-500 hover:text-white  font-bold "><i class="bx bx-pencil"></i></button>
                                                    <button disabled class="border grayscale text-red-500 border-red-500 hover:bg-red-500 hover:text-white font-bold "onclick="deleteConfirm(event)"><i class="bx bx-trash"></i></button>
                                                @endif
                                        </div>

                                    </td>

                                    <td data-label="Publier" class="px-4 py-2">
                                        @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_partenaire == "1"))
                                            <form action="{{ route('project.publish') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="the_user" value=" {{\Illuminate\Support\Facades\Auth::user()->name}}">

                                                <input type="hidden" name='hidden_id' value="{{ $proj->id }}">
                                                <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                                    <input class="form-checkbox" type="checkbox" id="publier{{ $proj->id }}" name="status" @if ($proj->status_project =='Publier') @checked(true)  @endif   onchange="publishConfirm(event)"  >
                                                    <label class="ml-2" for="publier{{ $proj->id }}"></label>
                                                </div>
                                            </form>
                                        @else
                                            <div class="grayscale flex justify-center items-center mb-2 prvlg-switcher">
                                                <input disabled class="form-checkbox" type="checkbox" id="publier" name="status" @if ($proj->status_project =='Publier') @checked(true)  @endif   onchange="publishConfirm(event)"  >
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
                    {{ $project->links('layouts.pagination') }}
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
                title: 'Etes vous sur de vouloir supprimer ce project ?',
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
                   title: 'Voulez vous publier ce project ?',
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
                   title: 'Voulez-vous archiver ce project ?',
                   text:'vous pouvez toujours publier ce project',
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
