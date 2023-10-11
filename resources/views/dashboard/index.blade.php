@extends('layouts.app')

@section('content')
<section class="block max-w-fit w-fit mx-auto ">
    <div class="usersection">
        <h3 class="text-base pl-2 mb-5">Tableau de bord</h3>
        <div class="block lg:flex gap-2 mb-5 mx-6 firstdash">
            <div class="bounceslideInFromLeft p-10 w-11/12 lg:w-2/4 dash-card mb-2">
                <h3 class="font-semibold text-xl dash-hello">Bonjour   {{\Illuminate\Support\Facades\Auth::user()->name }} </h3>
                <br>
                <br>
                {{--  en fonction de la meteo  --}}
                <p class="pb-10 text-xs">Une belle journee aujourd'hui vous pouvez verifier toute les taches a faire </p>
                <br>
                <a href="{{ route('tache.index') }}"><button class="flex justify-center items-center gap-2 btn-newtask text-xs"><span>Nouvelles taches</span><i class="bx bx-plus"></i>   </button></a>
            </div>

            <div class="bounceslideInFromRight w-1/2 lg:w-1/4 p-5 dash-card mb-2">
                <div class="mb-5 dash-icon icon-color-theme">
                    <i class="bx bxs-group"></i>
                </div>
                <br>
                <span class="mt-5 text-base font-semibold">Nombre de visiteur</span>
                <br> <br> <br>
    
                <div class="mt-8">
                    <div class="font-semibold text-base ">
                        500
                    </div>
                    <div class="text-sm text-green-500">
                        +50 Aujourd'hui
                    </div>
                </div>
            </div>

            <div class=" bounceslideInFromRight w-1/2 lg:w-1/4 p-5 dash-card mb-2">
                <div class="mb-5 dash-icon icon-color-theme">
                    <i class="bx bx-money"></i>
                </div>
                <br> 
                <span class="mt-5 text-base font-semibold">Don collecter</span>
                <br> <br> <br>
                <div class="mt-8">
                    <div class="font-semibold text-base ">
                        500 Ar
                    </div>
                    <div class="text-sm text-green-500">
                        +50 Aujourd'hui
                    </div>
                </div>
            </div>

        </div>
     
        <div class="flex gap-2 mb-5 mx-6">
            <div class="bounceslideInFromLeft p-5 w-4/6 dash-card mb-2">
                <h3 class="font-semibold text-base mb-5">Total dons</h3>
                <div class="flex gap-2">
                    <div class="w-2/3 ">
                        <canvas width="400px" height="200px" id="Donchart"></canvas>        
                        <script>
                            // Données pour les don de l'année précédente
                            const donAnneePrecedente = [120, 150, 180, 350, 380, 400];
                    
                            // Données pour les don de l'année actuelle (jusqu'à aujourd'hui)
                            const donAnneeActuelle = [190, 210, 230, 260, 290, 310];
                    
                            const ctx = document.getElementById('Donchart').getContext('2d');
                    
                            const Donchart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: ['Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep'],
                                    datasets: [
                                        {
                                            label: 'Année Précédente',
                                            data: donAnneePrecedente,
                                            backgroundColor: 'rgb(40, 204, 238)',
                                            borderWidth: 1,
                                        },
                                        {
                                            label: 'Année Actuelle',
                                            data: donAnneeActuelle,
                                            backgroundColor: ' rgb(127, 129, 255)',
                                            borderWidth: 1
                                        }
                                    ]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    },
                                    plugins: {
                                        legend: {
                                            position: 'top',
                                            labels: {
                                                usePointStyle: true, // Permet d'utiliser des formes pour les légendes
                                                pointStyle: 'circle', // Utilise des cercles comme forme
                                                borderRadius: 0, // Désactive la bordure des légendes
                                                fontSize: 14 // Vous pouvez ajuster la taille de police
                                            }
                                        },
                                        title: {
                                            display: true,
                                            text: 'Comparaison des Dons Annuels'
                                        }
                                    },
                                    layout: {
                                        padding: {
                                            left: 10,
                                            right: 10,
                                            top: 0,
                                            bottom: 10
                                        }
                                    },
                                    elements: {
                                        bar: {
                                            borderRadius: 10 // Vous pouvez ajuster la valeur selon votre préférence
                                        }
                                    },
                                    scales: {
                                        x: {
                                            grid: {
                                                display: false // Cela supprime les repères verticaux
                                            }
                                        },
                                        y: {
                                            
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                    <div class="w-1/3 relative">
                        <canvas id="VisitChart" class="w-full h-28"></canvas>
                        <span class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 text-base">75%</span>
                        <script>
                            const ctxDonut = document.getElementById('VisitChart').getContext('2d');
                    
                            const data = {
                                labels: ['Année Dernière', 'Cette Année'],
                                datasets: [{
                                    data: [100, 175],
                                    backgroundColor: [
                                        'rgba(128, 128, 128, 1)', // Transparent pour l'année dernière
                                        'rgba(127, 0, 255, 1)' // Violet pour cette année (utilisation d'une couleur solide)
                                    ],
                                    borderColor: [
                                        'rgba(0, 0, 0, 0)',
                                        'rgba(0, 0, 0, 0)'
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
                                    text: 'Taux de Visite Annuel'
                                }
                            };
                    
                            const VisitChart = new Chart(ctxDonut, {
                                type: 'doughnut',
                                data: data,
                                options: options
                            });
                        </script>
    
                        <div class="mt-10 flex justify-center gap-2">
                            <div class="flex items-center justify-center gap-2">
                                <div class=" dash-icon">
                                    <i class="text-gray-500 bx bxs-group"></i>
                                </div>
                                <p class="text-sm">2021</p>
                            </div>
                            <div class="flex items-center justify-center gap-2">
                                <div class="dash-icon">
                                    <i class="text-purple-500 bx bxs-group"></i>
                                </div>
                                <p class="text-sm">2022</p>
                            </div>
                        </div>
                    </div>
                </div>       
            </div>

            <div class="bounceslideInFromRight w-2/6">
                <div class="flex gap-2 mb-5">
                    <div class="w-1/2 h-1/3 p-5 dash-card mb-2">
                        <div class="mb-5 dash-icon">
                            <i class="text-green-500 bx bx-task"></i>
                        </div>
                        <span class="mt-5 text-sm font-semibold">Les projects <br> terminer</span>
                        <div class="mt-8">
                            <div class="font-semibold text-base ">
                                500
                            </div>
                           
                        </div>
                    </div>
                    <div class="w-1/2 h-1/3 p-5 dash-card mb-2">
                        <div class="mb-5 dash-icon">
                            <i class="text-red-500 bx bx-task-x"></i>
                        </div>
                        <span class="mt-5 text-sm font-semibold">Les projects <br> en cours</span>
                        <div class="mt-8">
                            <div class="font-semibold text-base ">
                                500 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full p-16 dash-card mb-2">
                    <div class="relative flex gap-2">
                        <div class="left-panel panel">
                            <div class="date">
                                <?php
                                setlocale(LC_TIME, 'fr_FR.utf8');
                                echo strftime('%A, %e %B %Y');
                                ?>
                            </div>
                            
                            <div class="city">
                                Antananarivo
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bounceslideInFromBottom flex gap-2 mb-5 mx-6">
          
            <div class="w-1/3 p-5 dash-card mb-2 h-96">
                <h3 class="text-sm mb-5 font-semibold">Nombre de Personne impacter</h3>
                <div class="flex justify-center items-center gap-2">
                    <div class="w-1/2">
                        <span class="text-sm font-semibold">Total</span><br><br>
                        <span>1000 <br><small>Personnes</small></span>
                    </div>
                    <div class="relative w-1/2">
                        <canvas id="ImpactDoughnutChart" class="w-full h-28"></canvas>
                    
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const impactDoughnut = document.getElementById('ImpactDoughnutChart').getContext('2d');

                                const dataimpact = {
                                    datasets: [{
                                        data: [200, 200, 200],
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
                            <span>200</span>
                        </div>
                        <div class="float-right">Enfants</div>
                    </li>
                    <li class="mb-2 text-xs flex items-center justify-between">
                        <div class="flex items-center justify-around">
                            <div class=" dash-icon">
                                <i class="text-orange-500 bx bxs-user"></i>
                            </div>
                            <span>200</span>
                        </div>
                        <div class="float-right">Adolescent</div>
                    </li>
                    <li class="mb-2 text-xs flex items-center justify-between">
                        <div class="flex items-center justify-around">
                            <div class=" dash-icon">
                                <i class="text-blue-500 bx bxs-user"></i>
                            </div>
                            <span>200</span>
                        </div>
                        <div class="float-right">Adultes</div>
                    </li>
                 
                </ul>
            </div>

            <div class="w-1/3 p-5 dash-card mb-2 h-96">
                <h3 class="text-sm mb-5 font-semibold">Listes des Utilisateurs</h3>
                <div class="overflow-y-hidden h-full">
                    <ul class="overflow-y-scroll h-5/6">
                        <li class="text-xs my-5 flex justify-between ">
                            <div class="flex gap-2justify-center items-center">
                                <div class="  bg-blue-600 w-10 h-10 rounded-full">
                                    <img src="" alt="" class="w-full h-full">
                                </div>
                                <div>
                                    Administrateur
                                </div>
                            </div>
                            <div class=" flex gap-2 justify-center items-center text-sm font-bold ">
                                <div>
                                  <div class="bg-green-600 w-3 h-3 rounded-full userstatus"></div>
                                </div>
                            </div> 
                        </li>

                        <li class="text-xs my-5 flex justify-between ">
                            <div class="flex gap-2justify-center items-center">
                                <div class="  bg-blue-600 w-10 h-10 rounded-full">
                                    <img src="" alt="" class="w-full h-full">
                                </div>
                                <div>
                                    Administrateur
                                </div>
                            </div>
                            <div class=" flex gap-2 justify-center items-center text-sm font-bold ">
                                <div>
                                  <div class="bg-green-600 w-3 h-3 rounded-full userstatus"></div>
                                </div>
                            </div> 
                        </li>

                        <li class="text-xs my-5 flex justify-between ">
                            <div class="flex gap-2justify-center items-center">
                                <div class="  bg-blue-600 w-10 h-10 rounded-full">
                                    <img src="" alt="" class="w-full h-full">
                                </div>
                                <div>
                                    Administrateur
                                </div>
                            </div>
                            <div class=" flex gap-2 justify-center items-center text-sm font-bold ">
                                <div>
                                  <div class="bg-green-600 w-3 h-3 rounded-full userstatus"></div>
                                </div>
                            </div> 
                        </li>

                        <li class="text-xs my-5 flex justify-between ">
                            <div class="flex gap-2justify-center items-center">
                                <div class="  bg-blue-600 w-10 h-10 rounded-full">
                                    <img src="" alt="" class="w-full h-full">
                                </div>
                                <div>
                                    Administrateur
                                </div>
                            </div>
                            <div class=" flex gap-2 justify-center items-center text-sm font-bold ">
                                <div>
                                  <div class="bg-green-600 w-3 h-3 rounded-full userstatus"></div>
                                </div>
                            </div> 
                        </li>
                        <li class="text-xs my-5 flex justify-between ">
                            <div class="flex gap-2justify-center items-center">
                                <div class="  bg-blue-600 w-10 h-10 rounded-full">
                                    <img src="" alt="" class="w-full h-full">
                                </div>
                                <div>
                                    Administrateur
                                </div>
                            </div>
                            <div class=" flex gap-2 justify-center items-center text-sm font-bold ">
                                <div>
                                  <div class="bg-green-600 w-3 h-3 rounded-full userstatus"></div>
                                </div>
                            </div> 
                        </li>
                        
                    </ul>
                </div>
            </div>

            <div class="w-1/3 p-5 dash-card mb-2 h-96">
                <h3 class="text-sm mb-5 font-semibold">Listes des taches</h3>
                <div class="overflow-y-hidden h-full">
                    <ul class="overflow-y-scroll h-5/6">
                        <li class="text-xs flex justify-between task-agree">
                            <div>Verification des projects</div>
                            <form action="">
                                <button><i class="text-gray-500 bx bx-check"></i></button>
                            </form>
                        </li>
                        <li class="text-xs flex justify-between task-agree">
                            <div>Verification des projects</div>
                            <form action="">
                                <button><i class="text-gray-500 bx bx-check"></i></button>
                            </form>
                        </li>
                        <li class="text-xs flex justify-between task-agree">
                            <div>Verification des projects</div>
                            <form action="">
                                <button><i class="text-gray-500 bx bx-check"></i></button>
                            </form>
                        </li>
                        <li class="text-xs flex justify-between task-agree">
                            <div>Verification des projects</div>
                            <form action="">
                                <button><i class="text-gray-500 bx bx-check"></i></button>
                            </form>
                        </li>
                        <li class="text-xs flex justify-between task-agree">
                            <div>Verification des projects</div>
                            <form action="">
                                <button><i class="text-gray-500 bx bx-check"></i></button>
                            </form>
                        </li>
                        <li class="text-xs flex justify-between task-agree">
                            <div>Verification des projects</div>
                            <form action="">
                                <button><i class="text-gray-500 bx bx-check"></i></button>
                            </form>
                        </li>
                        <li class="text-xs flex justify-between task-agree">
                            <div>Verification des projects</div>
                            <form action="">
                                <button><i class="text-gray-500 bx bx-check"></i></button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>      
        </div>
    </div>
</section>
@endsection