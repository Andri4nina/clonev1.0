@extends('layouts.app')

@section('content')
<main class="max-w-4xl ">
    <section>
        <div class="flex justify-between items-center mb-5">
            <h1 class="show_to_Left">Blogs</h1>
            <a class="show_to_Right" href="{{ route('publication.create') }}"><button class="bg-green-500 text-white hover:bg-green-600 ">Nouveau Blog</button></a>

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

            <form action="{{ route('publication.index') }}" accept-charset="UTF-8" role="search" method="GET">
                <div class="px-0 py-8 mt-2 grid table_search">   
                    <div class="relative">
                        <button class="appearance-none w-full border-none mt-1 text-base rounded-t-sm rounded-bl-sm search_select">
                           Chercher un blog
                        </button>
                      
                    </div>
                    <div class="mt-1 relative">
                        <input class="w-full border-none rounded-tr-sm rounded-br-sm pl-9 py-2 text-base search_input" type="text" name="search" placeholder="Chercher un blog..." name="search" value="{{ request('search') }}">
                        <i class="top-3 right-3 absolute fa fa-search"></i>
                    </div>
                </div>
            </form>

            <div class="px-0 py-8 gap-3 grid text-sm font-medium text-center  table_publi_head">
               
                <p>Titre du blog</p>
                <p>Date de creation</p>
                <p>Date de derniere publication </p>
                <p>Status</p>
                <p>Editeur</p>
                <p>Action</p>
                <p>Publier</p>
            </div>

            <div class="relative gap-3 grid items-center text-center table_publi_body">
             
                @if (count($publication) > 0)
                    @foreach ($publication as $pub )
                        <div class="grid gap-3 py-3 tab_content"> 
                            <div data-title="Titre"><a href="{{ route('publication.show',$pub->id) }}"><p class="font-extrabold" >{{ $pub->titre_publi }}</p></a></div>
                            <p data-title="Date de creation">{{ $pub->created_at }}</p>
                            <p data-title="Date de publication ">{{ $pub->date_publi}}</p>
                            <p data-title="Status">{{ $pub->status_publi }}</p>
                            <p data-title="Editeur">{{ $pub->name }}</p>
                            <div class="text-center btn_modif_supr" data-title="Action">     
                                <div class="grid grid-cols-2 ">
                                    <a href="{{ route('publication.edit',$pub->id) }}">
                                        <button class="btn relative  mt-0 h-5 text-white bg-blue-500 hover:bg-blue-700" >
                                            <i class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-xs fa fa-pencil-alt" ></i> 
                                        </button>
                                    </a>
                                    <form class="w-5" action="{{ route('publication.destroy' ,$pub->id )}}" method="POST">
                                        @method('delete')
                                        @csrf
        
                                        <button class="btn relative mt-0 h-5 text-white bg-red-500 hover:bg-red-700" onclick="deleteConfirm(event)" >
                                            <i class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-xs fa fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
     
                            </div>
                            <form class="translate-x-2 pt-3" action=" {{ route('publication.publish', $pub->id) }}  " method="post">
                                @csrf
                                @method('put')
                
                                <div data-title="Publier">
                                     <label class="tab_switch" for="checkbox_{{ $pub->id }}" >
                                        <input type="hidden" name="hidden_id" value="{{ $pub->id }}">      
                                        <input type="checkbox"   class="toggle-checkbox checkboxpubli hidden" name="status"  id="checkbox_{{ $pub->id }}" @if ($pub->status_publi =='Publier') @checked(true)  @endif   onchange="publishConfirm(event)"  >
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
                {{ $publication->links('layouts.pagination') }}
            </div>

        </div>
    </section>
</main>

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
        var checkbox = form.querySelector('.checkboxpubli');
    
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

