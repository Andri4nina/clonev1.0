@extends('layouts.app')

@section('content')
<section class=" block max-w-6xl w-full mx-auto ">
    <div class="relative usersection">
        <h3 class="bounceslideInFromLeft text-2xl pl-2 mb-5 font-semibold">        <a href="{{ route('project.index') }}"  ><i class="text-4xl bx bx-chevron-left"></i></a> Project / <small>Creation</small></h3>

        <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
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

            <div class="mx-auto block md:flex max-w-5xl gap-2">

                <div class="bounceslideInFromLeft w-full md:w-1/2 p-5 crud-card">
                    <h4 class="mb-5 font-semibold">Un project a realiser ?</h4>
                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class="w-1/12"><i class="text-2xl">H1</i></div>
                        <input type="text" name='project-titre' placeholder="Titre" class="w-11/12  bg-none">
                    </div>
                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class=" w-1/12"><i class="text-xs">P</i></div>
                        <textarea name="project-contenu" id="" cols="30" rows="10" class="w-11/12 bg-none"></textarea>
                    </div>
                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class="w-1/12"><i class="text-2xl fa fa-map-location-dot"></i></div>
                        <input type="text" name='project-location' placeholder="Zone d'activite" class="w-11/12  bg-none">
                    </div>

                    <div class="mb-5 w-full">
                        Les objectifs
                        <div class=" mb-5 obj_container">

                        </div>

                        <div class="mb-5 w-full">
                            <div class="flex justify-end items-end">
                                <div class="mb-5 w-12 h-12 cursor-pointer flex justify-center items-center  input-field add-obj" id="objadder">
                                    <i class=" fa fa-plus"></i>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>

                <div class="bounceslideInFromRight w-full mt-5 md:mt-0 md:w-1/2 p-5 crud-card">
                    <h4 class="mb-5 font-semibold">Galerie photo </h4>

                    <div class="flex flex-wrap gap-1 photo-container" id="photosContainerforProject">
                        <div class="cursor-pointer flex items-center justify-center w-40 h-40 rounded-lg input-field" id="adderphoto" >
                            <i class="text-5xl bx bxs-camera-plus"></i>
                        </div>

                    </div>

                    @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_partenaire == "1"))
                        <input type="hidden" name="the_user" value=" {{\Illuminate\Support\Facades\Auth::user()->name}}">
                        <input type="hidden" name="nbrobj" >
                        <input type="hidden" name="nbrphoto">
                            <div class="mt-5 flex w-full justify-center md:justify-end ">
                                <button class=" mb-5 bg-green-500 hover:bg-green-600 text-white">Enregistrer</button>
                            </div>
                        @else
                        <div class="mt-5 flex w-full justify-center md:justify-end ">
                            <button class=" grayscale mb-5 bg-green-500 hover:bg-green-600 text-white" disabled>Enregistrer</button>
                        </div>
                    @endif

                </div>


            </div>
        </form>
      </div>


</section>



<script>
    var objectifcounter = 1;
    document.getElementById('objadder').addEventListener('click', function() {

        var objContainer = document.querySelector('.obj_container');

        var newObjectif = document.createElement('div');
        newObjectif.classList.add('bounceslideInFromRight','mb-5', 'flex', 'justify-center', 'items-center', 'input-field', 'minus_hover');

        var iconContainer = document.createElement('div');
        iconContainer.classList.add('w-1/12');
        var icon = document.createElement('i');
        icon.classList.add('text-2xl', 'fa', 'fa-bullseye');
        iconContainer.appendChild(icon);

        var input = document.createElement('input');
        input.type = 'text';
        input.name = 'objectif'+ objectifcounter;
        input.placeholder = '';
        input.classList.add('w-10/12', 'bg-none');

        var minusContainer = document.createElement('div');
        minusContainer.classList.add('cursor-pointer', 'w-1/12', 'minus_hide');
        var minusIcon = document.createElement('i');
        minusIcon.classList.add('fa', 'fa-minus');
        minusContainer.appendChild(minusIcon);
        objectifcounter+=1;
        minusContainer.addEventListener('click', function() {
            newObjectif.remove();
        objectifcounter-=1;
        });

        newObjectif.appendChild(iconContainer);
        newObjectif.appendChild(input);
        newObjectif.appendChild(minusContainer);


        objContainer.appendChild(newObjectif);
        document.querySelector('input[name="nbrobj"]').value = objectifcounter;

        console.log(objectifcounter)
    });

</script>

<script>
    var photocounter = 1;

    document.getElementById('adderphoto').addEventListener('click', function() {
      var newDiv = document.createElement('div');
      newDiv.className = 'bounceslideInFromRight w-40 h-40 rounded-lg relative photocontainer input-field';

      var imgContainer = document.createElement('div');
      imgContainer.className = 'w-full h-full';

      var img = document.createElement('img');
      img.src = '';
      img.alt = '';
      img.className = 'w-full h-full object-contain';

      var hiddenInput = document.createElement('div');
      hiddenInput.className = 'hidden';
      var input = document.createElement('input');
      input.type = 'file';
      input.name = 'photo' + photocounter;
      input.style.display = 'none';

      input.addEventListener('change', function(event) {
        var file = event.target.files[0];
        if (file) {
          var reader = new FileReader();
          reader.onload = function() {
            img.src = reader.result;
          }
          reader.readAsDataURL(file);
        } else {
          // Si aucun fichier n'est sélectionné, annuler la création du div
          newDiv.remove();
        }
      });

      var closer = document.createElement('div');
      closer.className = 'absolute top-0 right-0 closerphoto';
      closer.innerHTML = '<i class="text-red-500 fa fa-times"></i>'; // La classe fa-x a été corrigée à fa-times
      photocounter += 1;

      closer.addEventListener('click', function() {
        newDiv.remove();
        photocounter -= 1;
      });

      imgContainer.appendChild(img);
      newDiv.appendChild(imgContainer);
      hiddenInput.appendChild(input);
      newDiv.appendChild(hiddenInput);
      newDiv.appendChild(closer);

      document.getElementById('photosContainerforProject').appendChild(newDiv);

      input.click();

      document.querySelector('input[name="nbrphoto"]').value = photocounter;
    });

  </script>







@endsection
