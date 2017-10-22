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