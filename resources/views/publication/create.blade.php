@extends('layouts.app')
@vite('resources/css/user.css')

@section('content')
    <main class="w-full max-w-4xl mt-20 mx-auto">
        <section>
            <form action="{{ route('publication.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex justify-between items-center mb-5 ">
                    <h1>Ajouter Blog</h1>
                </div>
                @if ($error->any())
                    <div>
                        <ul>
                            @foreach ( $errors->all() as $error )
                            <li>{{ $error }}</li>
                                
                            @endforeach
                        </ul>
                    </div>
                    
                @endif
                <div class="grid gap-5 overflow-hidden card">
                   <div>
                        <label class="text-lg font-bold">Titre *</label>
                        <input type="text" name="titre_publi">
                        <label class="text-lg font-bold">Sous-titre</label>
                        <input type="text" name="sous_titre_publi">
                        <label class="text-lg font-bold">Description</label>
                        <textarea cols="10" rows="5" name="contenu_publi"></textarea>
                        <label class="text-lg font-bold">Piece jointe</label>
                        <input type="file" >
                    </div>
                   <div>
                        <label class="text-lg font-bold">Image de couverture</label>
                        <img src="" alt="" class="w-full pb-5 h-52 img_couv" id="img_couv_view" />
                        <input type="file" name="img_couv_publi" accept="image/*" onchange="showFile(event)" >
                     
                        <hr>
                        <label class="text-lg font-bold">Autre Media</label>
                        <img src="" alt="" class="autre_media" />
                        <input type="file" >   
                        <hr>
                   </div>
                </div>
                <div class="flex sm:float-right sm:mr-5 items-center mb-5 titlebar">
                    
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