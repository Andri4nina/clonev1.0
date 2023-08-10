/**theme  */
const themeToggle = document.querySelector(".style-switcher-toggler");
const themeswitcher = document.querySelector(".style-switcher");
themeToggle.addEventListener("click",() =>{
    themeswitcher.classList.toggle("open");
})

/* theme choice */
const alternateStyles = document.querySelectorAll(".alternate-style");
const body = document.querySelector("body");
function setActiveStyle(color)
{
    alternateStyles.forEach((style) => {

        {
            body.classList.remove('bleu');
            body.classList.remove('rouge');
            body.classList.remove('jaune');
            body.classList.remove('vert');
            body.classList.remove('rose'); 
        }

        body.classList.add(color)
       
        })
    }





/** mode sombre  */
const dayNight = document.querySelector(".day-night");
dayNight.addEventListener("click",() =>{
    dayNight.querySelector("i").classList.toggle("fa-sun-o");
    dayNight.querySelector("i").classList.toggle("fa-moon-o");
    document.body.classList.toggle("dark");
})
window.addEventListener("load", () =>{
    if(document.body.classList.contains("darks"))
    {
        dayNight.querySelector("i").classList.add("fa-sun-o")
         dayNight.querySelector("i").classList.remove("fa-moon-o")
    }
    else
    {
     dayNight.querySelector("i").classList.remove("fa-sun-o")
        dayNight.querySelector("i").classList.add("fa-moon-o")
        
    }
})