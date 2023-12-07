@extends('layouts.app')

@section('content')
<section class=" block max-w-6xl w-full mx-auto ">
    <div class="relative usersection">
        <h3 class="bounceslideInFromLeft text-2xl pl-2 mb-5 font-semibold">        <a href="{{ route('project.index') }}"  ><i class="text-4xl bx bx-chevron-left"></i></a> Project / <small>Modification</small></h3>

        <form action="{{ route('project.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mx-auto block md:flex max-w-5xl gap-2">
                <input type="hidden" name="the_user" value=" {{\Illuminate\Support\Facades\Auth::user()->name}}">

                <div class="bounceslideInFromLeft w-full md:w-1/2 p-5 crud-card">
                    <h4 class="mb-5 font-semibold">Un project a mofidier ?</h4>
                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class="w-1/12"><i class="text-2xl">H1</i></div>
                        <input type="text" name='project-titre' placeholder="Titre" class="w-11/12  bg-none" value="{{ $project->titre_project }}">
                    </div>
                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class=" w-1/12"><i class="text-xs">P</i></div>
                        <textarea name="project-contenu" id="" cols="30" rows="10" class="w-11/12 bg-none">{{ $project->contenu_project }}</textarea>
                    </div>
                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class="w-1/12"><i class="text-2xl fa fa-map-location-dot"></i></div>
                        <input type="text" name='project-location' placeholder="Zone d'activite" class="w-11/12  bg-none" value="{{ $project->zone_project }}">
                    </div>

                    <div class="mb-5 w-full">
                        Les objectifs
                        <div class=" mb-5 obj_container">
                            @foreach ($objectif as $obj)
                            <div class="mb-5  flex justify-center items-center input-field minus_hover exist_obj">
                                <div class="w-1/12"><i class="text-2xl fa fa-bullseye"></i></div>
                                <input type="hidden"  class="exist-obj-element"  value='{{ $obj->id }}'>
                                <input type="text" name='objectif' placeholder="" class="w-10/12  bg-none" value="{{ $obj->libelle_obj }}">
                                <div class="cursor-pointer w-1/12 minus_hide del_obj"><i class=" fa fa-minus "></i></div>
                            </div>
                            @endforeach

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
                    <div class="flex flex-wrap gap-1 " id="photosContainerforProjectedit">
                        <div class="cursor-pointer flex items-center justify-center w-40 h-40 rounded-lg input-field" id="adderphoto" >
                            <i class="text-5xl bx bxs-camera-plus"></i>
                        </div>
                        @foreach ($photos as $photo )

                        <div class="relative w-40 h-40 rounded-lg exist-photo">
                            <img src="{{ asset($photo->img)}}" alt="" class="w-full h-full">
                            <div class="hidden">
                                <input type="hidden"  class="exist-photo-element"  value='{{ $photo->id }}'>
                                <input type="file"style="display: none;" value="{{ $photo->img }}">
                            </div>
                            <div class=" absolute top-0 right-0 closerphoto del-photo">
                                <i class="cursor-pointer text-red-500 fa fa-times"></i>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="flex flex-wrap gap-1 " >
                    </div>

                    @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_project == "1"))
                            <input type="hidden" name="the_user" value=" {{\Illuminate\Support\Facades\Auth::user()->name}}">
                            <input type="hidden" name="del_photo_value" value='' id="del_photo_value">
                            <input type="hidden" name="nbrphoto" value="">
                            <input type="hidden" name="nbrobj" value="">
                            <input type="hidden" name="hidden_id" value="{{ $project->id }}">
                            <input type="hidden" name="del_obj_value" value='' id="del_obj_value">
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
    var objectifcounteredit = 1;
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
        input.name = 'objectif'+ objectifcounteredit;
        input.placeholder = '';
        input.classList.add('w-10/12', 'bg-none');

        var minusContainer = document.createElement('div');
        minusContainer.classList.add('cursor-pointer', 'w-1/12', 'minus_hide');
        var minusIcon = document.createElement('i');
        minusIcon.classList.add('fa', 'fa-minus');
        minusContainer.appendChild(minusIcon);
        objectifcounteredit+=1;
        minusContainer.addEventListener('click', function() {
            newObjectif.remove();
            objectifcounteredit-=1;
        });

        newObjectif.appendChild(iconContainer);
        newObjectif.appendChild(input);
        newObjectif.appendChild(minusContainer);


        objContainer.appendChild(newObjectif);
        document.querySelector('input[name="nbrobj"]').value = objectifcounteredit;

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
          newDiv.remove();
        }
      });

      var closer = document.createElement('div');
      closer.className = 'absolute top-0 right-0 closerphoto';
      closer.innerHTML = '<i class="text-red-500 fa fa-times"></i>';
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

      document.getElementById('photosContainerforProjectedit').appendChild(newDiv);

      input.click();

      document.querySelector('input[name="nbrphoto"]').value = photocounter;
    });

</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        let del_exist_obj = [];

        var contain_obj = document.querySelectorAll('.exist_obj');

        contain_obj.forEach(element => {



            var delButton = element.querySelector('.del_obj');
            delButton.addEventListener('click', function() {

                element.classList.add('hidden');


                var idToRemove = element.querySelector('.exist-obj-element').value;


                del_exist_obj.push(idToRemove);
                updateDelValueInput()

            });
        });

        function updateDelValueInput() {
            var delValueInput = document.getElementById('del_obj_value');
            delValueInput.value = del_exist_obj.join(',');
        }

    });


</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let del_exist_photo = [];

        var contain_photo = document.querySelectorAll('.exist-photo');

        contain_photo.forEach(element => {



            var delButton = element.querySelector('.del-photo');
            delButton.addEventListener('click', function() {

                element.classList.add('hidden');


                var idToRemove = element.querySelector('.exist-photo-element').value;


                del_exist_photo.push(idToRemove);
                updateDelValueInput()

            });
        });

        function updateDelValueInput() {
            var delValueInput = document.getElementById('del_photo_value');
            delValueInput.value = del_exist_photo.join(',');
        }

    });


</script>


@endsection
