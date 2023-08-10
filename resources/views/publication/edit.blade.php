@extends('layouts.app')

@section('content')
    <main class="w-full max-w-4xl mt-20">
        <section>
            <form action="{{ route('publication.update',$publication->id) }}" method="post" enctype="multipart/form-data">
                @csrf


                @method('PUT')
                <div class="flex justify-between items-center mb-5 ">
                    <h1 class="show_to_Left">Modifier Blog</h1>
                </div>
    
                      
                @if ($errors->any())
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
                @endif

                    
              
                <div class="grid gap-5 card">
                   <div class="show_to_Left">
                        <label class="text-lg font-bold">Titre *</label>
                        <input type="text" name="titre_publi" value="{{ $publication->titre_publi }}">
                        <label class="text-lg font-bold">Sous-titre</label>
                        <input type="text" name="sous_titre_publi" value="{{ $publication->sous_titre_publi }}">
                        <label class="text-lg font-bold">Description</label>
                        <textarea cols="10" rows="5" name="contenu_publi" value="{{ $publication->contenu_publi }}">{{ $publication->contenu_publi }}</textarea>
                        <label class="text-lg font-bold" >Piece jointe</label>
                        <input type="file" >
                    </div>
                   <div class="show_to_Right">
                        <label class="text-lg font-bold">Image de couverture</label>
                        <img src="{{ asset('images/couverture/'.$publication->img_couv_publi )}}" alt="" class="w-full pb-5 h-52 img_couv" id="img_couv_view" />
                        <input type="hidden" name='hidden_publi_image' value="{{ $publication->img_couv_publi  }}">
                        <input type="file" name="image" accept="image/*" onchange="showFile(event)" >
                     
                        <hr>
                        <label class="text-lg font-bold">Autre Media</label>
                        <img src="" alt="" class="autre_media" />
                        <input type="file" >   
                        <hr>
                   </div>
                </div>
                <div class="flex sm:float-right sm:mr-5 items-center mb-5 titlebar show_to_Right">
                    <input type="hidden" name="hidden_id" value='{{ $publication->id }}'>
                    <button class="bg-green-500 hover:bg-green-600 text-white">Enregistrer</button>
                </div>
            </form>
         
        </section>
    </main>


    <script>
        function showFile(event){
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function (){
                var dataURL =reader.result;
                var output = document.getElementById('img_couv_view');
                output.src = dataURL;
            };

            reader.readAsDataURL(input.files[0]);
        }
    </script>
    
@endsection