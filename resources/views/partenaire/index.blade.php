@extends('layouts.app')

@section('content')
<main class="max-w-4xl ">
    <section>
        <div class="flex justify-between items-center mb-5">
            <h1 class="show_to_Left">Blogs</h1>
            <a class="show_to_Right" href="{{ route('partenaire.create') }}"><button class="bg-green-500 text-white hover:bg-green-600 ">Nouveau Partenaire</button></a>

        </div>
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
        <div class="show_to_Center table_content">
            <div class="p-0 m-0  table_filter">
                <div>
                    <ul class="list-none justify-start flex p-0 m-0 table_filter_list">
                        <li>
                            <p class="mt-2 mb-3 cursor-pointer link-active">Tous</p>
                        </li>
                    </ul>
                </div>
            </div>

            <form action="{{ route('partenaire.index') }}" accept-charset="UTF-8" role="search" method="GET">
                <div class="px-0 py-8 mt-2 grid table_search">   
                    <div class="relative">
                        <button class="appearance-none w-full border-none mt-1 text-base rounded-t-sm rounded-bl-sm search_select">
                           Chercher un partenaire
                        </button>
                      
                    </div>
                    <div class="mt-1 relative">
                        <input class="w-full border-none rounded-tr-sm rounded-br-sm pl-9 py-2 text-base search_input" type="text" name="search" placeholder="Chercher un partenaire..." name="search" value="{{ request('search') }}">
                        <i class="top-3 right-3 absolute fa fa-search"></i>
                    </div>
                </div>
            </form>

            <div class="px-0 py-8 gap-3 grid text-sm font-medium text-center  table_part_head">
                <p>Logo</p>
                <p>Nom du partenaire</p>
                <p>Abreviation</p>
                <p>Status</p>
                <p>Action</p>
                <p>Publier</p>
            </div>

            <div class="relative gap-3 grid items-center text-center table_part_body">
                @if (count($partenaire) > 0)
                    @foreach ($partenaire as $part )
                        <div class="grid gap-3 py-3 items-center tab_content"> 
                            <div data-title="Logo" class="pl-5">
                                <a href="{{ route('partenaire.show',$part->id) }}">
                                 <img src="{{ asset('images/logo/'.$part->logo )}}" alt="" width="30px" height="30px">
                                </a>
                            </div>
                            <a href="{{ route('partenaire.show',$part->id) }}"><p data-title="Nom du partenaire" class="font-extrabold">{{ $part->nom }}</p></a>
                       
                            <p data-title="Abreviation">{{ $part->abreviation }}</p>
                            <p data-title="Status">{{ $part->status_part}}</p>
                            <div class="text-center btn_modif_supr" data-title="Action">     
                                <div class="grid grid-cols-2 ">
                                    <a href="{{ route('partenaire.edit',$part->id) }}">
                                        <button class="btn relative  mt-0 h-5 text-white bg-blue-500 hover:bg-blue-700" >
                                            <i class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-xs fa fa-pencil-alt" ></i> 
                                        </button>
                                    </a>
                                    <form class="w-5" action="{{ route('partenaire.destroy' ,$part->id )}}" method="POST">
                                        @method('delete')
                                        @csrf
        
                                        <button class="btn relative mt-0 h-5 text-white bg-red-500 hover:bg-red-700" onclick="deleteConfirm(event)" >
                                            <i class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-xs fa fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                               
                              
                            </div>
                            <form class="w-9 translate-x-14" action=" {{ route('partenaire.publish', $part->id) }}  " method="post">
                                @csrf
                                @method('put')
                                <div data-title="Publier">
                                    
                    
                                        <label class="tab_switch" for="checkbox_{{ $part->id }}" >
                                            <input type="hidden" name="hidden_id" value="{{ $part->id }}">      
                                            <input type="checkbox"   class="toggle-checkbox checkboxpart hidden" name="status"  id="checkbox_{{ $part->id }}" @if ($part->status_part =='Publier') @checked(true)  @endif   onchange="publishConfirm(event)"  >
                                            <span class="tab_slider"></span>
                                          </label>
                                     </div>
                            </form>
                        </div>
                      
                    @endforeach
                @else
                <div class="text-center w-full h-14 ">
                    <p>Aucun enregistrement ne correspond a votre recherche </p>
                </div>
                @endif
                
            </div>

            <div class="mt-16 lg:mt-12 w-56 ml-auto mb-4 mr-8 items-center float-right flex table_paginate">
                {{ $partenaire->links('layouts.pagination') }}
            </div>

        </div>
    </section>
</main>

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
       var checkbox = form.querySelector('.checkboxpart');
   
       if (checkbox.checked==true) {     
               Swal.fire({
                   title: 'Voulez vous afficher ce partenaire ?',
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
                   text:'vous pouvez toujours afficher ce partenaire',
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

