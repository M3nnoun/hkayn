<?php
include __DIR__ . '/back-end/check_session.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile Setup</title>
    
    <link
      href="./assets/css/tailwind.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/set-up-profile.css" />
    <script src="assets/jQuery/jQuery.js"></script>
    <script src="assets/js/set-up-profile.js"></script>
  </head>

  <body>
    <div class="card bg-white p-8 rounded-md shadow-md">
      <div class="text-center mb-6">
        <h1 class="text-2xl font-semibold">Profile Setup</h1>
      </div>
      <input type="hidden" name="user-id" id="user-id" value="<?php echo($_SESSION['username'])?>">
      <!-- Step 1: Confirm Email -->
      <div id="step1" class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Step 1: Confirm Email</h2>
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-600"
            >Email</label
          >
          <input
            type="email"
            id="email"
            name="email"
            class="mt-1 p-2 w-full border rounded-md"
          />
        </div>
        <button
          onclick="nextStep(1)"
          class="w-full bg-blue-500 text-white p-2 rounded-md"
          id="openModalBtn"
        >
          Continue
        </button>
      </div>

      <!-- Step 2: Add Image -->
      <div id="step2" class="hidden mb-6">
        <h2 class="text-lg font-semibold mb-2">Step 2: Add Image</h2>
        <div class="mb-4">
          <form id="imageUploadForm" enctype="multipart/form-data">
            <label for="image" class="block text-sm font-medium text-gray-600"
              >Image</label
            >
            <input
              type="file"
              id="image"
              name="image"
              accept="image/*"
              class="mt-1 p-2 w-full border rounded-md"
            />
          </form>
        </div>
        <div class="flex justify-between">
          <button
            onclick="prevStep()"
            class="w-1/2 bg-gray-300 text-gray-700 p-2 rounded-md"
          >
            Back
          </button>
          <button
            id="uploadButton"
            class="w-1/2 bg-blue-500 text-white p-2 rounded-md ml-2"
          >
            Continue
          </button>
        </div>
      </div>

      <!-- Step 3: Looking for Friends -->
<div id="step3" class="hidden mb-6">
  <h2 class="text-lg font-semibold mb-2">Step 3: Looking for Friends</h2>

  <!-- User Profile Circle and First Name -->
  <div class="flex items-center mb-4">
    <!-- User Profile Image Circle -->
    <div class="rounded-full overflow-hidden h-12 w-12">
      <!-- Replace the following with the user's profile image -->
      <img src="uploads/Default_pfp.svg" alt="User Profile" class="w-full h-full object-cover" id="profileImage">
    </div>

    <!-- User's First Name -->
    <div class="ml-3">
      <p class="text-md font-medium text-gray-800"><?php echo($_SESSION['firstname'])?></p>
    </div>
  </div>

  <!-- Search for Friends Input -->
  <div class="mb-4">
    <label for="friendSearch" class="block text-sm font-medium text-gray-600">Search for Friends</label>
    <input type="text" id="friendSearch" name="friendSearch" class="mt-1 p-2 w-full border rounded-md">
  </div>

  <!-- Container/List of Users -->
  <div id="userList" class="mb-4 p-4 max-h-48 overflow-y-auto">
    <!-- User list will be dynamically populated here -->
</div>

  <!-- Navigation Buttons -->
  <div class="flex justify-between">
    <button onclick="prevStep()" class="w-1/2 bg-gray-300 text-gray-700 p-2 rounded-md">Back</button>
    <button id="finish-btn" class="w-1/2 bg-green-500 text-white p-2 rounded-md ml-2">Finish</button>
  </div>
</div>


      <!-- Skip Button -->
      <div class="text-center mt-4">
        <button onclick="skipSetup()" class="text-blue-500">Skip</button>
      </div>
    </div>

    <!-- Trigger Button -->
    <!-- <button
      id="openModalBtn"
      class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300"
    >
      Open Modal
    </button> -->

    <!-- Modal -->
    <div id="confirmationModal" class="modal">
      <div class="modal-content">
        <!-- Alert Message -->
        <p class="text-lg font-semibold mb-4">
          Your received a code in your email
        </p>

        <!-- Input for Confirmation Code -->
        <input
          id="user-confirmation-code"
          type="text"
          placeholder="Enter code"
          class="w-full mb-4 p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
        />

        <!-- Countdown Timer -->
        <div class="flex items-center justify-between mb-4">
          <p class="text-gray-600">
            Time remaining: <span id="countdown" class="font-bold">1:00</span>
          </p>
          <!-- You'll need JavaScript to update the countdown timer -->
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between space-x-4">
          <button
            id="sendCodeBtn"
            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300"
            disabled
          >
            Send Code Again
          </button>
          <button
            id="closeModalBtn"
            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring focus:border-gray-300"
          >
            Do It Later
          </button>
        </div>
      </div>
    </div>
  </body>
</html>
