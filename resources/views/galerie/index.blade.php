@extends('layouts.app')

@section('content')
<section class=" block max-w-fit w-fit mx-auto ">
    <div class=" usersection">
        <h3 class="bounceslideInFromLeft  text-2xl pl-2 mb-5 font-semibold">Galerie photo</h3>
        @foreach($groupedGaleries as $key => $group)
           <div class="w-full">
            <h5 class="bounceslideInFromLeft text-xl font-semibold">{{ \Carbon\Carbon::createFromFormat('Y-n', $key)->format('F Y') }}</h5>
                <hr>
                <div class="bounceslideInFromRight h-auto mx-8 my-5 gap-2 grid grid-cols-4 md:grid-cols-6 galerie-grid">
                    @foreach($group as $galerie)
                        @foreach($photo as $p)
                            @if($p->galerie_id == $galerie->id)
                                <div class="h-32 w-36 ">
                                    <img src="{{ $p->img }}" alt="" class=" w-full h-full">
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection