@extends('layouts.app')

@section('content')
<section class=" block w-10/12 mx-auto ">
    <div class="relative usersection">
        <h3 class="text-base pl-2 mb-5">Projects / Modification</h3>
        <form action="">
            <div class="flex max-w-5xl gap-2">

                <div class="w-1/2 p-5 crud-card">
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
                </div>

                <div class="w-1/2 p-5 crud-card">
                    <h4 class="mb-5 font-semibold">Galerie photo </h4>
    
                    <div class="flex flex-wrap gap-1">
                        <div class="w-40 h-40 rounded-lg">
                            <img src="" alt="" class="w-full h-full">
                        </div>
                        <div class="w-40 h-40 rounded-lg">
                            <img src="" alt="" class="w-full h-full">
                        </div>
                        <div class="w-40 h-40 rounded-lg">
                            <img src="" alt="" class="w-full h-full">
                        </div>
                        <div class=" w-40 h-40 rounded-lg input-field">
                            <button class="relative w-full h-full">
                                <i class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bx bxs-camera-plus"></i>
                            </button>
                        </div>
                    </div>
                    
                    <button class="float-right my-5 bg-green-500 hover:bg-green-600 text-white">Enregistrer</button>
                </div>

            </div>
        </form>
        <a href="{{ route('project.index') }}" class="absolute -top-2 -left-10  "><i class="text-4xl bx bx-chevron-left"></i></a>
    </div>

  
</section>


            



@endsection