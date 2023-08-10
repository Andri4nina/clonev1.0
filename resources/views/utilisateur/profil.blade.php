@extends('layouts.app')


@section('content')
<main class="w-full max-w-4xl mt-20 ">
    <section class=" user_profil">
        <div class="flex justify-between items-center mb-5">
            <h1 class="show_to_Top">Profil</h1>
        </div>

        <div class="text-white max-w-2xl mx-auto">
            <div class=" rounded-md p-12 user_profil_cards">
                <div class="mx-5 mt-5 text-center ">
                    <i class="text-6xl fa fa-user-circle"></i>
                    <br>
                    <br>
                    <br>
                    <span class="text-lg font-semibold">{{ $utilisateur->name }}</span>
                    <br>
                    <br>
                    <span class="font-medium">{{ $utilisateur->role_user}}</span>
                    <br>
                    <br>
                    <span class="font-medium">{{ $utilisateur->email }}</span>
                    <br>
                    <br>
                    <span class="font-light">{{ $utilisateur->status_user }}</span>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>

                <div class="mx-5 mt-5 text-center ">
                    <h6 class="font-semibold">Taux de travail</h6>
                    <div class="relative mx-auto mt-5 w-80 grid grid-cols-3 gap-1 canvasUser">
                        <div>
                            <span>Creation</span>
                            <canvas id="chartCreation">
                                
                            </canvas>   
                            <span>Globale</span>
                                 
                        </div>
                        <div> 
                            <span>publication</span>
                            <canvas id="chartPublication">
                                
                            </canvas>   
                            <span>Globale</span>
                
                        </div>
                        <div> 
                            <span>Creation</span>
                            <canvas id="chartPersonnel">
                                
                            </canvas>   
                            <span>Personnel</span>
                           
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const chartCreation = document.getElementById('chartCreation');
                new Chart(chartCreation, {
                    type: 'doughnut',
                    data: {
                        datasets: [{
           
                            data: [{{ $countUtilisateurCreation }},{{ $countAllCreation}}],
                            backgroundColor: ['rgb(255, 99, 132)', 'rgb(75,75,75)'],
                            hoverOffset: 4
                        }]
                    }
                });

                const chartPublication = document.getElementById('chartPublication');
                new Chart(chartPublication, {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                      
                            data: [{{ $countUtilisateurPublication }},{{ $countAllPublication}}],
                            backgroundColor: ['rgb(255, 9, 132)', 'rgb(0, 0, 0)'],
                            hoverOffset: 4
                        }]
                    }
                });

                const chartPersonnel = document.getElementById('chartPersonnel');
                new Chart(chartPersonnel, {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: [{{ $countUtilisateurCreation }},{{ $countAllPublication}}],
                            backgroundColor: ['rgb(155, 99, 132)', 'rgb(0,0,0)'],
                            hoverOffset: 4
                        }]
                    }
                });
            </script>


        </div>
                  

    </section> 
</main>
@endsection