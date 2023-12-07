@extends('layouts.app')

@section('content')
<section class=" block max-w-6xl w-full mx-auto ">
    <div class="usersection">
        <h3 class="bounceslideInFromLeft text-2xl pl-2 mb-5 font-semibold">Blogs</h3>
        <div class="overflow-hidden bounceslideInFromRight p-5 min-w-full crud-card">
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
            <div class="top-card">
                <h4>Tous les blogs</h4>
                <div class="w-full">
                    <div class="">
                        <form action="{{ route('blog.create') }}" class="float-right">
                            <button class="flex justify-around items-center btn-add"><span>Nouvel blog </span><div class="relative ml-2"><i class=" fas fa-feather-alt"></i><i class="text-sm">+</i></div></button>
                        </form>
                    </div>
                    <br>
                    <form action="{{ route('blog.index') }}" class="my-5">
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
            <div class="overflow-x-scroll relative crud-list">
                <table class="relative text-center min-w-full tableBlog">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Titre</th>
                            <th class="px-4 py-2">Date de creation</th>
                            <th class="px-4 py-2">Date de publication</th>
                            <th class="px-4 py-2">Auteur</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Actions</th>
                            <th class="px-4 py-2">Publier</th>
                        </tr>
                    </thead>
                    <tbody class="relative ">
                        @if (count($blogs) > 0)
                            @foreach ($blogs as $blog)
                                <tr class="justify-center items-center">
                                    <td data-label="Titre" class="px-4 py-2 flex justify-center  gap-2 ">
                                        <a href="{{ route('blog.show',$blog->id) }}" class=" py-1"><span>{{$blog->titre_blog}}</span></a>
                                    </td>

                                    <td data-label="Date de creation" class="px-4 py-2"> {{ $blog->created_at }}</td>
                                    <td data-label="Date de publication" class="px-4 py-2"> {{ $blog->date_publi_blog }}</td>
                                    <td data-label="Auteur" class="px-4 py-2"> {{ $blog->author_name }}</td>
                                    <td data-label="Status" class="px-4 py-2">{{ $blog->status_blog }}</td>
                                    <td data-label="Actions" class="w-auto">
                                        <div class="flex justify-center items-center  gap-2  my-auto ">
                                            @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_update_blog == "1" && Auth::user()->id == $blog->user_id))
                                                <form action="{{ route('blog.edit',$blog->id) }}" >
                                                    <button class="border text-blue-500 border-blue-500 hover:bg-blue-500 hover:text-white  font-bold "><i class="bx bx-pencil"></i></button>
                                                </form>
                                            @else
                                                <button class="grayscale border text-blue-500 border-blue-500 hover:bg-blue-500 hover:text-white  font-bold "><i class="bx bx-pencil"></i></button>
                                            @endif
                                            @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_delete_blog == "1" && Auth::user()->id == $blog->user_id))
                                                <form action="{{ route('blog.destroy',$blog->id) }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <input type="hidden" name="the_user" value=" {{\Illuminate\Support\Facades\Auth::user()->name}}">
                                                    <button class="border text-red-500 border-red-500 hover:bg-red-500 hover:text-white font-bold "onclick="deleteConfirm(event)"><i class="bx bx-trash"></i></button>
                                                </form>
                                            @else
                                                <button class="grayscale border text-red-500 border-red-500 hover:bg-red-500 hover:text-white font-bold "onclick="deleteConfirm(event)"><i class="bx bx-trash"></i></button>
                                            @endif



                                        </div>
                                    </td>
                                    <td data-label="Publier" class="px-4 py-2">
                                        @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_delete_blog == "1" && Auth::user()->id == $blog->user_id))
                                            <form action="{{ route('blog.publish') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="the_user" value=" {{\Illuminate\Support\Facades\Auth::user()->name}}">

                                                <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                                    <input type="hidden" name='hidden_id' value="{{ $blog->id }}">
                                                    <input class="form-checkbox" type="checkbox" id="publier{{ $blog->id }}" name="status" @if ($blog->status_blog =='Publier') @checked(true)  @endif   onchange="publishConfirm(event)" >
                                                    <label class="ml-2" for="publier{{ $blog->id }}"></label>
                                                </div>
                                            </form>
                                        @else
                                            <div class="grayscale flex justify-center items-center mb-2 prvlg-switcher">
                                                <input class="form-checkbox" disabled type="checkbox" id="publier" name="status" @if ($blog->status_blog =='Publier') @checked(true)  @endif   onchange="publishConfirm(event)" >
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
                    {{ $blogs->links('layouts.pagination') }}
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
                title: 'Etes vous sur de vouloir supprimer ce blog ?',
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
                   title: 'Voulez vous publier ce blog ?',
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
                   title: 'Voulez-vous archiver ce blog ?',
                   text:'vous pouvez toujours publier ce blog',
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
