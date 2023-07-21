@extends('layouts.app')
@vite('resources/css/user.css')





@section('content')
<main class="w-full max-w-4xl mt-20 mx-auto">
    <section>
        <div class="flex justify-between items-center mb-5">
            <h1>Blogs</h1>
            <a href="{{ route('publication.create') }}"><button class="bg-green-500 text-white hover:bg-green-600 ">Nouveau Blog</button></a>
        </div>
        <div class="table_content">
            <div class="p-0 m-0  table_filter">
                <div>
                    <ul class="list-none justify-start flex p-0 m-0 table_filter_list">
                        <li>
                            <p class="mt-2 mb-3 cursor-pointer link-active">Tous</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="px-0 py-8 mt-2 grid table_search">   
                <div>
                    <button class="appearance-none w-full border-none mt-1 text-base rounded-t-sm rounded-bl-sm search_select">
                       Chercher un blog
                    </button>
                    <span class="text-base opacity-70 top-2 right-5 absolute search_select_arrow">
                        <i class="fa fa-caret-down"></i>
                    </span>
                </div>
                <div class="mt-1 relative">
                    <input class="w-full border-none rounded-tr-sm rounded-br-sm pl-10 pr-5 py-2 text-base search_input" type="text" name="search" placeholder="Chercher un blog..." value="{{ request('search') }}">
                    <i class="top-3 left-3 absolute fa fa-search"></i>
                </div>
            </div>
            <div class="px-0 py-8 gap-3 grid text-sm font-medium text-center  table_publi_head">
                <p>ID</p>
                <p>Titre du blog</p>
                <p>Date de creation</p>
                <p>Date de derniere publication </p>
                <p>Status</p>
                <p>Action</p>
                <p>Publier</p>
            </div>
            <div class="gap-3 grid items-center text-center table_publi_body">
                @if (count($publication)>0)
                    @foreach ($publication as $publication )
                    <p>{{ $publication->id }}</p>
                    <a href="#"><p class="font-extrabold hover:text-base hover:font-semibold" >{{ $publication->titre_publi }}</p></a>
                    <p>{{ $publication->created_at }}</p>
                    <p>12/12/2023</p>
                    <p>{{ $publication->status_publi }}</p>
                    <div>     
                        <button class="btn text-white bg-blue-500 hover:bg-blue-700" >
                            <i class="fa fa-pencil-alt" ></i> 
                        </button>
                        <button class="btn text-white bg-red-500 hover:bg-red-700" >
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </div>
                    <div>
                        <label for="">
                            <input type="checkbox" name="" id="">
                        </label>
                    </div>
                    @endforeach
                @else

                @endif
                
             
            <div class="w-56 ml-auto mb-4 mr-8 items-center float-right flex table_paginate">
                <div class="mb-4 mr-4 justify-between pagination">
                    <a href="#" disabled>&laquo;</a>
                    <a class="active_page">1</a>
                    <a>2</a>
                    <a>3</a>
                    <a href="#">&raquo;</a>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection

