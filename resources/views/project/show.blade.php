@extends('layouts.app')

@section('content')
<section class=" block w-10/12 mx-auto ">
    <div class="relative usersection">
        <h3 class="text-base pl-2 mb-5">Project / Appercu </h3>

        <h5 class="pl-2 mb-5">Appercu</h5>
        <h6 class="mb-5">Sur la page d'acceuil</h6>
        <div class="project-container">
            <h1 class=" text-2xl font-semibold ">Titre du Projet</h1>
            <p class="p-5 text-base project-label">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos minima optio labore recusandae placeat? Ratione et, 
                cumque repellat quo modi fugiat est, ad officiis architecto distinctio 
                nulla voluptatum aliquid optio!</p>
            <h4 class="project-activity">Zone d'Activité</h4>
            <span>Antananarivo Ivato</span>
            <div class="my-5 project-gallery">
                <div class="image-accordion">
                    <figure class="selected-image">
                        <img src="https://images.unsplash.com/photo-1559305289-4c31700ba9cb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1073&q=80"
                            alt="image">
                    </figure>
                    <figure>
                        <img src="https://images.unsplash.com/photo-1582880421648-a7154a8c99c1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1171&q=80"
                            alt="img">
                    </figure>
                    <figure>
                        <img src="https://images.unsplash.com/photo-1536418138303-bac5f6eaa12b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
                            alt="img">
                    </figure>
                    <figure>
                        <img src="https://images.unsplash.com/photo-1567322679836-1830edd0e80b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
                            alt="img">
                    </figure>
                </div>
            </div>
        </div>
        <a href="{{ route('blog.index') }}" class="absolute -top-2 -left-10  "><i class="text-4xl bx bx-chevron-left"></i></a>
    </div>

  
</section>


<script>
    const Projectimages = document.querySelectorAll(".image-accordion img");

    Projectimages.forEach(function (image) {
        image.onclick = function (event) {
            document.querySelector(".selected-image").classList.remove("selected-image");
            const clickParent = event.target.parentNode;
            clickParent.classList.add("selected-image");
        }
    
    })
</script>

            



@endsection