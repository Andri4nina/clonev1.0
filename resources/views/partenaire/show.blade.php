@extends('layouts.app')

@section('content')
<main class=" max-w-4xl ">
    <section>
        <form action="{{ route('partenaire.approved',$partenaire->id) }}"  method="post">
            @csrf
            <div class="flex justify-between items-center mb-5 ">
                <h1 class="show_to_Left">Affichage du Partenaire</h1>
            </div>
            <hr>
         
            <div >
                <h3 class="show_to_Left text-base font-extrabold">En card</h3>
               
               
                <div class="flex p-4 cards_item">
                    <div class="rounded flex flex-col overflow-hidden part_card">
                        <div id="cardImage" class="bg-center bg-no-repeat bg-cover overflow-hidden relative card_image">
                       
                            <img data-src="{{ asset('images/logo/'.$partenaire->logo) }}" alt=""> 

                        </div>
                        <div class="flex flex-col p-4 card_content">
                            <div class="text-xl font-light  card_title">{{ $partenaire->abreviation }}</div>
                            <p class="text-sm mb-5 card_text">{{ $partenaire->nom }} <br><br>{{ $partenaire->histoire }}</p>
                        </div>
                    </div>
                </div>

               <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var cardImage = document.getElementById("cardImage");
                        var imgElement = cardImage.querySelector("img");
                
                        var imageUrl = imgElement.getAttribute("data-src");
                        cardImage.style.backgroundImage = "url('" + imageUrl + "')";
                    });
                </script>  
                
        
            </div>

            {{-- Footer   --}}
            

            <div class="flex mb-8 sm:float-right sm:mr-5 items-center  titlebar show_to_Right">
                <input type="hidden" name="hidden_id" value='{{ $partenaire->id }}'>  
                <input type="hidden" name="status_part" value='Approuve'>  
                <button class="bg-green-500 hover:bg-green-600 text-white">Approuver</button>
            </div>
       </form>
    </section>
</main>


@endsection