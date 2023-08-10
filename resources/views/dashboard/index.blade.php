@extends('layouts.app')

@section('content')  
 {{--  Dashboard  --}}
    <main class=" mt-20">
      <section>
        {{--  premiere division du dashboard  --}}
        <h1 class="show_to_Left">Tableau de bord</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-2 dash_Header">
            <div class="p-3 rounded-md mt-2 w-full h-28 mb-2 show_to_Left dash_card">
                  <div class="p-2 relative flex justify-between min-w-0 h-20">
                     <div>
                        <p class="text-sm font-semibold">Nombre de <br> blog creer</p>
                        <h5 class="font-bold">{{ $countpublication }}</h5>
                      </div> 
                      <div class="relative w-16 icon_shape shadow text-center rounded-md" id="countCreation">
                        <i class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 fa fa-pen-square text-3xl" aria-hidden="true"></i>
                      </div>
                  </div>
            </div>
            
            <div class="p-3 rounded-md mt-2 w-full h-28 mb-2 show_to_Left dash_card">
              <div class="p-2 relative flex justify-between min-w-0 h-20">
                 <div>
                    <p class="text-sm font-semibold">Nombre de <br> blog publier</p>
                    <h5 class="font-bold">{{ $publishPublication }}</h5>
                  </div> 
                  <div class="relative w-16 icon_shape shadow text-center rounded-md" id="countPublier">
                    <i class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 fa fa-share-square text-3xl" aria-hidden="true"></i>
                  </div>
              </div>
           </div>

           <div class="p-3 rounded-md mt-2 w-full h-28 mb-2 show_to_Right dash_card">
            <div class="p-2 relative flex justify-between min-w-0 h-20">
               <div>
                  <p class="text-sm font-semibold">Nombre <br> d utilisateur</p>
                  <h5 class="font-bold">{{ $countUser }}</h5>
                </div> 
                <div class="relative w-16 icon_shape shadow text-center rounded-md" id="countUser">
                  <i class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 fa fa-users text-3xl" aria-hidden="true"></i>
                </div>
            </div>
          </div>
      
            <div class="p-3 rounded-md mt-2 w-full h-28 mb-2 show_to_Right dash_card">
              <div class="p-2 relative flex justify-between min-w-0 h-20">
                <div>
                    <p class="text-sm font-semibold">Nombre de <br> blog en attente</p>
                    <h5 class="font-bold">{{ $WaitPublication }}</h5>
                  </div> 
                  <div class="relative w-16 icon_shape shadow text-center rounded-md" id="countAttente">
                    <i class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 fa fa-stopwatch text-3xl" aria-hidden="true"></i>
                  </div>
              </div>
            </div>
        </div>
        {{--  deuxieme partie  --}}
        <div class="grid sm:grid-cols-2 gap-2 mt-5">
          <div class="show_to_Left overflow-hidden rounded-lg  dash_user_utilite">
            <div class="overflow-auto">
              <h4 class="p-3">Publication</h4> 
              <span class="pl-5">Creer depuis l'utilisation de l'application</span>
  
              <div class="table_responsive">
                  <div class="px-0 py-8 gap-3 grid text-sm font-medium text-center table_publi_head">
                    <p>Titre du blog</p>
                    <p>Date de creation</p>
                    <p>Date de derniere publication </p>
                    <p>Status</p>
                    <p>Editeur</p>
                </div>
  
                <div class="relative gap-3 grid items-center text-center table_publi_body">
                        @foreach ($publication as $pub )
                            <div class="grid gap-3 tab_content">
                                <div data-title="Titre"><a href="#"><p class="font-extrabold" > {{ $pub->titre_publi }} </p></a></div>
                                <p data-title="Date de creation">{{ $pub->created_at}}</p>
                                <p data-title="Date de publication "> {{ $pub->date_publi}}</p>
                                <p data-title="Status"> {{ $pub->status_publi }}</p>
                                <p data-title="Editeur">{{ $pub->name }}</p>
                            </div>
                          
                        @endforeach
                        <div class="mt-16 lg:mt-12 w-56 ml-auto mb-4 mr-8 items-center float-right flex table_paginate">
                          {{ $publication->links('layouts.pagination') }}
                        </div>
                </div>
              </div>  
            </div>
           
          </div>  
          <div class="show_to_Right h-auto block p-11 rounded-lg  dash_user_utilite ">
            <!-- prend tous le hauteur -->
            <div class="relative text-center">
                <!-- nombre de visite du site en temps reel -->
                <span class="font-extrabold text-4xl">500000</span> 
                <i class="text-xs fa fa-users"></i>
                <p class="font-extralight">Nombres de visiteurs</p>
            </div>
            <div class="relative mt-5 block mx-auto w-44 dash_date_clock">
                <!-- date et heure -->  
                <div class="text-center h-auto  dash_date">
                    <span class="text-4xl font-black" id="month"></span> <br>
                    <span class="text-8xl" id="day"></span> <br>
                    <span class="text-xl" id="week"></span><br>
                    <span class="text-ellipsis" id="year"></span>
                </div>  

                <div class="absolute right-0 bottom-0 translate-x-1/2 translate-y-1/2 dash_clock">
                    <div class="relative flex justify-center items-center w-16 h-16 clock">
                    <div class="w-1 h-4 bg-white dash_hour" id="dash_hour"></div>
                    <div class="w-1 h-5 bg-white  dash_minute" id="dash_minute"></div>
                    <div class="w-1 h-6 bg-red-500 dash_second" id="dash_second"></div>
                    <div class="absolute w-2 h-2 rounded-full bg-white dash_dot_center"></div>
                    </div>
                </div>

                <script>
                    const dash_second=document.getElementById('dash_second');
                    const dash_minute=document.getElementById('dash_minute');
                    const dash_hour=document.getElementById('dash_hour');
                    function clock(){
                        const date = new Date();
                        const seconds=date.getSeconds() /60;
                        const minutes=(seconds + date.getMinutes())/60;
                        const hours=(minutes + date.getHours())/12;
                        rotateClock(dash_second , seconds);
                        rotateClock(dash_minute, minutes); 
                        rotateClock(dash_hour  , hours);
                    }
                    function rotateClock(element,rotation){
                        element.style.setProperty('--rotate',rotation* 360)
                    }
                    setInterval(clock ,1000);
                    // date
                    function updateDate() {
                        var timeNow = new Date(),
                            locale = 'fr-fr',
                            day = addZero(timeNow.getDate()),
                            month = timeNow.toLocaleString(locale, { month: 'short' }),
                            year = timeNow.getFullYear(),
                            weekDay = timeNow.toLocaleString(locale, { weekday: 'long' });
                            document.getElementById('day').innerHTML = day;
                            document.getElementById('month').innerHTML = month;
                            document.getElementById('year').innerHTML = year;
                            document.getElementById('week').innerHTML = weekDay;
                        }
                        function addZero(number) {
                            return (number < 10 ? '0' : '') + number;
                        }
                        updateDate();
                </script>
            </div>
          </div>
         

        </div>
      </section>
    </main>

@endsection