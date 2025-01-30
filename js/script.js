



$(document).ready(function() {
    // Get the current URL path (relative to the domain)
    var currentPath = window.location.pathname;

    // Remove the base directory (/events) from the current path
    var currentPage = currentPath.replace(/^\/events\//, '');

    // Loop through each <a> tag in the menu
    $(".nav li a").each(function() {
        var menuItem = $(this).attr("href");

        // If the href matches the current page or contains the page name
        if (currentPage.includes(menuItem)) {
            $(".nav li a").removeClass("active");
            $(this).addClass("active");
        }
    });
});



$(document).ready(function() {
    $('#createEvent').on('click', function(event) {
        event.preventDefault();  // This prevents the default click action (navigation)
        // You can add additional logic here if needed
    });
});






//  Event Set select
$(document).ready(function() {
  // Dynamic seat configuration
  var totalSeats = 30;  // Change this to 60, 70, or any other value
  var numRows = Math.ceil(totalSeats / 10);  // Automatically calculate rows
  var seatsPerRow = 10; // Seats per row is fixed to 10 for better organization

  // Example of booked seats (cannot be selected)
  var bookedSeats = ["A3", "B2", "C6", "D3", "E3"];  
  var selectedSeat = "";  // Variable to store the selected seat value

  // Function to generate the seating chart dynamically
  function generateSeatingChart() {
    var seatingChart = $('#seatingChart');
    seatingChart.empty(); // Clear the chart before regenerating

    var seatCounter = 1;

    for (var row = 1; row <= numRows; row++) {
      var rowId = String.fromCharCode(64 + row); // Generate row label (A, B, C, etc.)
      var rowDiv = $('<div>').addClass('seat-row');

      for (var seat = 1; seat <= seatsPerRow; seat++) {
        if (seatCounter > totalSeats) break; // Stop if the seat count exceeds totalSeats

        var seatId = rowId + seatCounter;  // Generate seat ID (A1, A2, B1, B2, etc.)
        var seatDiv = $('<div>').addClass('col-2');

        var seatElement = $('<div>')
          .addClass('seat')
          .addClass(bookedSeats.includes(seatId) ? 'booked' : '') // If booked, mark as booked
          .attr('data-id', seatId)
          .text(seatId);

        // If seat is available, add click functionality
        if (!bookedSeats.includes(seatId)) {
          seatElement.click(function() {
            var seatId = $(this).attr('data-id');
            selectedSeat = seatId; // Store the selected seat value
            $('#inputField').val(seatId); // Insert the selected seat value into the input field
            $('#popupSelect').fadeOut(); // Hide the popup after selection
          });
        }

        seatDiv.append(seatElement);
        rowDiv.append(seatDiv);

        seatCounter++; // Increment seat counter
      }

      seatingChart.append(rowDiv);
    }
  }

  // Generate the seating chart on page load
  generateSeatingChart();

  // Show the seat selection popup when the input field is clicked
  $('#inputField').click(function() {
    var inputPos = $(this).offset();
    var inputWidth = $(this).outerWidth();
    $('#popupSelect')
      .css({
        top: inputPos.top + $(this).outerHeight() + 5, // Position just below the input
        left: inputPos.left,
        width: inputWidth
      })
      .fadeIn(); // Show the popup
  });

  // Hide the popup if clicking outside of the input or the popup
  $(document).click(function(event) {
    if (!$(event.target).closest('#inputField, #popupSelect').length) {
      $('#popupSelect').fadeOut();
    }
  });
});








//Tabs Box
  if($('.tabs-box').length){
    $('.tabs-box .tab-buttons .tab-btn').on('click', function(e) {
      e.preventDefault();
      var target = $($(this).attr('data-tab'));
      
      if ($(target).is(':visible')){
        return false;
      }else{
        target.parents('.tabs-box').find('.tab-buttons').find('.tab-btn').removeClass('active-btn');
        $(this).addClass('active-btn');
        target.parents('.tabs-box').find('.tabs-content').find('.tab').fadeOut(0);
        target.parents('.tabs-box').find('.tabs-content').find('.tab').removeClass('active-tab animated fadeIn');
        $(target).fadeIn(300);
        $(target).addClass('active-tab animated fadeIn');
      }
    });
  }

  //Accor