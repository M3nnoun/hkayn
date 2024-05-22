<?php
include __DIR__ . '/back-end/check_session.php';
$username = $_GET['username'];
// Print the retrieved username
// echo "Username: " . htmlspecialchars($username);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Tailwind CSS via CDN -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> -->
  <link
      href="./assets/css/tailwind.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/message.css">
  <title>Conversation Page</title>
  <script src="assets/jQuery/jQuery.js"></script>
  <script src="assets/js/message.js"></script>
</head>
<body class="font-sans bg-gray-100 h-screen">

  <div class="flex h-screen">

    <!-- Sidebar (List of Conversations) -->
    <div class="w-1/4 bg-white border-r border-gray-200 overflow-y-auto hidden sm:block pt-5" id="friendsList">
      <!-- Sidebar content goes here -->
      <!-- Display a list of conversations with friends' names and last messages -->
      <div class="p-4">
            <h2 class="text-lg font-semibold mb-4">Conversations</h2>
        <!-- Example Conversation Item -->
             <div class="mb-4 flex items-center">
                  <img src="uploads/Default_pfp.svg" alt="Friend 1 Avatar" class="w-10 h-10 rounded-full mr-2">
                  <div>
                      <h3 class="text-base font-semibold">Friend 1</h3>
                      <p class="text-sm text-gray-500">Last Message: Hi there!</p>
                  </div>
              </div>
      </div>
    </div>

    <!-- Main Conversation Area -->
    <div class="flex-1 flex flex-col overflow-hidden">

      <!-- Header -->
      <div class="flex-shrink-0 bg-white border-b border-gray-200 p-4 flex items-center justify-between">
    <div class="flex items-center">
        <img src="uploads/Default_pfp.svg" alt="User Avatar" class="w-8 h-8 rounded-full mr-2">
        <!-- User Name -->
        <h2 class="text-lg font-semibold"><?php echo($username)?></h2>
    </div>

    <!-- Home Link -->
    <a href="home.php" class="text-blue-500 hover:underline">Home</a>
</div>


      <!-- Messages Container -->
      <div class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 p-4">

        <!-- User Profile Section in Center (for small/medium screens) -->
        <div class="flex-col items-center justify-center mb-8" id="userProfileContainer">
   <!-- User information will be dynamically inserted here -->
      </div>


        <!-- Friend List Container (for large screens) -->
        <div class="hidden sm:block w-1/4 bg-white border-r border-gray-200 overflow-y-auto">
          <!-- Friend list content goes here -->
          <!-- Display user's friends, avatars, etc. -->
        </div>
        <div id="messages-container">
        
        </div>
        
        <!-- Add more messages as needed -->

      </div>

      <!-- Message Input Area -->
      <div class="bg-white border-t border-gray-200 p-4 flex items-center">
        <!-- Input field for typing messages -->
        <input type="text" class="w-full p-2 border border-gray-300 rounded-l focus:outline-none focus:border-blue-500" placeholder="Type your message..." id="message-input">
        <!-- Send button -->
        <button class="bg-blue-500 text-white p-2 rounded-r ml-2 w-15/100" id="send-button">Send</button>
      </div>

    </div>

  </div>
  <input type="hidden" name="user-id" id="user-id" value="<?php echo($_SESSION['username'])?>">
  <input type="hidden" name="recipient_username" id="recipient_username" value="<?php echo($_GET['username'])?>">
</body>
</html>
