<?php
include __DIR__ . '/back-end/check_session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hkayn</title>
    <link
      href="./assets/css/tailwind.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="assets/jQuery/jQuery.js"></script>
    <script src="assets/js/home.js"></script>
</head>
<body class="font-sans bg-gray-100">

<header class="bg-green-500 text-white py-4 px-6 flex items-center justify-between">
    <div class="flex items-center">
        <!-- User Image (Circle) -->
        <div class="w-10 h-10 rounded-full overflow-hidden mr-2">
        <img src="./uploads/<?php echo ($_SESSION['userImage'] ? $_SESSION['userImage'] : 'Default_pfp.svg'); ?>" alt="User Avatar" class="w-full h-full object-cover">    
        </div>

        <!-- User Information -->
        <div>
            <!-- Name -->
            <h1 class="text-xl font-semibold"><?php echo($_SESSION['firstname'])?></h1>
            
            <!-- Username -->
            <p class="text-sm text-gray-300">@<?php echo($_SESSION['username'])?></p>
      <input type="hidden" name="user-id" id="user-id" value="<?php echo($_SESSION['username'])?>">
            
        </div>
    </div>

    <!-- Application Title -->
    <div>
    <button id='showSignoutAlert' type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Log Out</button>
    </div>
</header>
    
<ul id="friendsList" class="divide-y divide-gray-300">
    <!-- Friends will be dynamically added here -->
</ul>

    <div class="fixed bottom-0 right-0 p-4 ">
        <button class="bg-green-500 text-white px-4 py-2 rounded-full" id="openModalBtn">
            <i class="fas fa-plus mr-2"></i>
            Search for a new friend
        </button>
    </div>

    <!-- The Modal -->
<div id="searche-new-friend" class="modal hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
  <!-- Modal content -->
  <div class="modal-content bg-white p-6 rounded shadow-lg w-3/4 md:w-2/3 lg:w-1/2 xl:w-1/3">
    <span id="closeModalBtn" class="close text-3xl cursor-pointer absolute top-2 right-4">&times;</span>
    
    <!-- Search Input with Placeholder -->
    <div class="mb-4">
      <label for="friendSearch" class="block text-lg font-semibold text-blue-500 mb-2">Find New Friends</label>
      <input type="text" id="friendSearch" name="friendSearch" placeholder="Search for friends..." class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
    </div>

    <!-- Container/List of Users -->
    <div id="userList" class="mb-4 p-4 max-h-48 overflow-y-auto border rounded-md">
      <!-- User list will be dynamically populated here -->
    </div>
  </div>
</div>

<!-- The signout alert container (initially hidden) -->
<div id="signoutAlert" class="fixed top-0 left-0 w-full h-full bg-gray-50 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <p class="text-gray-800">Are you sure you want to sign out?</p>

        <div class="mt-4 flex justify-end">
            <!-- Cancel Button -->
            <button id="cancelBtn" class="px-4 py-2 mr-2 bg-green-500 text-white rounded hover:bg-green-600 focus:outline-none focus:shadow-outline-green">
                Cancel
            </button>

            <!-- Logout Button -->
            <button class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 focus:outline-none focus:shadow-outline-gray" id="log-out-confirm">
                Logout
            </button>
        </div>
    </div>
</div>



    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
