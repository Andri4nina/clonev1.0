@extends('layouts.app')

@section('content')
<section class=" block max-w-6xl w-full mx-auto ">
    <div class="relative usersection">
        <h3 class="bounceslideInFromLeft text-2xl pl-2 mb-5 font-semibold">        <a href="{{ route('partenaire.index') }}"  ><i class="text-4xl bx bx-chevron-left"></i></a> Partenaires / @ {{ $partenaire->nom_partenaire }}</h3>

        <div class="bounceslideInFromRight mt-20 mx-auto w-full  text-center px-5 py-20 rounded-xl relative  partenaire-card">
            <h3>{{ $partenaire->nom_partenaire }}</h3>
            <br>
            <h4>{{ $partenaire->abbrev_partenaire }}</h4>
            <br>
            <div class="overflow-hidden h-20 partenaire-collapse">
                <p>
                    {{ $partenaire->histoire_partenaire }}
            </div>
            <br>

            <a class="absolute  left-1/2 -translate-x-1/2" href="{{ $partenaire->siteOff_partenaire }}">
                <button>
                    Visiter
                </button>
            </a>

            <div class="overflow-hidden w-40 h-40 rounded-xl absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2">
                <img src="{{ asset('images/pdp-partenaire/'.$partenaire->logo_partenaire) }}" alt="" class="object-contain w-full h-full">
            </div>
        </div>

    </div>
</section>
@endsection
