@extends('welcome')

@section('content')
<section>



    {{--  organigramme --}}
    <h3 class="font-semibold text-2xl p-10">Organigramme</h3>
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
</section>


@endsection