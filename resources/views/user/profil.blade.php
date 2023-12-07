@extends('layouts.app')

@section('content')
<section class=" block max-w-6xl w-full mx-auto ">
    <div class="relative usersection">
        <h3 class="bounceslideInFromLeft text-2xl pl-2 mb-5 font-semibold">        <a href="{{ route('utilisateur.index') }}"  >
            <i class="text-4xl bx bx-chevron-left"></i></a> Utilisateurs / <small>Profil / @<b>{{ $user->name }}</b></small></h3>

            <div class="mx-auto block md:flex max-w-5xl gap-2">

                <div class="bounceslideInFromLeft w-full md:w-1/2 p-5 crud-card">
                    <h4 class="font-semibold">Information Personnel de l'utilisateur</h4>
                    <div class="my-5 flex justify-center items-center">
                        <div class="relative h-20 w-20">
                            <img src="{{ asset('images/pdp/'.$user->pdp )}}"alt="{{ $user->name }} pdp"" alt="" id="pdp" class=" h-full w-full object-cover rounded-full bg-gray-400 border border-gray-600 rounded-full nopdpimg overflow-hidden">
                        </div>
                    </div>
                    <div class="mb-5 flex justify-start items-center">
                        <div class="w-1/12"><i class="">@</i></div>
                        <span> {{ $user->name }}</span>
                    </div>
                    <div class="mb-5 flex justify-start items-center">
                        <div class="w-1/12"><i class="bx bx-envelope"></i></div>
                        <span> {{ $user->email }}</span>
                    </div>

                    <div class="mb-5 flex justify-start items-center">
                        <div class="w-1/12"><i class="bx bx-badge"></i></div>
                        <span>{{ $user->role_user }}</span>
                    </div>

                    <div class="mb-5 flex justify-start items-center">
                        <div class="w-1/12"><i class="bx bx-phone"></i></div>
                        <span>{{ $user->tel_user }}</span>
                    </div>
                </div>


                <div class="bounceslideInFromRight grayscale w-full mt-5 md:mt-0 md:w-1/2 p-5 crud-card">
                    <h4 class="mb-5 font-semibold">Privilege</h4>
                    <div class="mb-5 flex justify-center items-center">
                        <h5 class="w-10/12">Super utilisateur</h5>
                        <div class="w-2/12">
                            <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                <input disabled class="form-checkbox" type="checkbox" id="super-user" name="super-user" {{ $user->prvlg_super_user == 1 ? 'checked' : '' }}>
                                <label class="ml-2" for="super-user"></label>
                            </div>
                        </div>

                    </div>
                    <div class="mb-5 flex justify-center items-center">
                        <h5 class="w-10/12">Gestion des taches</h5>
                        <div class="w-2/12">
                            <div class="flex justify-center items-center prvlg-switcher">
                                <input disabled class="form-checkbox" type="checkbox" id="tache" name="tache" {{ $user->prvlg_task == 1 ? 'checked' : '' }}>
                                <label class="ml-2" for="tache"></label>
                            </div>
                        </div>
                    </div>
                    <h5 class="w-10/12">Gestion des utilisateurs</h5>
                    <div class="mb-5 block sm:flex justify-end sm:justify-center  items-center">
                        <div class="w-1/2  mt-5 block sm:flex justify-end sm:justify-center  items-center">
                            <div>Creation</div>
                            <div class="">
                                <div class="flex justify-center items-center prvlg-switcher">
                                    <input disabled class="form-checkbox" type="checkbox" id="create-user" name="create-user" {{ $user->prvlg_create_user == 1 ? 'checked' : '' }}>
                                    <label class="ml-2" for="create-user"></label>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2 mt-5 block sm:flex justify-end sm:justify-center  items-center">
                            <div>Modification</div>
                            <div class="">
                                <div class="flex justify-center items-center prvlg-switcher">
                                    <input disabled class="form-checkbox" type="checkbox" id="updat-user" name="updat-user" {{ $user->prvlg_update_user == 1 ? 'checked' : '' }}>
                                    <label class="ml-2" for="updat-user"></label>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2 mt-5 block sm:flex justify-end sm:justify-center  items-center">
                            <div>Suppression</div>
                            <div class="">
                                <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                    <input disabled class="form-checkbox" type="checkbox" id="del-user" name="del-user" {{ $user->prvlg_delete_user == 1 ? 'checked' : '' }} >
                                    <label class="ml-2" for="del-user"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5 flex justify-center items-center">
                        <h5 class="w-10/12">Gestion des membres</h5>
                        <div class="w-2/12">
                            <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                <input disabled class="form-checkbox" type="checkbox" id="membre" name="membre" {{ $user->prvlg_membre == 1 ? 'checked' : '' }}>
                                <label class="ml-2" for="membre"></label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5 flex justify-center items-center">
                        <h5 class="w-10/12">Gestion des project</h5>
                        <div class="w-2/12">
                            <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                <input disabled class="form-checkbox" type="checkbox" id="project" name="project" {{ $user->prvlg_project == 1 ? 'checked' : '' }} >
                                <label class="ml-2" for="project"></label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5 flex justify-center items-center">
                        <h5 class="w-10/12">Gestion des partenaires</h5>
                        <div class="w-2/12">
                            <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                <input disabled class="form-checkbox" type="checkbox" id="partenaire" name="partenaire" {{ $user->prvlg_partenaire == 1 ? 'checked' : '' }}>
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
                                    <input disabled class="form-checkbox" type="checkbox" id="create-blog" name="create-blog" {{ $user->prvlg_create_blog == 1 ? 'checked' : '' }}>
                                    <label class="ml-2" for="create-blog"></label>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2 mt-5  grid items-center">
                            <div>Modification</div>
                            <div class="">
                                <div class="flex justify-center items-center prvlg-switcher">
                                    <input disabled class="form-checkbox" type="checkbox" id="updat-blog" name="updat-blog" {{ $user->prvlg_update_blog == 1 ? 'checked' : '' }}>
                                    <label class="ml-2" for="updat-blog"></label>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2 mt-5  grid items-center">
                            <div>Suppression</div>
                            <div class="">
                                <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                    <input disabled class="form-checkbox" type="checkbox" id="del-blog" name="del-blog" {{ $user->prvlg_delete_blog == 1 ? 'checked' : '' }}>
                                    <label class="ml-2" for="del-blog"></label>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2 mt-5  grid items-center">
                            <div>Approbation</div>
                            <div class="">
                                <div class="flex justify-center items-center mb-2 prvlg-switcher">
                                    <input disabled class="form-checkbox" type="checkbox" id="approb-blog" name="approb-blog" {{ $user->prvlg_approv_blog == 1 ? 'checked' : '' }}>
                                    <label class="ml-2" for="approb-blog"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>


            </div>
            <div class="bounceslideInFromBottom max-w-5xl mx-auto my-5 p-5 crud-card">
                <h4 class="mb-5 font-semibold">Contribution</h4>
                <div class="max-w-5xl block sm:flex mx-auto justify-center items-center">
                    <div class="w-full mx-auto mb-5 sm:mb-0 sm:w-1/3">
                        <canvas id="donutChart1" class="donut-chart  w-5 h-5"></canvas>
                        <p>Contribution  <br>des blogs global</p>
                    </div>

                    <div class="w-full mx-auto mb-5 sm:mb-0 sm:w-1/3">
                        <canvas height="150px" id="donutChart2" class="donut-chart  w-5 h-5"></canvas>
                        <p>Contribution  <br>des blogs publiés global</p>
                    </div>
                    <div class="w-full mx-auto mb-5 sm:mb-0 sm:w-1/3">
                        <canvas height="150px" id="donutChart3" class="donut-chart  w-5 h-5"></canvas>
                        <p>Contribution  <br>des blogs personnel</p>
                    </div>
                </div>

            </div>

           </div>


</section>




<script>
    const data1 = {
        datasets: [{
            data: [{{ $personalBlog }},{{ $otherBlog }}],
            backgroundColor: ['#FF6384', 'gray']
        }]
    };

    const data2 = {
        datasets: [{
            data: [{{ $personalPublishBlog }}, {{ $otherPublishBlog }}],
            backgroundColor: ['#FF6384', 'gray']
        }]
    };

    const data3 = {
        datasets: [{
            data: [{{ $personalPublishBlog }}, {{ $personalNotPublishBlog }}],
            backgroundColor: ['#FF6384', 'gray']
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
