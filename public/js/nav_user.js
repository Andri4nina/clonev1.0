document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.nav_link');

    navLinks.forEach(link => {
      link.addEventListener('click', function(event) {
   
        navLinks.forEach(navLink => {
          navLink.classList.remove('active');
        });

        link.classList.add('active');
      });
    });
  });