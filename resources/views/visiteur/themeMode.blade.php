<!--style switch start-->

<div class="style-switcher">
    <div class="style-switcher-toggler s-icon">
        <i class="fa fa-cog fa-spin" ></i>
    </div>
    <div class="day-night s-icon">
        <i class="fa fa-moon "></i>
    </div>
    <h4>Theme Colors</h4>
    <div class="colors">
        <span class="alternate-style cursor-pointer bleu" onclick="setActiveStyle('bleu')"></span>
        <span class="alternate-style cursor-pointer rouge" onclick="setActiveStyle('rouge')"></span>
        <span class="alternate-style cursor-pointer vert" onclick="setActiveStyle('vert')"></span>
        <span class="alternate-style cursor-pointer rose" onclick="setActiveStyle('rose')"></span>
        <span class="alternate-style cursor-pointer jaune" onclick="setActiveStyle('jaune')"></span>
        
    </div>
</div>


<!--style switch start-->
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js') }}"></script>
<script src="{{ asset('js/scriptswitcher.js') }} "></script>  