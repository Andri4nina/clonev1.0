@extends('layouts.app')

@section('content')
<section class="block w-11/12 mx-auto ">
    <div class="usersection">
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
    <h3 class="bounceslideInFromLeft text-2xl pl-2 mb-5 font-semibold">Taches</h3>
    @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_task == "1"))  
        <form class="bounceslideInFromLeft" action="{{ route('tache.CRUD')}}" method="POST">
            @csrf
    @endif
            <div class="mb-5 w-full">
                <div class="mb-5  flex justify-center items-center input-field">
                    <div class="w-1/12"><i class="text-2xl bx bx-task"></i></div>
                   
                        <input type="hidden" name="hidden_id" id="id_modif">
                        <input type="text" name='tache-titre' placeholder="Nouvel taches" class="w-11/12  bg-none">
                        @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_task == "1"))  
                            <button><i class="bx bxs-send"></i></button>
                        @endif
                </div>
            </div>
    @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_task == "1")) 
        </form>
    @endif
        <div class="overflow-hidden max-h-screen h-auto w-full flex gap-2">
            <div class="bounceslideInFromLeft w-1/4">
              
                <h4 class="text-center">Nouvel tache</h4>
              
                    <div class="overflow-y-hidden max-h-screen h-auto">
                        <ul class="overflow-y-scroll overflow-x-hidden pt-5 h-5/6">
                        @foreach($tache as $tache)
                            <li class="mb-5 relative text-xs flex justify-between task-card newTask" >
                                <div id="content{{ $tache->id }}">{{ $tache->libelle_task }}</div>
                                <input type="hidden" name="hidden_id" value="{{ $tache->id }}">
                                @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_task == "1")) 
                               
                                    <form class="absolute top-0 right-0  -translate-y-1/2 delete-task" action="{{ route('tache.destroy', $tache->id) }}" method="POST" >
                                    
                                        @method('delete')
                                        @csrf
                                        <button class="absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2" onclick="deleteConfirm(event)"><i class="text-sm text-red-500 bx bx-x"></i></button>
                                    </form>
                                    <div class="absolute top-1/2 right-3 -translate-y-1/2 ">
                                        <button class="absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2" onclick="addTomodif({{ $tache->id }})"><i class="text-sm text-blue-500 bx bxs-pen"></i></button>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                        </ul>
                    </div>
             
               
            </div>

            <div class="bounceslideInFromLeft w-1/4">
                <h4 class="text-center">Tache en progression</h4>
                <div class="overflow-y-hidden max-h-screen h-auto">
                    <ul class="overflow-y-scroll overflow-x-hidden pt-5 h-5/6">
                        @foreach($tacheProgress as $tache)
                            <li class="mb-5 relative text-xs flex justify-between items-center task-card progress">
                                <div>{{ $tache->libelle_task }}</div>
                                @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_task == "1")) 
                                <form class="-translate-y-1/3" action="{{ route('tache.done',$tache->id) }}" method="POST">
                                    @csrf
                                    <button class="" onclick="doneConfirm(event)"><i class="text-sm bx bx-check-circle"></i></button>
                                </form>
                                <form class="-translate-y-1/3" action="{{ route('tache.review',$tache->id) }}" method="POST">
                                    @csrf
                                    <button class="" onclick="reviewConfirm(event)"><i class="text-sm text-blue-500 bx bx-sync"></i></button>
                                </form>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="bounceslideInFromRight w-1/4">
                <h4 class="text-center">Tache en revision</h4>
                <div class="overflow-y-hidden max-h-screen h-auto">
                    <ul class="overflow-y-scroll overflow-x-hidden pt-5 h-5/6">
                        @foreach($tachereview as $tache)
                        <li class="mb-5 relative text-xs flex justify-between items-center task-card review">
                            <div>{{ $tache->libelle_task }}</div>
                            @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_task == "1")) 
                            <form class="-translate-y-1/3" action="{{ route('tache.done',$tache->id) }}" method="POST">
                                @csrf
                                <button class="" onclick="doneConfirm(event)"><i class="text-sm hover:text-green-500 bx bx-check-circle"></i></button>
                            </form>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="bounceslideInFromRight w-1/4">
                <h4 class="text-center">Tache accomplie</h4>
                <div class="overflow-y-hidden max-h-screen h-auto">
                    <ul class="overflow-y-scroll overflow-x-hidden pt-5 h-5/6">
                        @foreach($tacheDone as $tache)
                            <li class="mb-5 relative text-xs flex justify-between items-center task-card done">
                                <div>{{ $tache->libelle_task }}</div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>


        <div class=" flex gap-2">
            <div class="bounceslideInFromLeft w-2/3">
                @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_task == "1")) 
                <form action="{{ route('tache.impact') }}" method="POST">
                    @csrf
                @endif
                    <div class="relative w-full">
                        <h4 class="text-center">Personnes Impactées</h4>
                        <div class="relative my-5 flex w-72 mx-auto stepper">
                            <input type="text" id="personnes_impactees" value="0">
                            <div class="w-1/2 relative">
              
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <div>
                                <h4 class="text-center">Enfants</h4>
                                <div class="relative my-5 flex w-72 mx-auto stepper">
                                    <input type="text" id="enfants" name="enfants" value="0">
                                    <div class="w-1/2 relative">
                                        <button type='button' class="stepper-up">+</button>
                                        <button type='button' class="stepper-down">-</button>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-center">Adolescents</h4>
                                <div class="relative my-5 flex w-72 mx-auto stepper">
                                    <input type="text"  id="adolescents" name="adolescents" value="0">
                                    <div class="w-1/2 relative">
                                        <button type='button' class="stepper-up">+</button>
                                        <button type='button' class="stepper-down">-</button>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-center">Adultes</h4>
                                <div class="relative my-5 flex w-72 mx-auto stepper">
                                    <input type="text" id="adultes" name="adultes" value="0">
                                    <div class="w-1/2 relative">
                                        <button type='button' class="stepper-up">+</button>
                                        <button type='button' class="stepper-down">-</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mx-auto w-fit">
                        @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_task == "1")) 
                        <button class="mb-5 bg-green-500 hover:bg-green-600 text-white">Enregistrer</button>
                        @else
                        <button class="grayscale mb-5 bg-green-500 hover:bg-green-600 text-white">Enregistrer</button>
                        
                        @endif

                    </div>
            @if (Auth::user()->prvlg_super_user == "1"||(Auth::user()->prvlg_task == "1")) 
                </form>
            @endif
            </div>
            <div class="bounceslideInFromRight w-1/3 mx-auto">
                <div class="w-full p-5 dash-card mb-2 h-auto">
                    <h3 class="text-sm mb-5 font-semibold">Nombre de Personne impacter en general</h3>
                    <div class="flex justify-center items-center gap-2">
                        <div class="w-1/2">
                            <span class="text-sm font-semibold">Total</span><br><br>
                            <span>{{ $totalGeneral }} <br><small>Personnes</small></span>
                        </div>
                        <div class="relative w-1/2">
                            <canvas id="ImpactDoughnutChart" class="w-full h-28"></canvas>
                        
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const impactDoughnut = document.getElementById('ImpactDoughnutChart').getContext('2d');
    
                                    const dataimpact = {
                                        datasets: [{
                                            data: [{{ $impactValues->adultes }}, {{ $impactValues->adolescents }}, {{ $impactValues->enfants }}],
                                            backgroundColor: [
                                                'rgba(0, 125, 255, 0.6)',
                                                'rgba(255, 123, 7, 0.6)',
                                                'rgba(0, 255, 54, 0.6)'
                                            ],
                                            borderColor: [
                                                'rgba(0, 123, 255, 1)',
                                                'rgba(255, 123, 7, 1)',
                                                'rgba(0, 255, 54, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    };
    
                                    const options = {
                                        plugins: {
                                            legend: {
                                                display: false,
                                                position: 'top'
                                            }
                                        },
                                        title: {
                                            display: true,
                                            text: 'Répartition des Impacts'
                                        }
                                    };
    
                                    const ImpactDoughnutChart = new Chart(impactDoughnut, {
                                        type: 'doughnut',
                                        data: dataimpact,
                                        options: options
                                    });
                                });
                            </script>
    
                        
                        </div>
                    </div>
                    <ul>
                       
                        <li class="my-2 text-xs flex items-center justify-between">
                            <div class="flex items-center justify-around">
                                <div class=" dash-icon">
                                    <i class="text-green-500 bx bxs-user"></i>
                                </div>
                         
                                <span>{{ $impactValues->enfants }}</span>
                            </div>
                            <div class="float-right">Enfants</div>
                        </li>
                        <li class="mb-2 text-xs flex items-center justify-between">
                            <div class="flex items-center justify-around">
                                <div class=" dash-icon">
                                    <i class="text-orange-500 bx bxs-user"></i>
                                </div>
                                <span>{{ $impactValues->adolescents }}</span>
                            </div>
                            <div class="float-right">Adolescent</div>
                        </li>
                        <li class="mb-2 text-xs flex items-center justify-between">
                            <div class="flex items-center justify-around">
                                <div class=" dash-icon">
                                    <i class="text-blue-500 bx bxs-user"></i>
                                </div>
                                <span>{{ $impactValues->adultes }}</span>
                            </div>
                            <div class="float-right">Adultes</div>
                        </li>
                  
                    </ul>
                </div>
    
    
            </div>
        </div>

        

        
     
    </div>
</section>

<script>
    const personnesImpacteesInput = document.getElementById('personnes_impactees');
    const enfantsInput = document.getElementById('enfants');
    const adolescentsInput = document.getElementById('adolescents');
    const adultesInput = document.getElementById('adultes');

    const validateInput = function(input) {
        const value = parseInt(input.value);
        if (isNaN(value) || value <= 0) {
            input.value = '0';
        }
    };

    const updatePersonnesImpactees = function() {
        const enfantsValue = parseInt(enfantsInput.value) || 0;
        const adolescentsValue = parseInt(adolescentsInput.value) || 0;
        const adultesValue = parseInt(adultesInput.value) || 0;

        const newTotal = enfantsValue + adolescentsValue + adultesValue;
        personnesImpacteesInput.value = newTotal;
    };

    [enfantsInput, adolescentsInput, adultesInput, personnesImpacteesInput].forEach(input => {
        input.addEventListener('input', function() {
            validateInput(input);
            updatePersonnesImpactees();
        });
    });

    const plus = document.querySelectorAll('.stepper-up');
    const minus = document.querySelectorAll('.stepper-down');

    plus.forEach(button => {
        button.addEventListener('click', function() {
            const input = button.parentElement.parentElement.querySelector('input');
            input.value = parseInt(input.value) + 1;
            validateInput(input);
            updatePersonnesImpactees();
        });
    });

    minus.forEach(button => {
        button.addEventListener('click', function() {
            const input = button.parentElement.parentElement.querySelector('input');
            if (parseInt(input.value) > 0) {
                input.value = parseInt(input.value) - 1;
            }
            validateInput(input);
            updatePersonnesImpactees();
        });
    });
</script>

<script>
    function addTomodif(string){
        var id = document.getElementById('id_modif');
        var content = document.getElementById('content'+string).textContent;
        id.setAttribute("value", string);

        var contentshow = document.querySelector('[name="tache-titre"]');

        contentshow.setAttribute("value", content);
    }

</script>
<script type="text/javascript">
    window.deleteConfirm = function(e) {
        e.preventDefault();
        var form = e.target.form;
        Swal.fire({
                title: 'Etes vous sur de vouloir supprimer cette tache ?',
                text: "Vous ne pouvez plus retourner en arriere!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1F9B4F',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
            form.submit();
            }
        })
    }
</script>

<script type="text/javascript">
    window.doneConfirm = function(e) {
        e.preventDefault();
        var form = e.target.form;
        Swal.fire({
                title: "Etes vous sur d'avoir accompli cette tache ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1F9B4F',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui!',
                cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
            form.submit();
            }
        })
    }
</script>

<script type="text/javascript">
    window.reviewConfirm = function(e) {
        e.preventDefault();
        var form = e.target.form;
        Swal.fire({
                title: 'Etes vous sur que cette tache est mal effectuer pour le mettre en revision?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1F9B4F',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui!',
                cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
            form.submit();
            }
        })
    }
</script>
@endsection