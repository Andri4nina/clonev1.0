@extends('layouts.app')

@section('content')
    <main class=" max-w-4xl ">
        <section>
            <form action="{{ route('publication.approved',$publication->id) }}"  method="post">
                @csrf
                <div class="flex justify-between items-center mb-5 ">
                    <h1 class="show_to_Left">Affichage du Blog</h1>
                </div>
                <div class="show_to_Center mb-10">
                  <hr>
                  <h2 class="text-2xl">Affichage sur la page d'acceuil</h2>
                
                  <div class="relative h-96 mb-8 affich_publi">
                    <h2 class="text-2xl font-extrabold">{{ $publication->titre_publi}}</h2>
                    
                    <img src="{{ asset('images/couverture/'.$publication->img_couv_publi )}}" alt="" class="w-full h-full">
                    <h3 class="absolute bottom-0 right-0 font-bold text-white">{{ $publication->sous_titre_publi }}</h3>
                  </div>



                  <div class="translate-y-10 mb-16 mt-6">
                    <hr class="mt-8">
                    <h2 class="text-2xl">Affichage apres le clique</h2>
                  </div>


                  <div class="relative affich_click">
                      <img  class=" h-full w-full" src="{{ asset('images/couverture/'.$publication->img_couv_publi )}}" alt="" >
                  
                      <div class="absolute top-0 right-5 w-96 h-full ">
                        <div class=" overflow-hidden h-full w-full px-2 case_publi">
                          <h2 class="text-2xl font-extrabold">{{ $publication->titre_publi}}</h2>
                          <h3 class="text-2xl font-extrabold">{{ $publication->sous_titre_publi}}</h3>
                          <div class="h-full pb-56 overflow-y-auto">
                           
                              <p>" {{ $publication->contenu_publi }} "</p>
                  
                          </div>

                        </div>
                    
                        </div>
                  
                  
                    </div>
                
                
                </div>
                


                <div >
                  <hr>
                  <h2 class="text-2xl">Affichage sur la page d'actualite</h2>

                  <div class="col-span-4 sm:col-span-4 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <div class="relative my-3 mx-0 block public_card">
                        <div class="card-thumbnail">
                            <img class="img-responsive" src="{{ asset('images/couverture/'.$publication->img_couv_publi )}}">
                        </div>
                        <div class="card-content">
                            <div class="send">
                                <i class="fa fa-paper-plane"></i>
                            </div>
                            <h1 class="card-title">
                              {{ $publication->titre_publi}}
                            </h1>
                              <h2 class="card-sub-title">
                                {{ $publication->sous_titre_publi}}
                            </h2>
                           
                            <ul class="list-none flex post-meta">
                                <li class="time-stamp">
                                    <i class="fa fa-clock"></i> il y a 6 minutes 
                                </li>
                                <li class="card-comment">
                                    <i class="fa fa-comment"></i><a href="#"> 39 commentaires</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                  </div>

                </div>
                

                    
              
              
                <div class="flex mb-8 sm:float-right sm:mr-5 items-center  titlebar show_to_Right">
                    <input type="hidden" name="hidden_id" value='{{ $publication->id }}'>
                    <input type="hidden" name="status_publi" value='Approuve'>
                    <button class="bg-green-500 hover:bg-green-600 text-white">Approuver</button>
                </div>
            </form>
         
        </section>
    
    </main>

@endsection