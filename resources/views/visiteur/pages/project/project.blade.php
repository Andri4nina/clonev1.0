@extends('welcome')

@section('content')
<section class="public-section">
    <h2 class="mb-5">Nos projects</h2>
    @foreach ($projects as $project)
    <div class="mb-5 bounceslideInFromRight project-container">
        <h1 class=" text-2xl font-semibold ">{{ $project->titre_project }}</h1>
        <p class="p-5 text-base project-label">
            {!! $project->contenu_project !!}
        </p>
        <h4 class="project-activity">Zone d'Activité</h4>
        <span>{{ $project->zone_project }}</span>
        <div class="my-5 project-gallery">
            <div class="image-accordion">
                @foreach  ($photos as $key => $photo)
                    <figure class="{{ $key === 0 ? 'selected-image' : '' }}">
                        <img src="{{ asset($photo->img) }}"
                            alt="image">
                    </figure>
                @endforeach
            </div>
        </div>


        <div class="flex gap-2 relative mt-20">
            <ul class="list_obj">
                @foreach ($objectif as $key => $obj)
                    <li class="relative px-2">
                        <label class=" items-center align-middle text-lg pl-8 cursor-auto ">
                           <span class="translate-y-2"> {{ $obj->libelle_obj }}</span>
                               <form  method="POST" class="checkeranim" disabled>


                                <input type="checkbox" name="status" class="opacity-0 cursor-auto statusCheckbox" onclick="doneConfirm(event)" @if ($obj->status_obj == 'Done') checked @endif disabled>
                                <span class="checker"></span>
                            </form>

                        </label>
                    </li>
                @endforeach
            </ul>
            <div class="w-1/2 h-auto">
                <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart green">
                      <path class="circle-bg"
                        d="M18 2.0845
                          a 15.9155 15.9155 0 0 1 0 31.831
                          a 15.9155 15.9155 0 0 1 0 -31.831"
                      />
                      <path class="circle"
                        stroke-dasharray="{{ $percentDone }}, 100"
                        d="M18 2.0845
                          a 15.9155 15.9155 0 0 1 0 31.831
                          a 15.9155 15.9155 0 0 1 0 -31.831"
                      />
                      <text x="18" y="20.35" class="percentage">{{ $percentDone }}%</text>
                    </svg>
                  </div>

            </div>

        </div>
    </div>
    @endforeach

</section>
<script>
    const Projectimages = document.querySelectorAll(".image-accordion img");

    Projectimages.forEach(function (image) {
        image.onclick = function (event) {
            document.querySelector(".selected-image").classList.remove("selected-image");
            const clickParent = event.target.parentNode;
            clickParent.classList.add("selected-image");
        }

    })
</script>
@endsection
