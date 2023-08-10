@extends('layouts.app')

@section('content')
<main class="w-full max-w-4xl mt-20">
    <section>
        <form action="{{ route('partenaire.update',$partenaire->id) }}" method="post" enctype="multipart/form-data">
            @csrf

            @method('PUT')
            <div class="flex justify-between items-center mb-5 ">
                <h1 class="show_to_Top">Modifier Partenaire</h1>
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
                    <label class="text-lg font-bold">Nom du partenaire *</label>
                    <input type="text" name="nom" value="{{ $partenaire->nom }}">
                    <label class="text-lg font-bold">Abreviation</label>
                    <input type="text" name="Abreviation" value="{{ $partenaire->abreviation }}">
                    <label class="text-lg font-bold">Histoire</label>
                    <textarea cols="10" rows="5" name="Histoire">{{ $partenaire->histoire }}</textarea>
             
                </div>
               <div class="show_to_Right">
                    <label class="text-lg font-bold">Logo</label>
                    <img src="{{ asset('images/logo/'.$partenaire->logo)}}" alt="" class="w-full pb-5 h-52 img_couv" id="img_logo" />
                    <input type="file" name="image" accept="images/*" onchange="showFile(event)" >
                    <input type="hidden" name='hidden_logo_image' value="{{ $partenaire->logo }}">
                     
                
                    <label class="text-lg font-bold">Url</label>
                    <input type="text" name="url" value="{{$partenaire->url}}">
                    
               </div>
            </div>
            <div class="flex sm:float-right sm:mr-5 items-center mb-5 titlebar show_to_Right">
                <input type="hidden" name="hidden_id" value='{{ $partenaire->id }}'>
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
            var output = document.getElementById('img_logo');
            output.src = dataURL;
        };

        reader.readAsDataURL(input.files[0]);
    }
</script>
@endsection