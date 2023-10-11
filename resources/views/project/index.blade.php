@extends('layouts.app')

@section('content')
<section class="block w-10/12 mx-auto ">
    <div class="usersection">
        <h3 class="text-base pl-2 mb-5">Projects</h3>
        <div class="p-5 min-w-4xl crud-card">
            <div class="top-card">
                <h4>Tous les projects</h4>
                <div class="w-full">
                    <div class="">
                        <form action="{{ route('project.create') }}" class="float-right">
                            <button class="flex justify-around items-center btn-add"><span>Nouvel project</span><div class="ml-2 relative"><i class=" fas fa-cogs"></i><i class="text-sm">+</i></div></button>
                        </form>
                    </div>
                    <br>
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