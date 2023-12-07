@extends('layouts.app')

@section('content')
<section class=" block max-w-6xl w-full mx-auto ">
    <div class="relative usersection">
        <h3 class="bounceslideInFromLeft text-2xl pl-2 mb-5 font-semibold">        <a href="{{ route('project.index') }}"  ><i class="text-4xl bx bx-chevron-left"></i></a> Project / <small>Appercu</small></h3>

        @if ($message = Session::get('success'))
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
                icon: 'success',
                title: '{{ $message }}'
            })
        </script>
    @endif
        <div class="bounceslideInFromRight project-container">
            <h1 class=" text-2xl font-semibold ">{{ $project->titre_project }}</h1>
            <p class="p-5 text-base project-label">
                {{ $project->contenu_project }}
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


            <div class="block sm:flex gap-2 relative mt-20">
                <ul class="w-full sm:w-1/2 list_obj">
                    @foreach ($objectif as $key => $obj)
                        <li class="relative px-2">
                            <label class=" items-center align-middle text-lg pl-8 cursor-pointer ">
                               <span class="translate-y-2"> {{ $obj->libelle_obj }}</span>
                               @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_partenaire == "1"))
                                   <form action="{{ route('project.objectif')}}" method="POST" class="checkeranim">
                                    @csrf
                                    <input type="hidden" name="hidden_id_pro" value="{{ $project->id }}">
                                    <input type="hidden" name="hidden_id" value="{{ $obj->id }}">
                                    <input type="checkbox" name="status" class="opacity-0 cursor-pointer statusCheckbox" onclick="doneConfirm(event)" @if ($obj->status_obj == 'Done') checked @endif>
                                    <span class="checker"></span>
                                </form>
                                @else
                                    <input disabled type="checkbox" name="status" class="grayscale opacity-0 cursor-pointer statusCheckbox" onclick="doneConfirm(event)" @if ($obj->status_obj == 'Done') checked @endif>
                                    <span class=" checker"></span>
                                @endif

                            </label>
                        </li>
                    @endforeach
                </ul>
                <div class="w-full sm:w-1/2 h-auto">
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
   </div>


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

<script>
    window.doneConfirm = function(e) {
        var form = e.target.form;
        var checkbox = form.querySelector('[name="status"]');
        var statusCheckbox = document.getElementById('statusCheckbox');


       if (checkbox.checked==true) {
               Swal.fire({
                   title: "Etes vous sur d'avoir atteint cette objectif ?",
                   icon: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#1F9B4F',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Oui!',
                   cancelButtonText: 'Annuler'
               }).then((result) => {
                   if (result.isConfirmed) {
                   form.submit();
                   }else{
                       checkbox.checked = false;
                   }
               })
           }else{
               Swal.fire({
                   title: "Etes vous sur que cette objectif n'est pas atteint?",
                   text:'vous pouvez toujours publier ce project',
                   icon: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#1F9B4F',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Oui!',
                   cancelButtonText: 'Annuler'
               }).then((result) => {
                   if (result.isConfirmed) {
                   form.submit();
                   }else{
                       checkbox.checked = true;
                   }
               })
           }
       }

</script>



@endsection
