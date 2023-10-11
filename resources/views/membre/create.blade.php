@extends('layouts.app')

@section('content')
<section class=" block w-10/12 mx-auto ">
    <div class="relative usersection">
        <h3 class="text-base pl-2 mb-5">Membres / Creation</h3>
        <form action="{{ route('membre.store') }}" method="POST" enctype="multipart/form-data">
            @csrf


            @if ($errors->any())
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
                       icon: 'warning',
                       title: 'Veuillez remplir les champs obligatoires'
                     })
               </script>
                  
               @endif 
            <div class="bounceslideInFromRight max-w-5xl mx-auto">

                <div class=" p-5 crud-card">
                    <h4 class="mb-5 font-semibold">Un nouveau membre dans l'equipe ?</h4>
                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class="w-1/12"><i class="text-2xl">@</i></div>
                        <input type="text" name='membre-nom' placeholder="Nom complet" class="w-11/12  bg-none" value='{{ old('membre-nom') }}'>
                    </div>
                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class="w-1/12"><i class="text-2xl fa fa-layer-group"></i></div>
                        <input type="text" name='membre-poste' placeholder="Poste au sein de l'ONG" class="w-11/12  bg-none" value='{{ old('membre-poste') }}'>
                    </div>
                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class=" w-1/12"><i class="text-2xl fa fa-id-badge"></i></div>
                        <textarea name="membre-description" id="" cols="30" rows="10" class="w-11/12 bg-none" placeholder="Description" value='{{ old('membre-description') }}'></textarea>
                    </div>
                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class="w-1/12"><i class="text-2xl bx bx-calendar" ></i></div>
                        <input type="date" name='membre-adhesion'  class="w-11/12  bg-none" value='{{ old('membre-adhesion') }}'>
                    </div>
                    <div class="my-5 flex justify-center items-center">
                        <div class="relative h-20 w-20">
                            <img src="{{ asset('images/sans-image/nopdp.png') }}" alt="" id="membre-pdp" class=" h-full w-full border border-gray-600 rounded-full">
                            <label class="cursor-pointer absolute bottom-0 right-0" for="membre-pdp"><i class="text-white bg-gray-600 border border-gray-600 rounded-full bx bx-camera"></i></label>
                            <div class="hidden">
                                <input type="file" name="membre-pdp" accept="images/*" >
                            </div>
                        </div> 
                    </div>
                    <div class="h-10 ">
                          <button class="float-right bg-green-500 hover:bg-green-600 text-white">Enregistrer</button>
                    </div>
                   
                    
                </div>

               

            </div>
        </form>
        <a href="{{ route('membre.index') }}" class="absolute -top-2 -left-10  "><i class="text-4xl bx bx-chevron-left"></i></a>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const label = document.querySelector('label[for="membre-pdp"]');
        const inputFile = document.querySelector('input[type="file"]');
        const pdpImage = document.getElementById('membre-pdp');

        label.addEventListener('click', function() {
            inputFile.click();
        });

        inputFile.addEventListener('change', function() {
            const selectedFile = this.files[0];
            if (selectedFile) {
                const reader = new FileReader();
                reader.onload = function() {
                    pdpImage.src = reader.result;
                }
                reader.readAsDataURL(selectedFile);
            }
        });
    });
</script>
  
</section>


            



@endsection