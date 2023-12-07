@extends('welcome')

@section('content')
<section>
    <h2 class="mb-5">Qui nous sommes?</h2>
    <p>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
        Atque perferendis nemo vitae excepturi voluptate enim repellat iusto expedita.
         Illum hic animi ea quis aspernatur impedit omnis consequatur aut harum exercitationem.
    </p>
    <h2 class="my-5">Notre historique</h2>
    <div id="container">
        <div id="thumbs">
            <div class="history-block bg-66">
            <div class="cover"></div>
            <div class="year">2021-2022</div>
            <div class="title"><b class="text-3xl">Creation </b><br><br><br><span></span> </div>
            </div>

            <div class="history-block bg-66">
                <div class="cover"></div>
                <div class="year">2022-2023</div>
                <div class="title"><b class="text-3xl">100 Membres en activite </b><br><br><br><span></span> </div>
            </div>

            <div class="history-block bg-66">
                <div class="cover"></div>
                <div class="year">19 Juin 2023 - 19 Aout 2023</div>
                <div class="title"><b class="text-3xl">1ere project</b><br><br><br></div>
            </div>

            <div class="history-block bg-66">
                <div class="cover"></div>
                <div class="year">1 Octobre a nos jours</div>
                <div class="title"><b class="text-3xl">Activite pour les etudiant de l'EPP Soavinarivo</b><br><br><br></div>
                </div>
        </div>
     
    </div> 

    <h2 class="my-5">Notre historique</h2>
    <div class="min-h-screen min-w-full relative">
        <div class="relative flex justify-center pt-5">
            <div class="rounded-xl  w-28 h-28 relative memberscases" id="Finaritra">
                <img src="" alt="Finaritra" class="w-full h-full">
            </div>
        </div>
        <div class="relative flex gap-44 justify-center pt-5">
            <div class="rounded-xl  w-28 h-28 relative memberscases" id="Miary">
                <img src="" alt="Miary" class="w-full h-full">
            </div>
            <div class="rounded-xl  w-28 h-28 relative memberscases" id="Sandy">
                <img src="" alt="Sandy" class="w-full h-full">
            </div>
        </div>
      
        <div class="relative flex gap-44 justify-center pt-36">
            <div class="rounded-xl  w-28 h-28 relative memberscases" id="Njara">
                <img src="" alt="Njara" class="w-full h-full">
            </div>
            <div class="rounded-xl  w-28 h-28 relative memberscases" id="Mims">
                <img src="" alt="Mims" class="w-full h-full">
            </div>
            <div class="grid grid-cols-1">
                <div class="rounded-xl  w-28 h-28 relative memberscases" id="Ranto">
                    <img src="" alt="Ranto" class="w-full h-full">
                </div>

                <div class="mt-16 rounded-xl  w-28 h-28 relative memberscases" id="Hasina">
                    <img src="" alt="Hasina" class="w-full h-full">
                </div>
            </div>
         
            
        </div>
    </div>

    <h2 class="my-5">Nos membres</h2>

    <div class="relative w-full min-vh-100 flex gap-5 my-20 justify-center items-center overflow-hidden thissection">

        <div class="bounceslideInFromBottom w-full h-auto py-14 swiper-container ">
            <div class="swiper-wrapper">
          
                @foreach ($membre as $membres)
                    <div class="bg-center bg-cover w-96 h-96 swiper-slide">
                        <div class="w-full relative p-10 testimonial-Box">
                            <img src="{{asset( 'images/component/quote.png') }}" alt="" class="w-20 absolute top-5 right-7 quote">
                            <div class="testimonial-content">
                                <p>
                                    {{$membres->descri_membre}}
                                </p>
                                <div class="flex items-center mt-5 details">
                                    <div class="relative w-16 h-16 rounded-full overflow-hidden mr-3 img-box">
                                        <img src="{{ asset('images/pdp-membre/'.$membres->pdp_membre )}}" alt="" class=" object-cover w-10 h-10 rounded-full">
                                    </div>
                                    <h3 class="text-base font-semibold membre-details">
                                        {{ $membres->nom_membre }}
                                        <br>
                                        <span class="text-xs">
                                            {{ $membres->poste_membre }}
                                        </span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>     
                @endforeach   
     
            </div>
        </div>
    </div> 
</section>


<script>


/* timeline card defilement */
   var viewportWidth, divWidth, tb;
   $(function() {
       
       viewport = $('#container').innerWidth();
       tb = $('#thumbs');
       divWidth = tb.outerWidth();
   
       $('#container').mousemove(function(e)
       {
     tb.css({left: ((viewport - divWidth)*((e.pageX / viewport).toFixed(3))).toFixed(1) +"px" });
        });
   
   $('.history-block').on('click', function(){
     $('.history-block').css('width', '300px');
     $('.history-block').find('.title').css('width', '260px');
      $('.history-block .timeline').hide(300);
       $(this).css('width', '600px');
       $(this).find('.title').css('width', '500px');
  
     $('#container').mousemove(function(e)
       {
         tb.css({left: ((viewport - divWidth-300)*((e.pageX / viewport).toFixed(3))).toFixed(1) + 300 + "px" });
         });
   });
   
   $('.timeline ul li').on('click', function(){
       $(this).parent().blink();
   });
});

</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"  ></script>
<script>
    var swiper = new Swiper(".swiper-container", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      coverflowEffect: {
        rotate: 20,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
      },

    });
  </script>  
@endsection