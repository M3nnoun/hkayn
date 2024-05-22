$(document).ready(function () {
  $("#toggle-password").click(function () {
    var passwordField = $("#login-password");
    var icon = $("#toggle-password i");

    // Toggle the password field between text and password
    if (passwordField.attr("type") === "password") {
      passwordField.attr("type", "text");
      icon.removeClass("fa-eye").addClass("fa-eye-slash");
    } else {
      passwordField.attr("type", "password");
      icon.removeClass("fa-eye-slash").addClass("fa-eye");
    }
  });
  function checkUsernameAvailability(username, callback) {
    $.ajax({
      url: "../back-end/checkUsername.php",
      method: "POST",
      data: {
        username: username,
      },
      success: function (response) {
        // Parse the response as needed (e.g., assuming '1' means true)
        var isAvailable = response === "1";

        // Call the callback function with the result
        callback(isAvailable);
      },
      error: function (error) {
        console.error("Error checking username");
        // Call the callback function with an error flag
        callback(false);
      },
    });
  }

  // Function to handle the login
  function login() {
    var username = $("#login-username").val();
    var password = $("#login-password").val();

    // Make an AJAX request for login
    $.ajax({
      type: "POST",
      url: "../back-end/authenticateUser.php", // Specify the URL for your login endpoint
      data: {
        username: username,
        password: password,
      },
      success: function (response) {
        // Handle the success response
        alert("Success! Redirecting to home page...",response);
        window.location.href = "../index.php"; // 
      },
      error: function (error) {
        // Handle the error response
        $("#errorModal").modal("show");
      },
    });
  }
  // function to create a new user
  function signup() {
    // Fetch form data
    var email=$("#signup-email").val();
    var formData = {
      firstname: $("#signup-firstname").val(),
      lastname: $("#signup-lastname").val(),
      username: $("#signup-username").val(),
      email: $("#signup-email").val(),
      password: $("#signup-password").val(),
      gender: $("input[name='gender']:checked").val(),
      dob: $("#signup-dob").val(),
    };

    // Make an AJAX request using jQuery
    $.ajax({
      type: "POST",
      url: "../back-end/signup.php", // Replace with your server endpoint
      data: JSON.stringify(formData),
      contentType: "application/json",
      success: function (response) {
        if (response.status === "success") {
          var delay = 3000;

          // URL to redirect to
          var redirectTo = "../profile-setup.php?email="+email;
          // Use setTimeout to wait for the specified delay
          setTimeout(function () {
            // Redirect the user to the specified URL
            window.location.href = redirectTo;
          }, delay);
        }
        if (response.status === "error") {
          alert("Signup eroor!");
        }
      },
      error: function (error) {
        // Handle error response
        console.log("Signup failed:", error);
        // alert("Signup failed. Please try again.");
      },
    });
  }

  $("#login-username").on("blur", function () {
    var enteredUsername = $(this).val();
    var inputElement = this; // Save the reference to 'this'

    // Call the function with the entered username
    checkUsernameAvailability(enteredUsername, function (isAvailable) {
      // Toggle the red border class based on username availability
      $(inputElement).toggleClass("border-success", isAvailable);
    });
  });

  $("#login-btn").on("click", function () {
    login();
  });

  $("#sign-up").on("click", function () {
    signup();
  });

  // john_doe
});
