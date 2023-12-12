@extends('welcome')
@section('content')
<section class="public-section">
    <div class="w-11/12 mx-auto grid lg:grid-cols-2 gap-5 ">
        @if(count($partenaires) > 0)
            @foreach ($partenaires as $partenaire)
                <div class="rounded-lg hidden sm:flex flex-col  sm:flex-row justify-between items-center  sm:h-96  w-full mx-auto partenaire-card ">
                    <div class="h-2/3 w-1/3">
                        <img src="{{ asset('images/pdp-partenaire/'.$partenaire->logo_partenaire) }}" alt="" class="-translate-x-2 rounded-md object-fit w-full h-full">
                    </div>
                    <div class="h-full relative p-5 w-2/3">
                        <div class="relative  sm:absolute top-0 left-0 sm:left-1/2 sm:-translate-x-1/2">
                            <h3 class="text-xl w-full">{{ $partenaire->nom_partenaire }} ({{ $partenaire->abbrev_partenaire }})</h3>
                   
                        </div>
                        
                        <div class="w-11/12 h-4/6 text-wrap relative  sm:absolute sm:top-1/2 sm:left-1/2 sm:-translate-x-1/2 sm:-translate-y-1/2 overflow-y-hidden">
                            <div class="overflow-scroll h-full">
                                <p class="text-wrap"> {!! $partenaire->histoire_partenaire !!}
                                </p>
                            </div>
                        </div>
    
                        <a class="relative sm:absolute bottom-5  left-1/2 -translate-x-1/2" href="{{ $partenaire->siteOff_partenaire }}">
                            <button>
                                Visiter
                            </button>
                        </a>
                    </div>
                </div>

                <div class="bounceslideInFromLeft block sm:hidden mt-32 mx-auto w-full max-w-sm text-center px-5 py-20 rounded-xl relative  partenaire-card">
                    <h3>{{ $partenaire->nom_partenaire }}</h3>
                    <br>
                    <h4>{{ $partenaire->abbrev_partenaire }}</h4>
                    <br>
                    <div class="overflow-hidden h-20 partenaire-collapse">
                        <p class="overflow-y-scroll h-full">
                            {!! $partenaire->histoire_partenaire !!}  
                        </p>
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
            @endforeach

        @else
            <p class="text-center">Aucun partenaire n'est disponible pour le moment.</p>
        @endif
    </div>
</section>
@endsection
