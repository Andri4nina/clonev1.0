@extends('welcome')


@section('content')
<main class="flex public_main">
    <div class="show_to_Left w-1/4">
        <h2 class="pl-3 text-xl font-semibold title">Nos partenaires</h2>
        @foreach ($partenaire as $part )

        <div class="flex p-4 cards_item">
            <div class="rounded flex flex-col overflow-hidden part_card">
                <div id="cardImage{{ $part->id }}" class="bg-center bg-no-repeat bg-cover overflow-hidden relative card_image">
                    
                    <img data-src="{{ asset('images/logo/'.$part->logo) }}" alt=""> 

                </div>
                <div class="flex flex-col p-4 card_content">
                   <a href="{{ $part->url }}"><div class="text-xl font-light  card_title">{{ $part->abreviation }}</div>
                    <p class="text-sm mb-5 card_text">{{ $part->nom }} <br><br>{{ $part->histoire }}</p></a> 
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var cardImage = document.getElementById("cardImage{{ $part->id }}");
                    var imgElement = cardImage.querySelector("img");
            
                    var imageUrl = imgElement.getAttribute("data-src");
                    cardImage.style.backgroundImage = "url('" + imageUrl + "')";
                });
            </script>  
        </div>  
        @endforeach
    </div>
        
    <div class="show_to_Top w-1/2">
        <h2 class="pl-3 text-xl font-semibold title">ÊTRE AU COURANT DE NOS PROJETS </h2>
        <div class="overflow-hidden title_content">
            <div class=" overflow-auto actu">
                @foreach ($publication as $pub )
                <div class="relative h-96 mb-32 affich_publi">
                    <h2 class="text-2xl font-extrabold">{{ $pub->titre_publi}}</h2>
                    
                    <img src="{{ asset('images/couverture/'.$pub->img_couv_publi )}}" alt="" class="w-full  h-full">
                    <h3 class="absolute bottom-0 right-0 font-bold text-white">{{ $pub->sous_titre_publi }}</h3>
                </div>
                
            @endforeach
            <div class="mt-16 lg:mt-12 w-56 ml-auto mb-4 mr-8 items-center float-right flex table_paginate">
                {{ $publication->links('layouts.pagination') }}
            </div>
            </div>
        </div>
   
    </div>

    <div class="show_to_Right mx-3 w-1/4">
        <h2 class="pl-3 text-xl font-semibold title">Le Mot du Ministres</h2>
        <div class="flex justify-center md:justify-end">
            <div class="mb-5">
                <span id="ministre_text"></span>
            </div>
        </div>

        <div>
            <img src="{{ asset('images/ministrepic.jpg')}}" class="rounded-xl">
        </div>

        <div>
            <span id="ministre_text_2"></span>
        </div>

        <div>
            <h2 class="pl-3 text-xl font-semibold title"> À PROPOS DU MEH</h2>

            <p>Le ministère de l’Energie et des Hydrocarbures (MEH) est chargé de la conception et de la mise en œuvre de la 
                politique énergétique. 
                Visant un développement durable et harmonieux pour le pays, 
                 défi étant d’assurer un approvisionnement en énergie suffisante, 
                 de meilleure qualité et au moindre coût.
                Le MEH a comme vision d’atteindre un secteur de l’énergie qui favorise 
                la prospérité et le bien-être des citoyens, et promeut le développement 
                 du pays. Cinq objectifs d’ordre qualitatif ont été établis : l’accès de tous à l’énergie moderne,
                  l’abordabilité des prix, la qualité et la fiabilité des services, la sécurité énergétique, et la durabilité.
                </p>
        </div>
        
        <script type="text/javascript">
            function typingAnimation(text, elementId) {
                var i = 0;
        
                function typing() {
                    if (i < text.length) {
                        document.getElementById(elementId).innerHTML += text.charAt(i);
                        i++;
                        setTimeout(typing, 50);
                    }
                }
        
                typing();
            }
        
            typingAnimation("<< OFFRIR UNE ÉLECTRICITÉ MOINS CHÈRE ET AU MOINDRE COÛT À LA POPULATION >>", "ministre_text");
            typingAnimation("<< Madagascar avance pas à pas dans la réalisation du Velirano 2 : «l’énergie et l’eau pour tous». Le challenge est important : offrir une électricité moins chère à la population, mais également dans l’optique d’électrifier et de raccorder tout le pays. >>", "ministre_text_2");
        </script>
    </div>
</main>

 
@endsection