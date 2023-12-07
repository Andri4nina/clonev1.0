@extends('layouts.app')

@section('content')
<section class=" block max-w-6xl w-full mx-auto ">
    <div class="relative usersection">
        <h3 class="bounceslideInFromLeft text-2xl pl-2 mb-5 font-semibold">        <a href="{{ route('partenaire.index') }}"  ><i class="text-4xl bx bx-chevron-left"></i></a> Partenaires / <small>Creation / @ {{ $partenaire->nom_partenaire }}</small></h3>

        <form action="{{ route('partenaire.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="the_user" value=" {{\Illuminate\Support\Facades\Auth::user()->name}}">

            <div class="block md:flex max-w-5xl gap-2">
                @if ($errors->any())
                <script type="text/javascript">
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                          toast.addEventListener('mouseenter', Swal.stopTimer)
                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                      })

                      Toast.fire({
                        icon: 'warning',
                        title: 'Veuillez remplir les champs obligatoires'
                      })
                </script>

                @endif
                <div class="bounceslideInFromLeft w-full md:w-1/2 p-5 crud-card">
                    <h4 class="mb-5 font-semibold">Nouveau partenaire</h4>
                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class="relative w-1/12">
                            <i class="absolute top-1/2 -translate-y-1/2 rotate-45 left-0 text-xl bx bxs-hand"></i>
                            <i class="absolute top-1/2 -translate-y-1/2 right-0 -rotate-45  text-xl bx bxs-hand"></i>
                        </div>
                        <input type="text" name='partenaire-name' placeholder="Nom du partenaire" class="w-11/12   bg-none" value="{{$partenaire->nom_partenaire}}">
                    </div>

                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class="relative w-1/12">
                            <i class="text-xl fa fa-puzzle-piece"></i>
                        </div>
                        <input type="text" name='partenaire-abr' placeholder="Abbreviation" class="w-11/12   bg-none" value="{{ $partenaire->abbrev_partenaire }}">
                    </div>
                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class=" w-1/12"><i class="bx bx-book-content text-xl"></i></div>
                        <textarea name="partenaire-histo" id="" cols="30" rows="10" class="w-11/12 bg-none" placeholder="Historique">{{ $partenaire->histoire_partenaire }}</textarea>
                    </div>


                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class=" w-1/12"><i class="text-base ">URL</i></div>
                        <input type="text" name='partenaire-url' placeholder="Site officiel du partenaire" class="w-11/12  bg-none" value="{{ $partenaire->siteOff_partenaire }}">
                    </div>


                    <div class="mb-5  flex justify-center items-center input-field">
                        <div class="w-1/12"><i class="text-2xl bx bx-calendar" ></i></div>
                        <input type="date" name='partenaire-date'  class="w-11/12  bg-none" value='{{ $partenaire->date_relation_partenaire}}'>
                    </div>
                </div>

                <div class="bounceslideInFromRight w-full mt-5 md:mt-0 md:w-1/2 p-5 crud-card">
                    <h4 class="mb-5 font-semibold">Logo</h4>
                    <div class="relative mb-5 w-full h-64">
                        <img src="{{ asset('images/pdp-partenaire/'.$partenaire->logo_partenaire) }}" alt="" class="object-cover w-full h-full partenaire-logo-preview nopdpimg">
                    </div>
                    <div class="">
                        <input type="hidden" name='hidden_partenaire_logo' value="{{ $partenaire->logo_partenaire}}">
                        <input type="file" name="partenaire-logo" id="">
                    </div>
                    <hr>
                    <br>
                    <br>
                    <input type="hidden" name="hidden_id" value='{{ $partenaire->id }}'>
                    @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_partenaire == "1"))
                        <div class="flex w-full justify-center md:justify-end ">
                            <button class=" mb-5 bg-green-500 hover:bg-green-600 text-white">Enregistrer</button>
                        </div>
                        @else
                        <div class="flex w-full justify-center md:justify-end ">
                            <button class=" grayscale mb-5 bg-green-500 hover:bg-green-600 text-white" disabled>Enregistrer</button>
                        </div>
                    @endif
                </div>

            </div>
        </form>
    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputFile = document.querySelector('input[name="partenaire-logo"]');
        const logoImage = document.querySelector('.partenaire-logo-preview');

        inputFile.addEventListener('change', function() {
            const selectedFile = this.files[0];
            if (selectedFile) {
                const reader = new FileReader();
                reader.onload = function() {
                    logoImage.src = reader.result;
                }
                reader.readAsDataURL(selectedFile);
            }
        });
    });

</script>




@endsection
