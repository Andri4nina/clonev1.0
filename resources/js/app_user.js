
//fonction de recherche 
const search = document.querySelector('.searchstyle input');

// Sélection de toutes les lignes de tableau
const table_rows = document.querySelectorAll('.user_list tbody tr');

search.addEventListener('input', searchTable);
function searchTable() {
  let countrow=0
  let restrow =0
  table_rows.forEach((row, i) => {
    let table_data = row.textContent.toLowerCase();
    let search_data = search.value.toLowerCase();
    restrow = i + 1
    // Masquer les lignes qui ne correspondent pas à la recherche
    row.classList.toggle('hide', table_data.indexOf(search_data) < 0);
    row.style.setProperty('--delay', i / 25 + 's');
    if(table_data.indexOf(search_data) < 0){
      countrow+=1
    }

  });

    //S'il n'y a pas de ligne affichable 
    if(restrow-countrow == 0){
      document.querySelector("#no_match").classList.remove("hidden")
    }else{
      document.querySelector("#no_match").classList.add("hidden")
    }


  // Appliquer un style de couleur alterné aux lignes visibles
    document.querySelectorAll('tbody tr:not(.hide)').forEach((visible_row, i) => {
    visible_row.style.backgroundColor = i % 2 == 0 ? 'transparent' : '#0000000b';
  });

}

//privilege 
//les variables
const global_Switch = document.querySelector('.all_checked input');
const global_Checked = document.querySelectorAll('.privi_switch input[type="checkbox"]'); 

const sup_Switch = document.querySelector('.sup_checked_all input');
const sup_Checked = document.querySelectorAll('.sup_checked input[type="checkbox"]');

const admin_Switch = document.querySelector('.admin_checked_all input');
const admin_Checked = document.querySelectorAll('.admin_checked input[type="checkbox"]');

const donne_Switch = document.querySelector('.donne_checked_all input');
const donne_Checked = document.querySelectorAll('.donne_checked input[type="checkbox"]');




  //les privilege annexes
  function Switch_check(all_switch, all_checked) {
    all_switch.addEventListener('change', function () {
      const isChecked = all_switch.checked;
      all_checked.forEach(checkbox => {
        checkbox.checked = isChecked;
      });
    });
  
    all_checked.forEach(checkbox => {
      checkbox.addEventListener('change', function () {
        const allChecked = [...all_checked].every(checkbox => checkbox.checked);
        all_switch.checked = allChecked;
      });
    });
  }
  
  Switch_check(sup_Switch, sup_Checked);
  Switch_check(admin_Switch, admin_Checked);
  Switch_check(donne_Switch, donne_Checked);
  
