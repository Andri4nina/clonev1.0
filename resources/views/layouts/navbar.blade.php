<nav class=" w-full h-10 fixed top-0 left-0">
    <div class="absolute top-5 left-5 menufritepos  cursor-pointer " onclick="showhidemenu() ">
        <div class="menuFrite " ">

        </div>
    </div>

  <div class="flex gap-10 justify-center items-center mt-5 mr-5 float-right usercontent">

      <div class=" flex gap-2 justify-center items-center text-sm font-bold ">
        <div>
          {{\Illuminate\Support\Facades\Auth::user()->name }}
        </div>
        <div>
          <div class="bg-green-600 w-3 h-3 rounded-full userstatus"></div>
        </div>

      </div>

      <div class="nopdpimg w-10 h-10 rounded-full overflow-hidden">
        <img src="{{ asset('images/pdp/' . Illuminate\Support\Facades\Auth::user()->pdp) }}" alt="" class="w-full h-full object-cover">
      </div>
  </div>
</nav>

<aside class="fixed top-0 left-0  min-h-screen ">
  <div class="fixed top-0 left-0 p-6 flex justify-center items-center gap-2">
    <div class="w-10 h-10 nopdpimg">
      <img src="" alt="logo" class="w-full h-full">
    </div>
    <div>
      <h3 class="text-base font-extrabold text-center ">Hope for a future <br>
        <small>-Madagascar-</small>
        </h3>
    </div>
  </div>

  <div class="mt-36 h-full">
      <div class="overflow-hidden h-5/6">
          <ul class="overflow-y-scroll scrollbar-hidden-y h-screen pb-48">
            <li class="px-5 menu-item active">
              <a href="{{ route('dashboard.index') }}" class="flex gap-3 items-center px-2 py-5 text-sm menu-link">
                <i class="text-2xl menu-icon tf-icons bx bxs-home-circle"></i>
                <div class="text-sm">Tableau de bords</div>
              </a>
            </li>
            <li class="px-5 menu-item">
              <a href="{{ route('blog.index') }}" class="flex gap-3 items-center px-2 py-5 text-sm menu-link">
                <i class="text-2xl menu-icon tf-icons fas fa-feather-alt"></i>
                <div class="text-sm">Gestion de blog</div>
              </a>
            </li>

            <li class="px-5 menu-item">
              <a href="{{ route('partenaire.index') }}" class="flex gap-3 items-center px-2 py-5 text-sm menu-link">
                <i class="text-2xl menu-icon tf-icons fa fa-handshake"></i>
                <div class="text-sm">Gestion de partenaires</div>
              </a>
            </li>
            <li class="px-5 menu-item">
              <a href="{{ route('project.index') }}" class="flex gap-3 items-center px-2 py-5 text-sm menu-link">
                <i class="text-2xl menu-icon tf-icons fas fa-cogs "></i>
                <div class="text-sm">Gestion de project</div>
              </a>
            </li>

            <li class="px-5 menu-item">
              <a href="{{ route('membre.index') }}" class="flex gap-3 items-center px-2 py-5 text-sm menu-link">
                <i class="text-2xl menu-icon tf-icons bx bx-group "></i>
                <div class="text-sm">Gestion de membres</div>
              </a>
            </li>

            <br>
            <hr>
            <br>
            <li class="px-5 menu-item">
              <a href="{{ route('utilisateur.index') }}" class="flex gap-3 items-center px-2 py-5 text-sm menu-link">
                <i class="text-2xl menu-icon tf-icons bx bx-user-circle "></i>
                <div class="text-sm">Utilisateurs</div>
              </a>
            </li>
            <li class="px-5 menu-item">
              <a href="{{ route('tache.index') }}" class="flex gap-3 items-center px-2 py-5 text-sm menu-link">
                <i class="text-2xl menu-icon tf-icons bx bx-task"></i>
                <div class="text-sm">Taches</div>
              </a>
            </li>
            <li class="px-5 menu-item">
              <a href="{{ route('message.index') }}" class="relative flex gap-3 items-center px-2 py-5 text-sm menu-link">
                <i class="text-2xl menu-icon tf-icons bx bx-message-add"></i>
                <div class="text-sm">Message</div>
                <span class="text-white text-xs absolute right-2 bg-red-600 h-5 w-5 text-center rounded-full">25</span>
              </a>
            </li>
            <li class="px-5 menu-item">
              <a href="{{ route('historique.index')}}" class="flex gap-3 items-center px-2 py-5 text-sm menu-link">
                <i class="text-2xl menu-icon tf-icons bx bx-history"></i>
                <div class="text-sm">Historique</div>
              </a>
            </li>
            <li class="px-5 menu-item">
              <a href="{{ route('galerie.index')}}" class="flex gap-3 items-center px-2 py-5 text-sm menu-link">
                <i class="text-2xl menu-icon tf-icons bx bxs-image"></i>
                <div class="text-sm">Galerie</div>
              </a>
            </li>
            <li class="px-5 menu-item">
              <a href="{{ route('archive.index') }}" class="relative flex gap-3 items-center px-2 py-5 text-sm menu-link">
                <i class="text-2xl menu-icon tf-icons bx bxs-box"></i>
                <div class="text-sm">Archive</div>
              </a>
            </li>

            <br>
            <hr>
            <br>
            <li class="px-5 ">
              <span class="cursor-pointer mode flex gap-3 items-center px-2 py-5 text-sm menu-link">
                <i class="text-blue-600 text-2xl menu-icon tf-icons bx bx-moon"></i>
                <div class="text-sm">Mode</div>
              </span>
            </li>


            <li class="relative px-5 ">
              <span onclick="changeTheme()" class="cursor-pointer flex gap-3 items-center px-2 py-5 text-sm menu-link">
                <i class="text-2xl menu-icon tf-icons bx bx-palette"></i>
                <div class="text-sm">Theme</div>
              </span>
              <div class="pallete">
                  <div class=" grid grid-cols-3 gap-2 pallete-container">
                      <div class="colors" id="bleu"></div>
                      <div class="colors" id="rouge"></div>
                      <div class="colors" id="vert"></div>
                      <div class="colors" id="jaune"></div>
                      <div class="colors" id="rose"></div>
                  </div>
              </div>
            </li>
            <li class="px-5 menu-item">
              <a href="{{ route('parametre.index') }}" class="flex gap-3 items-center px-2 py-5 text-sm menu-link">
                <i class="text-2xl menu-icon tf-icons bx bx-cog"></i>
                <div class="text-sm">Parametre</div>
              </a>
            </li>


            <br>
            <hr>
            <br>
            <li class="px-5 menu-item">
              @auth
                <form action="{{ route('auth.logout') }}" method="POST">
                  @method('delete')
                  @csrf
                  <button href="#deconnection" id="logoutButton" class="flex gap-3 items-center px-2 py-5 text-sm menu-link">
                    <i class="text-2xl menu-icon tf-icons bx bx-log-out"></i>
                    <div class="text-sm">Deconnexion</div>
                  </button>
                </form>
              @endauth
            </li>
          </ul>
      </div>

  </div>

<script>
  const palette = document.querySelector(".pallete");

  function changeTheme() {
    palette.classList.toggle('active');
  }
</script>
<script>
  const mode = document.querySelector('.mode');
  const modeIcon = document.querySelector('.mode i');
  mode.addEventListener('click', () => {

    document.body.classList.toggle('dark');

    if (document.body.classList.contains('dark')) {
      modeIcon.classList.add('bx-moon');
      modeIcon.classList.remove('bx-sun');
      modeIcon.classList.add('text-blue-600');
      modeIcon.classList.remove('text-yellow-400');
      localStorage.setItem('mode_user', 'dark');
    } else {
      localStorage.setItem('mode_user', 'light');
      modeIcon.classList.add('bx-sun');
      modeIcon.classList.remove('bx-moon');
      modeIcon.classList.remove('text-blue-600');
      modeIcon.classList.add('text-yellow-400');
    }
  });
</script>


<script>
const colors = document.querySelectorAll('.pallete .colors');

colors.forEach(color => {
  color.addEventListener('click', () => {

    const colorID = color.id;


    document.body.classList.remove('bleu', 'rouge', 'vert', 'jaune', 'rose');
    document.body.classList.add(colorID);
  });
});

</script>

 <script>
          // Récupérer les valeurs mode_user et theme_user
          const modeUser = "{{ \Illuminate\Support\Facades\Auth::user()->mode_user }}";
          const themeUser = "{{ \Illuminate\Support\Facades\Auth::user()->theme_user }}";

          // Stocker les valeurs dans le localStorage
          localStorage.setItem('mode_user', modeUser);
          localStorage.setItem('theme_user', themeUser);
      </script>
      <script>

        window.addEventListener('DOMContentLoaded', () => {
          const mode = document.querySelector('.mode');
          const modeIcon = document.querySelector('.mode i');


          const storedMode = localStorage.getItem('mode_user');
          const storedTheme = localStorage.getItem('theme_user');


          document.body.classList.add(storedTheme);

          if (storedMode === 'dark') {
            document.body.classList.add('dark');
            modeIcon.classList.add('bx-moon');
            modeIcon.classList.remove('bx-sun');
            modeIcon.classList.add('text-blue-600');
            modeIcon.classList.remove('text-yellow-400');
          } else {
            modeIcon.classList.add('bx-sun');
            modeIcon.classList.remove('bx-moon');
            modeIcon.classList.remove('text-blue-600');
            modeIcon.classList.add('text-yellow-400');
          }


        });
      </script>

<script>
    const aside = document.querySelector('aside');
    const menuFrite = document.querySelector('.menuFrite');
    const menuPosition = document.querySelector('.menufritepos');


    function showhidemenu(){
        aside.classList.toggle('active');
        menuFrite.classList.toggle('active');
        menuPosition.classList.toggle('active');
    }
</script>
</aside>



