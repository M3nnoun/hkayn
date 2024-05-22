// Function to fetch friends data from the server
var newFriends = [];
var userslist = [];
var friends;
function getFriendsData() {
  return $.ajax({
    url: "./back-end/chargerHome.php",
    method: "GET",
    dataType: "json",
  });
}

function updateFriendsList(friendsData) {
  const friendsList = $("#friendsList");
  console.log(friendsData);

  // Clear existing content
  friendsList.empty();

  // Append each friend to the list
  friendsData.forEach((friend) => {
    const listItem = $("<a>", {
      href: `./message.php?username=${friend.friend_username}`,
      class: "block",
    }).append(
      $("<li>", { class: "p-4 flex items-center" }).append(
        // Check if profile_image is available
        friend.profile_image
          ? $("<img>", {
              src: `./uploads/${friend.profile_image}`,
              alt: friend.friend_username,
              class: "w-12 h-12 rounded-full mr-4",
            })
          : $("<img>", {
              src: "./uploads/Default_pfp.svg",
              alt: "Default Profile",
              class: "w-12 h-12 rounded-full mr-4",
            }), // Default image if no profile image

        $("<div>", { class: "flex-1" }).append(
          $("<h3>", { class: "text-lg font-semibold", text: friend.full_name }),
          // Check if last_message exists
          friend.last_message
            ? $("<p>", { class: "text-gray-600", text: friend.last_message })
            : $("<p>", {
                class: "text-gray-600",
                text: "You are now friends say Hkayn 👋",
              })
        )
      )
    );

    friendsList.append(listItem);
  });
}

// Load friends when the page loads
$(document).ready(function () {
  getFriendsData()
    .done(function (data) {
      // Assuming the server returns an array of friends
      friends = data;
      updateFriendsList(data);
    })
    .fail(function (error) {
      console.error("Error fetching friends data:", error);
    });

  // Function to open the modal
  function openModal() {
    $("#searche-new-friend").removeClass("hidden");
  }

  // Function to close the modal
  function closeModal() {
    $("#searche-new-friend").addClass("hidden");
    // send request for the new friends
    const friendsUniques = new Set(newFriends);
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
        // update the convesation
        getFriendsData()
          .done(function (data) {
            // Assuming the server returns an array of friends
            updateFriendsList(data);
          })
          .fail(function (error) {
            console.error("Error fetching friends data:", error);
          });
      },
      error: function (error) {
        console.error("Error sending data:", error);
      },
    });
  }

  // Event listener for opening the modal
  $("#openModalBtn").on("click", function () {
    // filter the friends:
    let friendUsernames = friends.map((friend) => friend.friend_username);

    // Filter userslist based on the absence of matching usernames in friendUsernames
    let filteredUserslist = userslist.filter(
      (user) => !friendUsernames.includes(user.username)
    );
    updateUsersList(filteredUserslist);
    $("#friendSearch").val("");
    openModal();
    newFriends = [];
  });
  // Event listener for closing the modal
  $("#closeModalBtn").on("click", closeModal);

  // Close the modal if the user clicks outside the modal content
  $(window).on("click", function (event) {
    if (event.target.id === "searche-new-friend") {
      closeModal();
    }
  });

  // List all users in our database
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

  // Function to add a friend
  function addFriend(username) {
    // Replace this with your actual logic for adding a friend
    console.log("Adding friend: " + username);
    newFriends.push(username);
    console.log(newFriends);

    // Toggle button text
    var addButton = $("#addFriendButton_" + username);
    var currentText = addButton.text();

    if (currentText === "Add Friend") {
      addButton.text("Friend Request Sent");
    } else {
      addButton.text("Add Friend");
    }
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

      // Button to add a friend
      var addButton = $(
        '<button class="friend-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline-blue active:bg-blue-800">'
      )
        .text("Add Friend")
        .attr("id", "addFriendButton_" + user.username)
        .click(function () {
          addFriend(user.username);
        });

      userItem.append(profileDiv, addButton);
      userListContainer.append(userItem);
    });

    // searche for a pacticuler user
    $("#friendSearch").on("keyup", function () {
      // updateUsersList(userslist);
      updateUsersList(
        userslist.filter((user) => user.username.includes($(this).val()))
      );
    });
  }

  const $showSignoutAlertBtn = $("#showSignoutAlert");
  const $signoutAlert = $("#signoutAlert");
  const $cancelBtn = $("#cancelBtn");

  $showSignoutAlertBtn.click(function () {
    $signoutAlert.removeClass("hidden");
  });

  $cancelBtn.click(function () {
    $signoutAlert.addClass("hidden");
  });

  // Close the modal if clicked outside of it
  $(document).click(function (event) {
    if (event.target === $signoutAlert[0]) {
      $signoutAlert.addClass("hidden");
    }
  });

  $("#log-out-confirm").click(function () {
    $.ajax({
      url: "back-end/logout.php",
      type: "POST",
      dataType: "json",
      success: function (response) {
        // Handle the response
        if (response.status === "success") {
          // Optionally, you can perform additional actions on success
          console.log(response.message);
          // Redirect to a login page, for example
          window.location.href = "./";
        } else {
          // Handle errors or display a message
          console.error("Logout failed:", response.message);
        }
      },
      error: function (xhr, status, error) {
        // Handle AJAX errors
        console.error("AJAX error:", status, error);
      },
    });
  });
});
