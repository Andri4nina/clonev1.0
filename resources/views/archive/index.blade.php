@extends('layouts.app')

@section('content')
<section class="block max-w-fit w-fit mx-auto ">
    <div class="usersection">
        <h3 class="text-base pl-2 mb-5">Archive</h3>
        <div class="p-5 min-w-4xl crud-card">
            <div class="top-card">
                <h4>Tous les blogs archiver</h4>
                <div class="w-full">
                    <form action="" class="my-5">
                        <div class="flex justify-center items-center relative">
                            <button class="w-2/12 text-center btn-search">Rechercher</button>
                            <input class="w-10/12" type="text" placeholder="Chercher un blog">
                            <button class="absolute right-2">
                                <i class="bx bx-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
               
            </div>
            <div class="crud-list">
                <table class="text-center min-w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Titre</th>
                            <th class="px-4 py-2">Date de creation</th>
                            <th class="px-4 py-2">Date de publication</th>
                            <th class="px-4 py-2">Auteur</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Actions</th>
                            <th class="px-4 py-2">Publier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td class="px-4 py-2 flex justify-center  gap-2 ">
                                <a href="{{ route('blog.show') }}" class="px-4 py-1"><span>Titre</span></a>
                            </td>
                            <td class="px-4 py-2">12-12-12</td>
                            <td class="px-4 py-2">12-12-12</td>
                            <td class="px-4 py-2">Administrateur</td>
                            <td class="px-4 py-2">Publier</td>
                            <td class="flex justify-center items-center gap-2 px-4 py-2">
                               
                                <form action="{{ route('blog.edit') }}">
                                    <button class="border text-blue-500 border-blue-500 hover:bg-blue-500 hover:text-white  font-bold "><i class="bx bx-pencil"></i></button>
                                </form>
                                <form action="">
                                    <button class="border text-red-500 border-red-500 hover:bg-red-500 hover:text-white font-bold "><i class="bx bx-trash"></i></button>
                                </form>
                            </td>

                            <td class="px-4 py-2">
                                <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                    <input class="form-checkbox" type="checkbox" id="publier" name="publier" >
                                    <label class="ml-2" for="publier"></label>
                                </div>
                            </td>
                        </tr>
                     
                    </tbody>
           
                </table>
                <div class=" my-5 flex justify-center items-center">
                    {{ view('layouts.pagination') }}
                </div>
            </div>
            
        </div>
        
        <hr class="my-20">
     
        <div class="p-5 min-w-4xl crud-card">
            <div class="top-card">
                <h4>Tous les partenaires archiver</h4>
                <div class="w-full">
                    <form action="" class="my-5">
                        <div class="flex justify-center items-center relative">
                            <button class="w-2/12 text-center btn-search">Rechercher</button>
                            <input class="w-10/12" type="text" placeholder="Chercher un partenaire">
                            <button class="absolute right-2">
                                <i class="bx bx-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
               
            </div>
            <div class="crud-list">
                <table class="text-center min-w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Logo</th>
                            <th class="px-4 py-2">Nom du partenaire</th>
                            <th class="px-4 py-2">Date de publication</th>
                            <th class="px-4 py-2">Date de relation</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Actions</th>
                            <th class="px-4 py-2">Publier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td class="px-4 py-2 flex justify-center  gap-2 ">
                                <div class=" h-10 w-10 rounded-full overflow-hidden">
                                  <a href="{{ route('partenaire.show') }}"> <img src="" alt="" class="bg-red-500 w-full h-full"></a> 
                                </div>
                            </td>
                            <td class="px-4 py-2"><a href="{{ route('partenaire.show') }}">Telma</a></td>
                            <td class="px-4 py-2">12-12-12</td>
                            <td class="px-4 py-2">12-12-12</td>
                            <td class="px-4 py-2">Publier</td>
                            <td class="flex justify-center items-center gap-2 px-4 py-2">
                               
                                <form class="-translate-y-2" action="{{ route('partenaire.edit') }}">
                                    <button class="border text-blue-500 border-blue-500 hover:bg-blue-500 hover:text-white  font-bold "><i class="bx bx-pencil"></i></button>
                                </form>
                                <form class="-translate-y-2" action="">
                                    <button class="border text-red-500 border-red-500 hover:bg-red-500 hover:text-white font-bold "><i class="bx bx-trash"></i></button>
                                </form>
                            </td>

                            <td class="px-4 py-2">
                                <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                    <input class="form-checkbox" type="checkbox" id="publier" name="publier" >
                                    <label class="ml-2" for="publier"></label>
                                </div>
                            </td>
                        </tr>
                     
                    </tbody>
           
                </table>
                <div class=" my-5 flex justify-center items-center">
                    {{ view('layouts.pagination') }}
                </div>
            </div>
            
        </div>

        <hr class="my-20">


        <div class="p-5 min-w-4xl crud-card">
            <div class="top-card">
                <h4>Tous les projects</h4>
                <div class="w-full">
                    <form action="" class="my-5">
                        <div class="flex justify-center items-center relative">
                            <button class="w-2/12 text-center btn-search">Rechercher</button>
                            <input class="w-10/12" type="text" placeholder="Chercher un project">
                            <button class="absolute right-2">
                                <i class="bx bx-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
               
            </div>
            <div class="crud-list">
                <table class="text-center min-w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Titre</th>
                            <th class="px-4 py-2">Date de creation</th>
                            <th class="px-4 py-2">Date de publication</th>
                            <th class="px-4 py-2">Zone d'activite</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Actions</th>
                            <th class="px-4 py-2">Publier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td class="px-4 py-2 flex justify-center  gap-2 ">
                                <a href="{{ route('project.show') }}" class="px-4 py-1"><span>Titre</span></a>
                            </td>
                            <td class="px-4 py-2">12-12-12</td>
                            <td class="px-4 py-2">12-12-12</td>
                            <td class="px-4 py-2">Administrateur</td>
                            <td class="px-4 py-2">En cours</td>
                            <td class="flex justify-center items-center gap-2 px-4 py-2">
                               
                                <form action="{{ route('project.edit') }}">
                                    <button class="border text-blue-500 border-blue-500 hover:bg-blue-500 hover:text-white  font-bold "><i class="bx bx-pencil"></i></button>
                                </form>
                                <form action="">
                                    <button class="border text-red-500 border-red-500 hover:bg-red-500 hover:text-white font-bold "><i class="bx bx-trash"></i></button>
                                </form>
                            </td>

                            <td class="px-4 py-2">
                                <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                    <input class="form-checkbox" type="checkbox" id="publier" name="publier" >
                                    <label class="ml-2" for="publier"></label>
                                </div>
                            </td>

                          
                        </tr>
                     
                    </tbody>
           
                </table>
                <div class=" my-5 flex justify-center items-center">
                    {{ view('layouts.pagination') }}
                </div>
            </div>
            
        </div>
    </div>
</section>



@endsection