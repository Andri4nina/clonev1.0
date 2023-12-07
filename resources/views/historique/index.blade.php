@extends('layouts.app')

@section('content')
<section class=" block max-w-6xl w-full mx-auto ">
    <div class="relative usersection">
        <div class="fixed top-0 h-32   bg-red-500 w-full historique ">
            <h3 class=" bounceslideInFromLeft text-2xl pt-20 pl-2 mb-5 font-semibold">Historiques</h3>
        </div>
        <div class="mt-32">
            @foreach ($historique as $histo )
            <div class="bounceslideInFromLeft p-5 flex justify-center items-center historie_container">
                <div class="w-1/6">
                    {{ $histo->created_at  }}
                </div>
                <div class="w-5/6 text-right">
                    {{ $histo->descri_histo}}

                </div>

            </div>
        @endforeach

        </div>


    </div>


</section>
@endsection
