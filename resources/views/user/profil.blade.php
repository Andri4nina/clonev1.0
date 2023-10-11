@extends('layouts.app')

@section('content')
<section class=" block w-10/12 mx-auto ">
    <div class="relative usersection">
        <h3 class="text-base pl-2 mb-5">Utilisateurs / Profil / @<b>Administrateur</b> </h3>
            <div class="flex max-w-5xl gap-2">

                <div class="bounceslideInFromLeft w-1/2 p-5 crud-card">
                    <h4 class="font-semibold">Information Personnel de l'utilisateur</h4>
                    <div class="my-5 flex justify-center items-center">
                        <div class="relative h-20 w-20">
                            <img src="" alt="" id="pdp" class=" h-full w-full bg-gray-400 border border-gray-600 rounded-full">
                        </div> 
                    </div>
                    <div class="mb-5 flex justify-start items-center">
                        <div class="w-1/12"><i class="">@</i></div>
                        <span> Administrateur</span>
                    </div>
                    <div class="mb-5 flex justify-start items-center">
                        <div class="w-1/12"><i class="bx bx-envelope"></i></div>
                        <span> Administrateur@gmail.com</span>
                    </div>

                    <div class="mb-5 flex justify-start items-center">
                        <div class="w-1/12"><i class="bx bx-badge"></i></div>
                        <span>Administrateur</span>
                    </div>

                    <div class="mb-5 flex justify-start items-center">
                        <div class="w-1/12"><i class="bx bx-phone"></i></div>
                        <span>034 34 034 34</span>
                    </div>
                </div>

                <div class="bounceslideInFromRight w-1/2 p-5 grayscale crud-card">
                    <h4 class="mb-5 font-semibold">Privilege</h4>
                    <div class="mb-5 flex justify-center items-center">
                        <h5 class="w-10/12">Super utilisateur</h5>
                        <div class="w-2/12">
                            <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                <input class="form-checkbox" type="checkbox" id="super-user" disabled  name="super-user" >
                                <label class="ml-2" for="super-user"></label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5 flex justify-center items-center">
                        <h5 class="w-10/12">Gestion des taches</h5>
                        <div class="w-2/12">
                            <div class="flex justify-center items-center prvlg-switcher">
                                <input class="form-checkbox" type="checkbox" id="tache" disabled  name="tache" >
                                <label class="ml-2" for="tache"></label>
                            </div>
                        </div>
                    </div>
                    <h5 class="w-10/12">Gestion des utilisateurs</h5>
                    <div class="mb-5 flex justify-center items-center">
                        <div class="w-1/2  mt-5 flex justify-center items-center">
                            <div>Creation</div>
                            <div class="">
                                <div class="flex justify-center items-center prvlg-switcher">
                                    <input class="form-checkbox" type="checkbox" id="create-user" disabled  name="create-user" >
                                    <label class="ml-2" for="create-user"></label>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2 mt-5 flex justify-center items-center">
                            <div>Modification</div>
                            <div class="">
                                <div class="flex justify-center items-center prvlg-switcher">
                                    <input class="form-checkbox" type="checkbox" id="updat-user" disabled  name="updat-user" >
                                    <label class="ml-2" for="updat-user"></label>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2 mt-5 flex justify-center items-center">
                            <div>Suppression</div>
                            <div class="">
                                <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                    <input class="form-checkbox" type="checkbox" id="del-user" disabled  name="del-user" >
                                    <label class="ml-2" for="del-user"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="mb-5 flex justify-center items-center">
                        <h5 class="w-10/12">Gestion des membres</h5>
                        <div class="w-2/12">
                            <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                <input class="form-checkbox" type="checkbox" id="membre" disabled  name="membre" >
                                <label class="ml-2" for="membre"></label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5 flex justify-center items-center">
                        <h5 class="w-10/12">Gestion des project</h5>
                        <div class="w-2/12">
                            <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                <input class="form-checkbox" type="checkbox" id="project" disabled  name="project" >
                                <label class="ml-2" for="project"></label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5 flex justify-center items-center">
                        <h5 class="w-10/12">Gestion des partenaires</h5>
                        <div class="w-2/12">
                            <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                <input class="form-checkbox" type="checkbox" id="partenaire" disabled  name="partenaire" >
                                <label class="ml-2" for="partenaire"></label>
                            </div>
                        </div>
                    </div>

                    <h5 class="w-10/12">Gestion des blog</h5>
                    <div class="mb-5 grid grid-cols-2 justify-start items-center">
                        <div class="w-1/2  mt-5 grid items-center">
                            <div>Creation</div>
                            <div class="">
                                <div class="flex justify-center items-center prvlg-switcher">
                                    <input class="form-checkbox" type="checkbox" id="create-blog" disabled  name="create-blog" >
                                    <label class="ml-2" for="create-blog"></label>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2 mt-5  grid items-center">
                            <div>Modification</div>
                            <div class="">
                                <div class="flex justify-center items-center prvlg-switcher">
                                    <input class="form-checkbox" type="checkbox" id="updat-blog" disabled  name="updat-blog" >
                                    <label class="ml-2" for="updat-blog"></label>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2 mt-5  grid items-center">
                            <div>Suppression</div>
                            <div class="">
                                <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                    <input class="form-checkbox" type="checkbox" id="del-blog" disabled  name="del-blog" >
                                    <label class="ml-2" for="del-blog"></label>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2 mt-5  grid items-center">
                            <div>Approbation</div>
                            <div class="">
                                <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                    <input class="form-checkbox" type="checkbox" id="approb-blog" disabled  name="approb-blog" >
                                    <label class="ml-2" for="approb-blog"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                
            </div>
            <div class="bounceslideInFromBottom w-full my-5 p-5 crud-card">
                <h4 class="mb-5 font-semibold">Contribution</h4>
                <div class="flex  justify-center items-center">
                    <div class="w-1/3">
                        <canvas height="200px" id="donutChart1" class="donut-chart  w-10 h-10"></canvas>
                        <p>Contribution  <br>des blogs global</p>
                    </div>
                  
                    <div class="w-1/3">
                        <canvas height="200px" id="donutChart2" class="donut-chart  w-10 h-10"></canvas>
                        <p>Contribution  <br>des blogs publiés global</p>
                    </div>
                    <div class="w-1/3">
                        <canvas height="200px" id="donutChart3" class="donut-chart  w-10 h-10"></canvas>
                        <p>Contribution  <br>des blogs personnel</p>
                    </div>
                </div>
             
            </div>
        
            <a href="{{ route('utilisateur.index') }}" class="absolute -top-2 -left-10  "><i class="text-4xl bx bx-chevron-left"></i></a>
        </div>

  
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const label = document.querySelector('label[for="user-pdp"]');
        const inputFile = document.querySelector('input[type="file"]');
        const pdpImage = document.getElementById('pdp');

        label.addEventListener('click', function() {
            inputFile.click();
        });

        inputFile.addEventListener('change', function() {
            const selectedFile = this.files[0];
            if (selectedFile) {
                const reader = new FileReader();
                reader.onload = function() {
                    pdpImage.src = reader.result;
                }
                reader.readAsDataURL(selectedFile);
            }
        });
    });
</script>
            
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            const icon = this.querySelector('i');
            icon.classList.toggle('bx-low-vision');
            icon.classList.toggle('bx-show');
        });
    });
</script>

<script>
    const data1 = {
        datasets: [{
            data: [30, 40, 30],
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
        }]
    };

    const data2 = {
        datasets: [{
            data: [20, 50, 30],
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
        }]
    };

    const data3 = {
        datasets: [{
            data: [20, 50, 30],
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
        }]
    };

    // Options pour les graphiques
    const options = {
        maintainAspectRatio: true
    };

    // Créer les graphiques
    const ctx1 = document.getElementById('donutChart1').getContext('2d');
    new Chart(ctx1, {
        type: 'doughnut',
        data: data1,
        options: options
    });

    const ctx2 = document.getElementById('donutChart2').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: data2,
        options: options
    });

    const ctx3 = document.getElementById('donutChart3').getContext('2d');
    new Chart(ctx3, {
        type: 'doughnut',
        data: data3,
        options: options
    });
</script>

@endsection