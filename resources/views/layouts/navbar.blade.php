<aside class="block fixed top-0 bottom-0 w-full overflow-y-auto p-0  shadow-none left-0 z-50 transition-all ease-in-out ml-4 mx-4 aside" id="aside_menu">
  {{--  header navbar  --}}
  <div class="sticky top-0 left-0 block px-6 pt-8  z-50 whitespace-nowrap sidebar_header ">
    <a class="flex navbar-brand m-0" href="" target="_blank">
      <img src="{{asset( 'images/Logo-MEH.png') }}" class="navbar-brand h-16" alt="main_logo">
      <span class="ml-3 font-semibold">MEH <br> <small>Ministere de l'energie et de <br> l'Hydrocarbure</small></span>
    </a>
    <hr>
  </div>


  {{--  body scrollable  --}}
  <div class="block overflow-hidden w-auto -translate-y-6  sidenav_body ">
    <ul class="flex-column ">
        <li class="w-full nav_item">
            <a href="{{  route('dashboard.index') }}" class="flex items-center whitespace-nowrap py-2 mx-0 my-4 text-sm nav_link ">
              <div class="relative rounded-lg w-8 h-8 icon_shape">
                <i class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-center items-center fa fa-th-large" aria-hidden="true"></i>
              </div>
              <span class="pl-3">
                    Tableau de bord
              </span>
            </a>
        </li>

        <li class="w-full nav_item">
          <a href="{{  route('publication.index') }}" class="flex items-center whitespace-nowrap py-2 mx-0 my-4 text-sm nav_link ">
            <div class="relative rounded-lg w-8 h-8 icon_shape">
              <i class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-center items-center fa fa-blog" aria-hidden="true"></i>   
            </div>
            <span class="pl-3">
                Gestion des blogs
            </span>
          </a>
        </li>

        <li class="w-full nav_item">
          <a href="{{  route('utilisateur.index') }}" class="flex items-center whitespace-nowrap py-2 mx-0 my-4 text-sm nav_link ">
            <div class="relative rounded-lg w-8 h-8 icon_shape">
              <i class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-center items-center fa fa-users" aria-hidden="true"></i>
            </div>
            <span class="pl-3 ">
                Gestion des utilisateurs
            </span>
          </a>
        </li>



        <li class="w-full nav_item">
          <a href="{{ route('partenaire.index') }}" class="flex items-center whitespace-nowrap py-2 mx-0 my-4 text-sm nav_link ">
            <div class="relative rounded-lg w-8 h-8 icon_shape">
              <i class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-center items-center fa fa-users-rectangle aria-hidden="true"></i>
            </div>
            <span class="pl-3">
                Gestion des partenaires
            </span>
          </a>
        </li>

        <hr>

        <li class="w-full nav_item">
          <form action=" {{ route('utilisateur.mode') }} " method="post">
            @csrf 
            <button class="border-none -translate-x-4 flex items-center whitespace-nowrap py-2 mx-0 my-4 text-sm " type="submit">
              <div class="relative rounded-lg w-8 h-8 icon_shape">
                <input type="hidden" name="hidden_mode" value='{{\Illuminate\Support\Facades\Auth::user()->mode_user }}'>
                <input type="hidden" name="hidden_id" value='{{\Illuminate\Support\Facades\Auth::user()->id }}'>
                <i class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-center items-center fa fa-sun" aria-hidden="true"></i>
              </div>
              <span class="pl-3">
                  Mode
              </span>
            </button>
          </form>
          
        </li>


        <li class="w-full nav_item relative">
            <button class="border-none -translate-x-4 flex items-center whitespace-nowrap py-2 mx-0 my-4 text-sm " onclick="show_style()">
              <div class="relative rounded-lg w-8 h-8 icon_shape">
                <i class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-center items-center fa fa-palette" aria-hidden="true"></i>
              </div>
              <span class="pl-3">
                  Theme
              </span>
            </button>


            <div class="show_style" id='show_style'>
              <form action="{{ route('utilisateur.theme') }}" method='post'>
                @csrf
                <div class="theme_style">
                 <input type="hidden" name="hidden_id" value='{{\Illuminate\Support\Facades\Auth::user()->id }}'>
               
                  <button id="btn_bleu" type="submit" name="hidden_theme" value='bleu'>
                  </button>
                  <button id="btn_rouge" type="submit"  name="hidden_theme" value='rouge'>
                  </button>
                  <button id="btn_vert" type="submit" name="hidden_theme" value='vert'>
                  </button>
                  <button id="btn_rose" type="submit" name="hidden_theme" value='rose'>
                  </button>
                  <button id="btn_jaune" type="submit"  name="hidden_theme" value='jaune'>
                  </button>
                </div>
              </form>
            </div>
        </li>

        <hr>


        <li class="w-full nav_item">
            <a href="#tableaudebord" class="flex items-center whitespace-nowrap py-2 mx-0 my-4 text-sm nav_link ">
              <div class="relative rounded-lg w-8 h-8 icon_shape">
                <i class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-center items-center fa fa-cog " aria-hidden="true"></i>
              </div>
              <span class="pl-3">
                  Parametre
              </span>
            </a>
        </li>


        <li class="w-full nav_item">
            @auth
            <form action="{{ route('auth.logout') }}" method="post">
            @method('delete')
            @csrf
            <button id="logoutButton" class="border-none flex items-center whitespace-nowrap py-2 -translate-x-4 mx-0 my-4 text-sm  ">
              <div class="relative rounded-lg w-8 h-8 icon_shape">
                <i class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-center items-center fa fa-sign-out" aria-hidden="true"></i>
          
              </div>
              <span class="pl-3">
                  Se Deconnecter
              </span>
            </button>
          </form>
          @endauth

        </li>


    </ul>
  </div>

</aside> 


<nav class="show_to_Top sticky top-0 w-full">
  <div class="flex justify-end mr-5">
    <p class="text-right font-extrabold text-lg pr-4">
      {{\Illuminate\Support\Facades\Auth::user()->name }} <br> <small class="font-normal">  {{\Illuminate\Support\Facades\Auth::user()->role_user }}</small>
   </p>
     <button class="border-none -translate-y-3 menu_resp w-5 p-0" id="menu_resp" onclick="active_menu()">
        <div class="relative burger_line" id="burger_Menu"></div>
     </button>
  </div>
  <script>
    
    var aside_menu=document.getElementById('aside_menu')
    var burger_Menu=document.getElementById('burger_Menu')
    function active_menu(){
      burger_Menu.classList.toggle('active');
      aside_menu.classList.toggle('show_menu');
    }
  </script>


  <script>
    function show_style(){
      document.getElementById('show_style').classList.toggle('active')
    }
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const navLinks = document.querySelectorAll('.nav_link');
      const storageKey = 'activeLink';
  
      if (localStorage.getItem(storageKey) === null) {
        localStorage.setItem(storageKey, '0');
      }
  
      const lastActiveIndex = parseInt(localStorage.getItem(storageKey));
      if (!isNaN(lastActiveIndex) && lastActiveIndex >= 0 && lastActiveIndex < navLinks.length) {
        navLinks[lastActiveIndex].classList.add('active');
      }
  
      navLinks.forEach((link, index) => {
        link.addEventListener('click', function() {
          navLinks.forEach(link => link.classList.remove('active'));
          this.classList.add('active');
          localStorage.setItem(storageKey, index.toString());
        });
      });
  
      const logoutButton = document.getElementById('logoutButton');
      if (logoutButton) {
        logoutButton.addEventListener('click', function() {
          localStorage.clear();
          form.submit();
        });
      }
  

  
    });
  </script>
  
  
  
  
  
  
</nav>
