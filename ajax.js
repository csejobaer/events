// admin Login ajax
$(document).ready(function() {
    $("#loginForm").submit(function(e) {
        e.preventDefault(); // Prevent default form submission

        // Clear previous error messages
        $('#emailError').text('');
        $('#passwordError').text('');

        // Get the form data
        var email = $('#email').val();
        var password = $('#password').val();
        var terms = $('#terms').prop('checked');

        // Validate password using regex
        var passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        var passwordValid = passwordPattern.test(password);

        if (!passwordValid) {
            $('#passwordError').text("Password must be at least 8 characters long, with 1 uppercase letter, 1 number, and 1 special character.");
            return;
        }

        // Check if terms checkbox is checked
        if (!terms) {
            alert("You must agree to the terms and conditions.");
            return;
        }

        // Send data to the server using Ajax
        $.ajax({
            url: 'loginAjax.php', // The PHP file to process the login
            type: 'POST',
            data: {
                email: email,
                password: password
            },
            success: function(response) {
                if (response === 'success') {
                    window.location.href = 'dashboard.php'; // Redirect to dashboard on successful login
                } else {
                    // Show error message in the emailError span
                    $('#emailError').text(response); // Show the error message from PHP response
                }
            }
        });
    });
});



// // User Login ajax
// $(document).ready(function(){

//     $("#user_login").submit(function(e){
//         e.preventDefault();
//         $('#user_loginErrorEmail').text('');
//         $('#user_loginErrorPassword').text('');

//         // Data selector
//         var uemail = $("#uemail").val();
//         var upassword = $('#upassword').val();

//         // Password validation pattern
//         // Validate password using regex
//         var passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
//         var passwordValid = passwordPattern.test(password);

//         if (!passwordValid) {
//             $('#passwordError').text("Password must be at least 8 characters long, with 1 uppercase letter, 1 number, and 1 special character.");
//             return;
//         }

//         // Email validation (basic pattern)
//         var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
//         var emailValid = emailPattern.test(uemail);

//         // Check if email is valid
//         if (!emailValid) {
//             $('#user_loginErrorEmail').text("Please enter a valid email address.");
//             return;
//         }

//         // Check if terms checkbox is checked
//         var terms = $('#terms').prop('checked');
//         if (!terms) {
//             alert("You must agree to the terms and conditions.");
//             return;
//         }

  
//      $.ajax({
//                 url: 'user_login.php', // The PHP file to process the login
//                 type: 'POST',
//                 data: {eamil: uemail, password: upassword}, 
//                 success: function(response) {
//                     if (response === 'success') {
//                         window.location.href = 'dashboard.php'; // Redirect to dashboard on successful login
//                     } else {
//                         // Show error message in the emailError span
//                         $('#user_loginErrorEmail').text(response); // Show the error message from PHP response
//                     }
//                 }
//             });
//     });

// });

// User Login Ajax
// User Login Ajax
$(document).ready(function() {
    $("#user_login").submit(function(e) {
        e.preventDefault();
        $('#user_loginErrorEmail').text('');
        $('#user_loginErrorPassword').text('');

        // Data selector
        var uemail = $("#uemail").val();
        var upassword = $('#upassword').val();

        // Password validation pattern
        var passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        var passwordValid = passwordPattern.test(upassword); // use the correct variable name

        if (!passwordValid) {
            $('#user_loginErrorPassword').text("Password must be at least 8 characters long, with 1 uppercase letter, 1 number, and 1 special character.");
            return;
        }

        // Email validation (basic pattern)
        var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        var emailValid = emailPattern.test(uemail);

        if (!emailValid) {
            $('#user_loginErrorEmail').text("Please enter a valid email address.");
            return;
        }

        // Check if terms checkbox is checked
        var terms = $('#terms').prop('checked');
        if (!terms) {
            alert("You must agree to the terms and conditions.");
            return;
        }

        // AJAX request
        $.ajax({
            url: 'user_login.php',
            type: 'POST',
            data: { email: uemail, password: upassword },
            success: function(response) {
                if (response === 'success') {
                    window.location.href = 'dashboard.php'; // Redirect to dashboard on successful login
                } else {
                    $('#user_loginErrorEmail').text(response); // Show the error message from PHP response
                }
            }
        });
    });
});
// User Login Ajax
// User Login Ajax
$(document).ready(function() {
    $("#user_login").submit(function(e) {
        e.preventDefault();
        $('#user_loginErrorEmail').text('');
        $('#user_loginErrorPassword').text('');

        // Data selector
        var uemail = $("#uemail").val();
        var upassword = $('#upassword').val();

        // Password validation pattern: Ensure at least 8 characters
        var passwordPattern = /^.{8,}$/; // At least 8 characters long
        var passwordValid = passwordPattern.test(upassword);

        if (!passwordValid) {
            $('#user_loginErrorPassword').text("Password must be at least 8 characters long.");
            return;
        }

        // Email validation (basic pattern)
        var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        var emailValid = emailPattern.test(uemail);

        if (!emailValid) {
            $('#user_loginErrorEmail').text("Please enter a valid email address.");
            return;
        }

        // Check if terms checkbox is checked
        // var terms = $('#terms').prop('checked');
        // if (!terms) {
        //     alert("You must agree to the terms and conditions.");
        //     return;
        // }

        // AJAX request
        $.ajax({
            url: 'user_login.php',
            type: 'POST',
            data: { email: uemail, password: upassword },
            success: function(response) {
                if (response === 'success') {
                    window.location.href = 'dashboard.php'; // Redirect to dashboard on successful login
                } else {
                    $('#user_loginErrorEmail').text(response); // Show the error message from PHP response
                }
            }
        });
    });
});









$(document).ready(function() {
    $('#eventRegister').on('submit', function(e) {
        e.preventDefault();  // Prevent form submission

        var title = $("#title").val().trim();
        var seats_no = $("#seats_no").val().trim();
        var price = $("#price").val().trim();
        var date = $("#date").val().trim();
        var stime = $("#stime").val().trim();
        var etime = $("#etime").val().trim();
        var location = $("#location").val().trim();
        var des = $("#des").val().trim();
        var image = $("#image")[0].files[0];  // For file upload, handle it properly

        // Validation checks
        if (!title || !date || !stime || !etime || !location || !des) {
            alert("Please fill out all required fields.");
            return;
        }

        // Validate the time format (basic example)
        if (new Date("1970-01-01T" + stime) > new Date("1970-01-01T" + etime)) {
            alert("End time cannot be earlier than start time.");
            return;
        }

        // Create a FormData object to handle file upload
        var formData = new FormData();
        formData.append("title", title);
        formData.append("seats_no", seats_no);
        formData.append("price", price);
        formData.append("date", date);
        formData.append("stime", stime);
        formData.append("etime", etime);
        formData.append("location", location);
        formData.append("des", des);
        if (image) {
            formData.append("image", image);
        }

        // Send AJAX request to PHP
        $.ajax({
            url: 'event_submit_ajax.php',  // The PHP file that processes the form
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Log the response to debug
                console.log(response); 

                if (response == 'success') {
                    // Show the success modal

                   // Hide the modal (use Bootstrap's method for proper handling in Bootstrap 5)
                    var createEventModal = new bootstrap.Modal(document.getElementById('createEventForm'));
                    createEventModal.hide();

                    // Hide the modal backdrop (if any) manually
                    $('.modal-backdrop').remove();

                    // Clear all input fields
                    $("#title").val('');
                    $("#seats_no").val('');
                    $("#price").val('');
                    $("#date").val('');
                    $("#stime").val('');
                    $("#etime").val('');
                    $("#location").val('');
                    $("#des").val('');
                    $("#image").val('');  // Clears the file input

                    $('#successModal').modal('show');



                } else if (response == 'error_time') {
                    alert("End time cannot be earlier than start time.");
                } else if (response == 'error_upload') {
                    alert("Error in uploading the image.");
                } else if (response == 'error_size') {
                    alert("The file is too large. Please upload a file smaller than 2MB.");
                } else if (response == 'error_db') {
                    alert("There was an issue saving the event to the database.");
                } else if (response.indexOf("error_db_exception") !== -1) {
                    alert("Database error: " + response.split(":")[1]);
                } else if (response == 'error_empty_fields') {
                    alert("Please fill out all required fields.");
                } else if (response == 'error_request_method') {
                    alert("Invalid request method.");
                } else {
                    alert('An unknown error occurred: ' + response);
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred while submitting the form: ' + error);
            }
        });
    });
});



// Edit event list

$(document).ready(function() {
    // When an Edit button is clicked
    $('.fa-edit').on('click', function() {
        var eventId = $(this).attr('id'); // Get the event ID from the button
        // Fetch event data via AJAX
        $.ajax({
            url: 'get_event_data.php', // This is the PHP file that fetches the event data
            method: 'GET',
            data: { id: eventId },
            success: function(response) {
                var eventData = JSON.parse(response);

                // If event data is found, populate the form
                if (!eventData.error) {
                    $('#event_id').val(eventData.event_id);
                    $('#title').val(eventData.event_name);
                    $('#price').val(eventData.price);
                    $('#date').val(eventData.event_date);
                    $('#stime').val(eventData.start_time);
                    $('#etime').val(eventData.end_time);
                    $('#location').val(eventData.location);
                    $('#des').val(eventData.description);
                    // Optionally, set the image if available
                    // Example: $('#imagePreview').attr('src', eventData.image);

                    // Show the modal
                    $('#createEventForm').modal('show');
                } else {
                    alert('Event not found');
                }
            },
            error: function(error) {
                console.log('Error fetching event data:', error);
            }
        });
    });

    // Form submission (update event)
    $('#eventRegister').on('submit', function(e) {
        e.preventDefault(); // Prevent form submission

        var formData = new FormData(this); // Serialize form data (including file input)

        // Send AJAX request to update the event
        $.ajax({
            url: 'update_event.php', // The PHP file to update the event in the database
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                var result = JSON.parse(response);

                if (result.success) {
                    alert(result.success);
                    $('#createEventForm').modal('hide');
                    location.reload(); // Optionally reload to reflect updated event
                } else {
                    alert(result.error);
                }
            },
            error: function(error) {
                console.log('Error updating event:', error);
            }
        });
    });
});






// Delete event ajax
$(document).ready(function() {
    // Listen for click on delete button (trash icon)
    $('.fas.fa-trash').on('click', function() {
        var eventId = $(this).data('event-id'); // Get event_id from data attribute

        // Show confirmation dialog
        var confirmation = confirm("Are you sure you want to delete this event?");

        if (confirmation) {
            // If the user confirms, send the AJAX request
            $.ajax({
                url: 'delete_event.php', // PHP script that deletes the event
                method: 'POST',
                data: { event_id: eventId }, // Send the event ID to PHP
                success: function(response) {
                    var result = JSON.parse(response); // Parse JSON response

                    // If deletion is successful, show success message and remove event
                    if (result.success) {
                        alert(result.success); // Success message
                        // Optionally, remove the event from the page (if in a list or table)
                        $('#event_' + eventId).remove(); // Assuming each event has an id like 'event_1'
                    } else {
                        alert(result.error); // Show error message
                    }
                },
                error: function() {
                    alert("An error occurred while deleting the event.");
                }
            });
        } else {
            // If the user cancels, do nothing
            console.log("Delete action canceled.");
        }
    });
});




// ajax.js
$(document).ready(function () {


     var done = 0;
     function checkRowCount() {
        $.ajax({
            url: "check_row_count.php", // URL to the PHP script that returns the current row count
            type: "GET", // Send as GET request
            dataType: "json", // Expect JSON response
            success: function (response) {
                if (response.success) {
                    // Update the previousRowCount to the latest row count
                    previousRowCount = response.row_count;
                } else {
                    console.error(response.message);
                    done = 1;
                }
            },
            error: function () {
                console.error("An error occurred while checking the row count.");
            }
        });
    }

    // Initialize previous row count to 0 (or any value you want to start with)
    let previousRowCount = 0;

    // Call the function every 5 seconds to check for row count updates
    setInterval(checkRowCount, 5000); // Adjust the interval as needed







    // Form submit handler
    $("#registrationForm").on("submit", function (e) {
        e.preventDefault(); // Prevent default form submission

        const formData = {
            name: $("#name").val().trim(),
            email: $("#email").val().trim(),
            phone: $("#phone").val().trim(),
            gender: $("#gender").val(),
            password: $("#password").val().trim(),
            confirm_password: $("#confirm_password").val().trim(),
            role: $("#role").val(),
            terms: $("#terms").is(":checked"),
        };

        let errors = [];

        // Simple client-side validation
        if (!formData.name) {
            errors.push("Name is required.");
        }

        if (!formData.email || !validateEmail(formData.email)) {
            errors.push("Valid email is required.");
        }

        if (formData.password.length < 6) {
            errors.push("Password must be at least 6 characters.");
        }

        if (formData.password !== formData.confirm_password) {
            errors.push("Passwords do not match.");
        }

        if (!formData.terms) {
            errors.push("You must agree to the terms and conditions.");
        }

        // If validation fails, show errors
        if (errors.length > 0) {
            showNotification(errors.join("<br>"), "error");
            return;
        }

        // Send AJAX request to insert data
        $.ajax({
            url: "registration.php", // URL to your PHP script
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    showNotification(response.message, "success");
                    $("#registrationForm")[0].reset(); // Reset the form after successful insertion
                } else {
                    showNotification(response.message, "error");
                }
            },
            error: function () {
                if(done = 1){
                    showNotification("Registratoin Success Please Wait for Admin Approval.", "success");
                }else{
                showNotification("An error occurred. Please try again.", "error");
                }
            },
        });
    });

    // Utility: Email validation
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // Utility: Show notification
    function showNotification(message, type) {
        const notification = `
            <div class="alert alert-${type === "success" ? "success" : "danger"}" role="alert">
                ${message}
            </div>`;
        $("#notification").html(notification);
    }
});















// Approve user by updating the admin_approval status to 1
function approveUser(userId) {
    $.ajax({
        url: 'approve_reject.php',
        type: 'POST',
        data: { action: 'approve', user_id: userId },
        success: function(response) {
            if (response == 'success') {
                $(`#user-row-${userId} .status-${userId}`).html('<i class="fas fa-check-circle approved-icon"></i>');
                $(`#user-row-${userId} .btn-approve`).remove();
            }
        }
    });
}

// Reject user by deleting the user from the database
function rejectUser(userId) {
    $.ajax({
        url: 'approve_reject.php',
        type: 'POST',
        data: { action: 'reject', user_id: userId },
        success: function(response) {
            if (response == 'success') {
                $(`#user-row-${userId}`).remove();
            }
        }
    });
}



// Search functionality using jQuery
$('#search-input').on('keyup', function() {
    var searchTerm = $(this).val().toLowerCase();
    
    $('#ticketTable tbody tr').each(function() {
        var rowText = $(this).text().toLowerCase();
        if (rowText.indexOf(searchTerm) > -1) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
});










// Approve ticket
function approveTicket(ticketId) {
    $.ajax({
        url: 'approve_reject_ticket.php',
        type: 'POST',
        data: { action: 'approve', ticket_id: ticketId },
        success: function(response) {
            if (response == 'success') {
                $(`#ticket-row-${ticketId} .status-${ticketId}`).html('<i class="fas fa-check-circle approved-icon"></i>');
                $(`#ticket-row-${ticketId} .btn-approve`).remove();
            }
        }
    });
}

// Reject ticket
function rejectTicket(ticketId) {
    $.ajax({
        url: 'approve_reject_ticket.php',
        type: 'POST',
        data: { action: 'reject', ticket_id: ticketId },
        success: function(response) {
            if (response == 'success') {
                $(`#ticket-row-${ticketId}`).remove();
            }
        }
    });
}







$(document).ready(function() {
  $('#event_book_form').on('submit', function(e) {
    e.preventDefault(); // Prevent form submission

    var urlParams = new URLSearchParams(window.location.search);
    $('.error').text(''); // Clear previous error messages
  
    var isValid = true;

    // Get the form values
    var name = $('#name').val().trim();
    var email = $("#email").val().trim(); // Fix typo here
    var phone = $("#phone").val().trim();
    var seat = $("#inputField").val().trim();  // Seat value
    var tshirt_size = $("#tshirt_size").val();
    var eventId = urlParams.get('id'); // Get eventId from URL

    // Validate inputs
    if (name === '') {
      $('#name_error').text('Name is required.');
      isValid = false;
    }

    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (email === '') {
      $('#email_error').text('Email is required.');
      isValid = false;
    } else if (!emailPattern.test(email)) {
      $('#email_error').text('Enter a valid email address.');
      isValid = false;
    }

    var phonePattern = /^\d{11}$/; // Bangladesh phone number
    if (phone === '') {
      $('#phone_error').text('Phone number is required.');
      isValid = false;
    } else if (!phonePattern.test(phone)) {
      $('#phone_error').text('Enter a valid phone number.');
      isValid = false;
    }

    if (seat === '') {
      $('#seat_error').text('Please select a seat.');
      isValid = false;
    }

    if (tshirt_size === '') {
      $('#tshirt_error').text('Please select a T-shirt size.');
      isValid = false;
    }

    if (isValid) {
      $.ajax({
        url: 'event_book.php',
        method: 'POST',
        data: {
          name: name,
          email: email,
          phone: phone,
          seat: seat,
          tshirt_size: tshirt_size,
          eventId: eventId
        },
        success: function(response) {
          if (response == 'success') {
            $('#event_booked').addClass('alert alert-success');
            $('#event_booked').text('Event Booked Successfully.');

            // Clear the form fields after success
            $('#name').val('');
            $('#email').val('');
            $('#phone').val('');
            $('#inputField').val('');
            $('#tshirt_size').val('');
          } else {
            $('#event_booked').addClass('alert alert-danger');
            $('#event_booked').text('Booking failed. Please try again.');
          }
        },
        error: function(xhr, status, error) {
          $('#event_booked').addClass('alert alert-danger');
          $('#event_booked').text('An error occurred. Please try again later.');
        }
      });
    } else {
      console.log("Form has errors, please fix them.");
    }
  });
});






// Ticket filter ajax
$(document).ready(function() {
    $('#search-input').change(function() {
        var eventId = $(this).val();
        
        // Send AJAX request if event is selected
        if (eventId) {
            $.ajax({
                url: 'fetch_tickets.php', // The file where AJAX request is handled
                method: 'POST',
                data: { event_id: eventId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Clear existing rows
                        $('#ticketTableBody').empty();
                        
                        // Populate table with new ticket data
                        var tickets = response.tickets;
                        $.each(tickets, function(index, ticket) {
                            var statusIcon = '';
                            if (ticket.approval_status === 'approved') {
                                statusIcon = '<i class="fas fa-check-circle approved-icon"></i>';
                            } else if (ticket.approval_status === 'rejected') {
                                statusIcon = '<i class="fas fa-times-circle rejected-icon"></i>';
                            } else {
                                statusIcon = '<i class="fas fa-clock"></i>';
                            }
                            
                            var row = `
                                <tr class="ticket-row" data-event-id="${ticket.event_id}" id="ticket-row-${ticket.ticket_id}">
                                    <td>${ticket.user_name}</td>
                                    <td>${ticket.user_email}</td>
                                    <td>${ticket.user_phone}</td>
                                    <td>${ticket.seat_number}</td>
                                    <td>${ticket.price}</td>
                                    <td>${ticket.tshirt_size}</td>
                                    <td>${ticket.purchased_at}</td>
                                    <td>
                                        <span class="status-${ticket.ticket_id}">
                                            ${statusIcon}
                                        </span>
                                    </td>
                                    <td>
                                        ${ticket.approval_status === 'pending' ? `<button class="btn btn-approve btn-sm" onclick="approveTicket(${ticket.ticket_id})">Approve</button>` : ''}
                                        <button class="btn btn-reject btn-sm" onclick="rejectTicket(${ticket.ticket_id})">Reject</button>
                                    </td>
                                </tr>
                            `;
                            
                            $('#ticketTableBody').append(row);
                        });
                    } else {
                        alert(response.message);
                    }
                }
            });
        }
    });
});