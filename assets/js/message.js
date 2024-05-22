function getParameterByName(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}

// Get the 'username' parameter from the URL using jQuery
var username = getParameterByName("username");

function getUserInformation(username) {
  return new Promise(function (resolve, reject) {
    // Replace the URL with the actual path to your PHP endpoint
    var endpointUrl = "./back-end/userInfo.php";

    // Make an AJAX request
    $.ajax({
      url: endpointUrl,
      method: "GET",
      data: { username: username },
      dataType: "json",
      success: function (response) {
        // Resolve the Promise with the successful response
        resolve(response);
      },
      error: function (error) {
        // Reject the Promise with the error response
        reject(error.responseText);
      },
    });
  });
}

function updateUserProfile(username) {
  // Call the function to get user information
  getUserInformation(username)
    .then(function (response) {
      // Handle the successful response
      if (response) {
        // Access user information properties (e.g., full name, profile image)
        var fullName = response.first_name + " " + response.last_name;
        var profileImage =
          "uploads/" +
          (response.profile_image == null
            ? response.profile_image
            : "Default_pfp.svg");
        $("img").attr("src", profileImage);
        // Update the HTML dynamically
        var userProfileHtml = `
                    <!-- User Image (Avatar) -->
                    <img src="${profileImage}" alt="${fullName} Avatar" class="w-16 h-16 rounded-full mx-auto mb-4">
                    <!-- Full Name -->
                    <h2 class="text-lg font-semibold text-center mb-2">${fullName}</h2>
                    <!-- View Profile Button -->
                    <button class="bg-blue-500 text-white p-2 rounded-full mx-auto block">View Profile</button>
                `;

        // Insert the updated HTML into the container
        $("#userProfileContainer").html(userProfileHtml);
      } else {
        // Display an empty div if user information is not found
        $("#userProfileContainer").html("");
        console.error("User information not found");
      }
    })
    .catch(function (error) {
      // Handle the error response
      console.error("Error:", error.responseText);
    });
}

// function to get the all messages
function getMessages(username) {
  return new Promise(function (resolve, reject) {
    // Replace this with the actual path to your PHP file
    var endpointUrl = "back-end/getMessages.php";

    // Make the AJAX request
    $.ajax({
      url: endpointUrl,
      method: "GET",
      data: {
        user1_username: $("#user-id").val(),
        user2_username: username,
      },
      dataType: "json",
      success: function (response) {
        // Handle the response
        generateMessages(response);
        resolve(response);
      },
      error: function (error) {
        // Handle the error
        reject(error.responseText);
      },
    });
  });
}

// generate messages:
function generateMessages(response) {
  var messagesContainer = $("#messages-container");
  console.log(response);
  // Clear existing messages
  messagesContainer.empty();

  if (response.messages && response.messages.length > 0) {
    let userId = response.currentUserId;
    console.log(userId);
    response.messages.forEach(function (message) {
      var messageContainer = $("<div></div>");

      // Check if the message is from the current user or the other user
      if (message.sender_id == userId) {
        messageContainer.addClass("flex items-end mb-4 justify-end");
        messageContainer.append(
          '<div class="bg-blue-500 text-white p-2 rounded-lg max-w-xs"><p>' +
            message.message_text +
            "</p></div>"
        );
      } else {
        messageContainer.addClass("flex items-start mb-4");
        messageContainer.append(
          '<div class="bg-gray-300 p-2 rounded-lg max-w-xs"><p>' +
            message.message_text +
            "</p></div>"
        );
      }

      // Append the message container to the messages container
      messagesContainer.append(messageContainer);
    });
  } else {
    // Display a message if no messages are found
    messagesContainer.append("<p>No messages found</p>");
  }
}

// Function to send a new message to the server
function sendMessage(messageText) {
  var endpointUrl = "back-end/sendMessage.php";
  // Make the AJAX request
  $.ajax({
    url: endpointUrl,
    method: "POST",
    data: {
      user1_username: $("#user-id").val(),
      user2_username: $("#recipient_username").val(),
      message_text: messageText,
    },
    dataType: "json",
    success: function (response) {
      // Handle the response
      if (response.success) {
        // If the message is sent successfully, update the messages container
        getMessages($("#recipient_username").val());
        // Clear the input field after sending the message
        $("#message-input").val("");
      } else {
        // Handle the case where the message is not sent successfully
        console.error("Failed to send the message");
      }
    },
    error: function (error) {
      // Handle the error
      console.log("Here");
      console.error(error.responseText);
    },
  });
}

function getFriendsData() {
  const cacheBuster = new Date().getTime(); // Use current timestamp as a cache buster
  const url = `./back-end/chargerHome.php?parme=&${cacheBuster}`;

  return $.ajax({
    url: url,
    method: "GET",
    dataType: "json",
  });
}

// function to update the slidebar
function updateSlideBare(friendsData) {
  const friendsList = $("#friendsList");
  // console.log(friendsData);
  const hederConversations = document.createElement("div");
  hederConversations.innerHTML =
    '<h2 class="text-lg font-semibold mb-4">Conversations</h2>';
  // Clear existing content

  friendsList.empty();
  friendsList.append(hederConversations);
  // Append each friend to the list
    friendsData.forEach((friend) => {
    const conversationItem = $("<a>", {
      class: "mb-4 flex items-center pl-4 conversation",
      href: `./message.php?username=${friend.friend_username}`, // Replace with the appropriate URL or route
      style: "display: block", // Add display: block style
    }).append(
      $("<img>", {
        src: friend.profile_image
          ? `./uploads/${friend.profile_image}`
          : "./uploads/Default_pfp.svg",
        alt: `${friend.full_name} Avatar`,
        class: "w-10 h-10 rounded-full mr-2",
      }),
      $("<div>").append(
        $("<h3>", { class: "text-base font-semibold", text: friend.full_name }),
        $("<p>", {
          class: "text-sm text-gray-500",
          text: friend.last_message
            ? `Last Message: ${friend.last_message}`
            : "You are now friends, say Hkayn 👋",
        }),
        $("<input>", {
          type: "hidden",
          name: "friend_username",
          value: friend.friend_username,
        })
      )
    );

    friendsList.append(conversationItem);
  });
}

$(document).ready(function () {
  document.title = username + "'s conversation";
  updateUserProfile(username);
  //get all messages:
  getMessages(username);
  // charger slidebar
  getFriendsData()
    .done(function (data) {
      // friends=data;
      updateSlideBare(data);
    })
    .fail(function (error) {
      console.error("Error fetching friends data:", error);
    });

  $("#send-button").on("click", function () {
    // Get the message input value
    const newMessageText = $("#message-input").val().trim();

    // Check if the message is not empty
    if (newMessageText) {
      // Call the sendMessage function
      var messageContainer = $("<div></div>");
      messageContainer.addClass("flex items-end mb-4 justify-end");
      messageContainer.append(
        '<div class="bg-blue-500 text-white p-2 rounded-lg max-w-xs"><p>' +
          newMessageText +
          "</p></div>"
      );
      $("#messages-container").append(messageContainer);
      sendMessage(newMessageText);
      getFriendsData()
        .done(function (data) {
          // friends=data;
          updateSlideBare(data);
        })
        .fail(function (error) {
          console.error("Error fetching friends data:", error);
        });
    }
  });
});
