   // Calendario para campos de data
   $('.input-group.date').datepicker({
   	format: "dd/mm/yyyy",
   	weekStart: 1,
   	clearBtn: true,
   	language: "pt-BR",
   	daysOfWeekHighlighted: "0,6",
   	toggleActive: true
   });

	//Tamanho do campo ao entrar em foco / necessario propriedade data-action="grow" na tag
 $(document).on("focus", '[data-action="grow"]', function() {
  $(window).width() > 1e3 && $(this).animate({
   width: 700
 });

  $(document).on("blur", '[data-action="grow"]', function() {
   if ($(window).width() > 1e3) {
    $(this).animate({
     width: 500
   });
  }
});
});


 var messages = [];
 var messageType = {success:"bg-success", error:"bg-danger", warning:"bg-warning", information:"bg-info"};
 var notifyType = {success:"success", error:"danger", warning:"warning", information:"info"};

 function displayModal(message, type, displayName) {

   $('#' + displayName).remove();
   $('body').append("<div id='" + displayName + "' class='modal'>" 
    + "<div class='modal-dialog' style='' role='document'>"
    + "<div class='modal-content'>"
    + "<div class='modal-header text-white " + messageType[type] + "'>"
    + "<h5 class='modal-title'>" + displayName + "</h5>"
    + "<button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>"
    + "<span aria-hidden='true'>&times;</span>"
    + "</button>"
    + "</div>"
    + "<div id=message' class='modal-body'>"
    + "<p>" + message + "</p>"
    + " </div>"
    + "</div>"
    + "</div>"
    + "</div>");

   $('#' + displayName).modal('show');
 }


 function displayNotify(message, type){
  $.notify({
  // options
  message: message
},{
  // settings
  type: notifyType[type],
  z_index: 1052,
  placement: {
    from: "top",
    align: "center"
  }
});
}



function criarGrafico(elemento, tipo, data){
  var grafico = document.getElementById(elemento).getContext('2d');


  var itens = [];
  var valores = [];
  for(var i = 0; i < data.length; i++){
    console.log("item: " + data[i].Nome);
    console.log("valor: " + data[i].Valor);
    itens.push(data[i].Nome);
    valores.push(data[i].Valor);
  }

  var grafico = new Chart(grafico, {
    type: tipo,
    data: {
      labels: itens,
      datasets: [{
        label: 'Valor das despesas',
        data: valores,
        backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)'
        ],
        borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero:true,
            autoSkip: false
          }
        }]
      }
    }
  });
}

function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("despesas");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc"; 
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++; 
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

function searchInTable() {
  // Declare variables 
  var input, filter, table, tr, td, i, tipoFiltro;
  input = document.getElementById("searchbar");
  filter = input.value.toUpperCase();
  table = document.getElementById("despesas");
  tr = table.getElementsByTagName("tr");
  tipoFiltro = document.getElementById("DespesaFiltro").options[document.getElementById("DespesaFiltro").selectedIndex].value;

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[tipoFiltro];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}