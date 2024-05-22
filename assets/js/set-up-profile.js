let currentStep = 1;
var emailConfirmationResponse;
function nextStep(step) {
  if (step === currentStep && step < 3) {
    $(`#step${step}`).addClass("hidden");
    currentStep++;
    $(`#step${currentStep}`).removeClass("hidden");
  }
}

function prevStep() {
  if (currentStep > 1) {
    $(`#step${currentStep}`).addClass("hidden");
    currentStep--;
    $(`#step${currentStep}`).removeClass("hidden");
  }
}

function skipSetup() {
  if (currentStep < 3) {
    $(`#step${currentStep} button`).click();
  } else {
    alert("No more steps to skip!");
  }
}

function getParameterByName(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}
$(document).ready(function () {
  var userslist = null;
  // the frinds in the future
  var friends = [];
  // Usage example
  var email = getParameterByName("email");
  if (email !== null) {
    // Do something with the email value
    $("#email").val(email);
  } else {
    window.location.href = "home.php";
  }
  // email confermation logic

  // JavaScript for Countdown Timer
  let countdownInterval;
  let sendCodeBtn = $("#sendCodeBtn");

  function updateCountdown() {
    let timeLeft = 60;
    const countdownElement = $("#countdown");
    countdownElement.text("1:00");

    countdownInterval = setInterval(() => {
      const minutes = Math.floor(timeLeft / 60);
      const seconds = timeLeft % 60;
      countdownElement.text(`${minutes}:${seconds < 10 ? "0" : ""}${seconds}`);
      if (timeLeft > 0) {
        timeLeft--;
        // Disable the button during the countdown
        sendCodeBtn.prop("disabled", true);
      } else {
        clearInterval(countdownInterval);
        // Enable the button after the countdown
        sendCodeBtn.prop("disabled", false);
      }
    }, 1000);
  }

  // Modal Functions
  $("#openModalBtn").on("click", function () {
    // Send request to the server
    $.ajax({
      url: "back-end/emailConfirmation.php",
      method: "POST",
      data: {
        email: $("#email").val(),
      },
      success: function (response) {
        if (response.success) {
          emailConfirmationResponse = response;
        } else {
          $("#closeModalBtn").click();
          nextStep(1);
        }
      },
      error: function (error) {
        console.error("Error sending code:", error);
      },
    });
    $("#confirmationModal").css("display", "flex");
    clearInterval(countdownInterval); // Clear any existing countdown
    updateCountdown(); // Start a new countdown
  });

  $("#closeModalBtn").on("click", function () {
    $("#confirmationModal").css("display", "none");
    clearInterval(countdownInterval); // Clear the countdown when closing the modal
    sendCodeBtn.prop("disabled", true); // Disable the button when closing the modal
  });

  // final email conformation proceces

  function handleEmailConfirmation(responseCode) {
    if (responseCode == $("#user-confirmation-code").val()) {
      $.ajax({
        url: "back-end/finalEmailConfirmation.php",
        method: "POST",
        data: {
          email: $("#email").val(),
          state: "OK",
        },
      });
      $("#confirmationModal").css("display", "none");
      $("#email").val("");
      $("#closeModalBtn").click();
    }
  }

  // Attach a keyup event listener to the input field
  $("#user-confirmation-code").keyup(function () {
    // Check if the length of the input value is 4
    if ($(this).val().length == 4) {
      // Call the handleEmailConfirmation function
      console.log(emailConfirmationResponse.code);
      handleEmailConfirmation(emailConfirmationResponse.code);
    }
  });
  // uplaod the images

  $("#uploadButton").on("click", function () {
    // Create a FormData object to store the form data, including the file
    var formData = new FormData($("#imageUploadForm")[0]);

    // Perform AJAX request
    $.ajax({
      url: "back-end/upload.php",
      method: "POST",
      data: formData,
      processData: false, // Prevent jQuery from automatically transforming the data into a query string
      contentType: false, // Set to false, as jQuery will set the content type
      success: function (response) {
        if (response.status === "success") {
          $("#profileImage").attr("src", "uploads/" + response.fileName);
          nextStep(2);
          console.log("next");
        }
      },
      error: function (error) {
        console.error("Error uploading image:", error);
      },
    });
  });

  // List all user in our database
  $.ajax({
    url: "back-end/get_users.php",
    method: "GET",
    dataType: "json",
    success: function (users) {
      // Update the user list dynamically
      userslist = users;
      updateUsersList(users);
    },
    error: function (error) {
      console.error("Error fetching user data:", error);
    },
  });
  //function add user
  function addFriend(username) {
    // Replace this with your actual logic for adding a friend
    console.log("Adding friend: " + username);
    friends.push(username);
    console.log(friends);
  }
  // Function to update the user list
  function updateUsersList(users) {
    var userListContainer = $("#userList");
    userListContainer.empty();

    // Iterate through users and generate HTML
    $.each(users, function (index, user) {
      var userItem = $(
        '<div class="flex items-center justify-between border-b py-2">'
      );

      // User Profile Image Circle and Name in the same div
      var profileDiv = $('<div class="flex items-center">').append(
        $('<div class="rounded-full overflow-hidden h-8 w-8">').append(
          $(
            '<img src="uploads/' +
              (user.profile_image || "Default_pfp.svg") +
              '" alt="User Profile" class="w-full h-full object-cover">'
          )
        ),
        $('<p class="ml-3 text-sm font-medium text-gray-800">').text(
          user.username
        )
      );

      // Buttons in a separate div
      var initialText = "Add Friend";
      var buttonsDiv = $('<div class="flex space-x-2">').append(
        $(
          '<button class="friend-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline-blue active:bg-blue-800">'
        )
          .text(initialText)
          .attr("id", "addFriendButton_" + user.username)
          .data("username", user.username)
          .click(function () {
            var currentText = $(this).text();
            var newText =
              currentText === initialText ? "Friend Request Sent" : initialText;

              if (currentText === initialText) {
                addFriend(user.username);
                $(this).text(newText);
              } else {
                var index = friends.indexOf(user.username);
                if (index !== -1) {
                  friends.splice(index, 1);
                  $(this).text(initialText);
                }
              }
          })
      );

      userItem.append(profileDiv, buttonsDiv);
      userListContainer.append(userItem);
    });
  }
  $("#friendSearch").on("keyup", function () {
    // updateUsersList(userslist);
    updateUsersList(
      userslist.filter((user) => user.username.includes($(this).val()))
    );
  });

  // finsh the setting , BY Sending Frind request
  $("#finish-btn").on("click", function () {
    const friendsUniques = new Set(friends);
    const username = $("#user-id").val();

    // Create an object with both username and friends data
    const requestData = {
      username: username,
      friends: [...friendsUniques],
    };

    console.log(JSON.stringify(requestData)); // Log the payload

    $.ajax({
      url: "back-end/friendsRequest.php",
      method: "POST",
      contentType: "application/json",
      data: JSON.stringify(requestData),
      success: function (data) {
        window.location.href = "./home.php";
      },
      error: function (error) {
        console.error("Error sending data:", error);
      },
    });
  });
});
