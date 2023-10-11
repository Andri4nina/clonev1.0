@extends('layouts.app')

@section('content')
<section class="block w-11/12 mx-auto ">
    <div class="usersection">
        <h3 class="text-base pl-2 mb-5">Taches</h3>
        <div class="mb-5 w-full">
            <div class="mb-5  flex justify-center items-center input-field">
                <div class="w-1/12"><i class="text-2xl bx bx-task"></i></div>
                <input type="text" name='tache-titre' placeholder="Nouvel taches" class="w-11/12  bg-none">
                <button><i class="bx bxs-send"></i></button>
            </div>
        </div>

        <div class="overflow-hidden max-h-screen h-auto w-full flex gap-2">
            <div class="w-1/4">
                <h4 class="text-center">Nouvel tache</h4>
                <div class="overflow-y-hidden max-h-screen h-auto">
                    <ul class="overflow-y-scroll overflow-x-hidden pt-5 h-5/6">
                        <li class="mb-5 relative text-xs flex justify-between task-card">
                            <div>Verification des projects</div>
                            <form class="absolute top-0 right-0  -translate-y-1/2 delete-task" action="">
                                <button class="absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2"><i class="text-sm text-red-500 bx bx-x"></i></button>
                            </form>
                            <form class="absolute top-1/2 right-1  -translate-y-1/2 " action="">
                                <button class="absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2"><i class="text-sm text-blue-500 bx bxs-pen"></i></button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="w-1/4">
                <h4 class="text-center">Tache en progression</h4>
                <div class="overflow-y-hidden max-h-screen h-auto">
                    <ul class="overflow-y-scroll overflow-x-hidden pt-5 h-5/6">
                        <li class="mb-5 relative text-xs flex justify-between items-center task-card progress">
                            <div>Verification des projects</div>
                            <form class="-translate-y-1/3" action="">
                                <button class=""><i class="text-sm bx bx-check-circle"></i></button>
                            </form>
                            <form class="-translate-y-1/3" action="">
                                <button class=""><i class="text-sm text-blue-500 bx bx-sync"></i></button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="w-1/4">
                <h4 class="text-center">Tache en revision</h4>
                <div class="overflow-y-hidden max-h-screen h-auto">
                    <ul class="overflow-y-scroll overflow-x-hidden pt-5 h-5/6">
                        <li class="mb-5 relative text-xs flex justify-between items-center task-card review">
                            <div>Verification des projects</div>
                            <form class="-translate-y-1/3" action="">
                                <button class=""><i class="text-sm hover:text-green-500 bx bx-check-circle"></i></button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="w-1/4">
                <h4 class="text-center">Tache accomplie</h4>
                <div class="overflow-y-hidden max-h-screen h-auto">
                    <ul class="overflow-y-scroll overflow-x-hidden pt-5 h-5/6">
                        <li class="mb-5 relative text-xs flex justify-between items-center task-card done">
                            <div>Verification des projects</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <form action="">
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
                            <input type="text" id="enfants" value="0">
                            <div class="w-1/2 relative">
                                <button type='button' class="stepper-up">+</button>
                                <button type='button' class="stepper-down">-</button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-center">Adolescents</h4>
                        <div class="relative my-5 flex w-72 mx-auto stepper">
                            <input type="text" id="adolescents" value="0">
                            <div class="w-1/2 relative">
                                <button type='button' class="stepper-up">+</button>
                                <button type='button' class="stepper-down">-</button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-center">Adultes</h4>
                        <div class="relative my-5 flex w-72 mx-auto stepper">
                            <input type="text" id="adultes" value="0">
                            <div class="w-1/2 relative">
                                <button type='button' class="stepper-up">+</button>
                                <button type='button' class="stepper-down">-</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mx-auto w-fit">
                <button class="mb-5 bg-green-500 hover:bg-green-600 text-white">Enregistrer</button>
            </div>
        </form>
        
     
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



@endsection