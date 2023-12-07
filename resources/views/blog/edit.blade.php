@extends('layouts.app')

@section('content')
<section class=" block max-w-6xl w-full mx-auto ">
    <div class="relative usersection">
        <h3 class="bounceslideInFromLeft text-2xl pl-2 mb-5 font-semibold">        <a href="{{ route('blog.index') }}"  ><i class="text-4xl bx bx-chevron-left"></i></a> Blogs / <small>Modification</small></h3>
        <form action="{{ route('blog.update',$blog->id) }}" method="POST" enctype="multipart/form-data">
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
               <div class="block md:flex max-w-5xl mx-auto gap-2">

                <div class="bounceslideInFromLeft  md:w-1/2 p-5 mb-5 md:mb-0 crud-card">
                    <h4 class="mb-5 font-semibold">Y'avait un probleme ?</h4>
                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class="w-1/12"><i class="text-2xl">H1</i></div>
                        <input type="text" name='blog-titre' placeholder="Titre" class="w-11/12   bg-none" value="{{ $blog->titre_blog}}">
                    </div>
                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class=" w-1/12"><i class="text-base">H2</i></div>
                        <input type="text" name='blog-soustitre' placeholder="Sous-titre" class="w-11/12  bg-none"  value="{{ $blog->sous_titre_blog}} ">
                    </div>
                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class=" w-1/12"><i class="text-xs">P</i></div>
                        <textarea name="blog-contenu" id="" cols="30" rows="10" class="w-11/12 bg-none"> {{ $blog->contenu_blog }}</textarea>
                    </div>
                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class="w-1/12 relative">
                            <i class="absolute top-0 left-0 bx bx-camera-movie"></i>
                            <i class="absolute bottom-0 right-0 bx bx-camera"></i>
                            <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 -rotate-12 text-2xl">\</span>
                        </div>
                        <select name="blog-type" id="" value="{{ $blog->type_blog }}" class="p-5 w-11/12 bg-none">
                            <option class="p-5 " value="Publication">
                                Publication
                            </option>
                            <option value="Reportage">
                                Reportage
                            </option>
                        </select>
                    </div>
                    <div class="hidden mb-5  flex justify-center items-center input-field">
                        <div class=" w-1/12"><i class="text-base">URL</i></div>
                        <input type="text" name='blog-url' placeholder="youtube.com" class="w-11/12  bg-none" value="{{ $blog->url_blog }}">
                    </div>

                </div>

                <div class="bounceslideInFromRight  md:w-1/2 p-5 crud-card">
                    <h4 class="mb-5 font-semibold">Media</h4>
                    <h5>Photo de couverture</h5>
                    <div class="relative mb-5 w-full h-64" id="imagePreview">
                        <img src="{{ asset('images/sans-image/noimg.jpeg') }}" alt="" class="w-full h-full nophotocouv">
                    </div>
                    <div class="">
                        <input type="hidden" name='hidden-blog-couv'>
                        <input type="file" name="blog-couv" id="photoInput">
                    </div>
                    <hr>
                    <h5 class="my-5">Autre photo</h5>
                    <div class=" mb-5 flex flex-wrap gap-1"  id="photosContainer">
                        <div class="flex relative w-3/12 h-32 text-center align-middle my-auto items-center rounded-lg input-field  cursor-pointer" id="adderphoto">
                            <label for="otherphotoInput" class="mx-auto my-auto text-lg relative w-5 h-5 cursor-pointer">
                                <i class=" text-lg fa fa-plus"></i>
                            </label>
                        </div>
                        @foreach ($photos as $photo )
                            <div class="w-3/12 h-32 relative rounded-lg input-field phote-add exist-photo">
                                <div class="w-full h-full">
                                    <img src="{{ asset($photo->img) }}" alt="" class="w-full h-full object-contain">
                                </div>

                                <div class="hidden">
                                    <input type="hidden"  class="exist-photo-element"  value='{{ $photo->id }}'>
                                    <input type="file"style="display: none;" value="{{ $photo->img }}">
                                </div>
                                <div class="absolute top-0 right-0 closerphoto del-photo">
                                    <i class="text-red-500 fa fa-x"></i>
                                </div>
                            </div>
                        @endforeach
                        @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_update_blog == "1"))
                            <div class="flex w-full justify-center md:justify-end translate-y-10">
                                <button class=" mb-5 bg-green-500 hover:bg-green-600 text-white">Enregistrer</button>
                            </div>
                        @else
                            <div class="flex w-full justify-center md:justify-end translate-y-10">
                                <button class=" grayscale mb-5 bg-green-500 hover:bg-green-600 text-white" disabled>Enregistrer</button>
                            </div>
                        @endif


                    </div>
                    <input type="hidden" name="del_value" value='' id="del_value">
                    <input type="hidden" name="nbrphoto" value="">
                    <input type="hidden" name="the_user" value=" {{\Illuminate\Support\Facades\Auth::user()->name}}">
                    <input type="hidden" name="hidden_id" value="{{ $blog->id }}">
                    <input type="hidden" name='adderId' value="  {{\Illuminate\Support\Facades\Auth::user()->id }} ">
                </div>

            </div>
        </form>

    </div>


</section>







<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectElement = document.querySelector('select[name="blog-type"]');
        const urlInput = document.querySelector('input[name="blog-url"]');

        function toggleUrlInput() {
            if (selectElement.value === "Reportage") {
                urlInput.parentElement.classList.remove('hidden');
            } else {
                urlInput.parentElement.classList.add('hidden');
            }
        }

        toggleUrlInput();

        selectElement.addEventListener('change', toggleUrlInput);
    });
</script>









<script>

    var photocounter = 1;
    document.getElementById('adderphoto').addEventListener('click', function() {
        var newDiv = document.createElement('div');
        newDiv.className = 'w-3/12 h-32 relative rounded-lg input-field phote-add';

        var imgContainer = document.createElement('div');
        imgContainer.className = 'w-full h-full';
        var img = document.createElement('img');
        img.src = '';
        img.alt = '';
        img.className = 'w-full h-full object-contain';
        imgContainer.appendChild(img);

        var hiddenInput = document.createElement('div');
        hiddenInput.className = 'hidden';
        var input = document.createElement('input');
        input.type = 'file';
        input.name = 'photo' + photocounter;
        input.style.display = 'none'; // Masquer l'input

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
        closer.innerHTML = '<i class="text-red-500 fa fa-x"></i>';
        closer.addEventListener('click', function() {
            newDiv.remove();
        });

        newDiv.appendChild(imgContainer);
        hiddenInput.appendChild(input);
        newDiv.appendChild(hiddenInput);
        newDiv.appendChild(closer);

        document.getElementById('photosContainer').appendChild(newDiv);

        // Cliquez sur l'input de type fichier lorsque le label est cliqué
        input.click();

        photocounter += 1;
        document.querySelector('input[name="nbrphoto"]').value = photocounter;
    });




</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let del_exist_photo = [];

        var contain_photo = document.querySelectorAll('.exist-photo');

        contain_photo.forEach(element => {
            {{--  var exist_photo_element = element.querySelector('.exist-photo-element').value;
            exist_photo.push(exist_photo_element);  --}}


            var delButton = element.querySelector('.del-photo');
            delButton.addEventListener('click', function() {

                element.classList.add('hidden');


                var idToRemove = element.querySelector('.exist-photo-element').value;

                del_exist_photo.push(idToRemove);
                updateDelValueInput()

            });
        });

        function updateDelValueInput() {
            var delValueInput = document.getElementById('del_value');
            delValueInput.value = del_exist_photo.join(',');
        }

    });


</script>

@endsection
