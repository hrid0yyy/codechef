<?php session_start(); ?>
<?php if (isset($_SESSION['signup_error'])): ?>
    <div class="bg-red-500 text-white p-3 rounded mb-4">
        <?php
        echo $_SESSION['signup_error'];
        unset($_SESSION['signup_error']);
        ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['signup_success'])): ?>
    <div class="bg-green-500 text-white p-3 rounded mb-4">
        <?php
        echo $_SESSION['signup_success'];
        unset($_SESSION['signup_success']);
        ?>
    </div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up | CodeCraft</title>
    <link
      rel="icon"
      type="image/x-icon"
      href="assets/img/background/fav-logo.png"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      .rounded-border {
        border-radius: 25px;
      }
      @keyframes bounce-slow {
        0%,
        100% {
          transform: translateY(-5px);
        }
        50% {
          transform: translateY(5px);
        }
      }
      .animate-bounce-slow {
        animation: bounce-slow 2s infinite;
      }
      .circle {
        position: relative;
        top: -15rem;
        left: 5rem;
        z-index: -5;
      }
      .circle2 {
        position: relative;
        top: 15rem;
        left: 23rem;
        z-index: -5;
      }
      .btn {
        border-radius: 30px;
      }
    </style>
  </head>
  <body class="bg-[url('Mask.png')] bg-cover bg-center bg-no-repeat">
    <nav class="w-full fixed top-0 z-50 mb-10">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <img
              class="mx-auto"
              src="assets/img/background/logo.png"
              width="200px"
              alt=""
            />
          </div>
          <div class="hidden md:flex items-center space-x-6">
            <a href="#" class="text-gray-700 hover:text-purple-600">Home</a>
            <a href="#" class="text-gray-700 hover:text-purple-600">Practice</a>
            <a href="#" class="text-gray-700 hover:text-purple-600">Explore</a>
            <a href="login.php" class="text-gray-700 hover:text-purple-600"
              >Login</a
            >
            <a
              href="#"
              class="text-purple-600 px-4 py-2 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 text-white"
              >Sign Up</a
            >
          </div>
        </div>
      </div>
    </nav>
    <div
      class="flex flex-col md:flex-row h-screen items-center justify-center mt-5"
    >
      <!-- Left Section -->
      <div class="w-full md:w-1/2 flex justify-center items-center p-5">
        <div class="relative">
          <img
            src="assets/img/background/rb_9814.png"
            alt="Placeholder Image"
            class="rounded-lg"
          />
        </div>
      </div>

      <!-- Right Section -->
      <div
        class="circle w-16 h-16 border-8 border-purple-300 rounded-full animate-bounce-slow shadow"
      ></div>
      <div
        class="circle2 w-16 h-16 border-8 border-purple-300 rounded-full animate-bounce-slow shadow"
      ></div>

      <div
        class="w-full md:h-[500px] md:w-[350px] bg-white shadow-lg p-8 rounded-border"
      >
        <div class="text-center mb-4">
          <img
            class="mx-auto"
            src="assets/img/background/logo.png"
            width="200px"
            alt=""
          />
        </div>

        <form action="backend/signup.php" method="POST">
          <div class="mb-4">
            <label for="username" class="block text-gray-600"></label>
            <input
              type="text"
              id="username"
              name="username"
              class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-300"
              placeholder="Enter your username"
              required
            />
          </div>
          <div class="mb-6">
            <label for="email" class="block text-gray-600"></label>
            <input
              type="email"
              id="email"
              name="email"
              class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-300"
              placeholder="Enter your email"
              required
            />
          </div>
          <div class="mb-4">
            <label for="password" class="block text-gray-600"></label>
            <input
              type="password"
              id="password"
              name="password"
              class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-300"
              placeholder="Enter your password"
              required
            />
          </div>
          <input type="hidden" name="user_type" value="coder" />
          <button
            type="submit"
            class="w-full text-white py-2 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-purple-700"
          >
            Register
          </button>
        </form>

        <div class="mt-2 flex justify-center space-x-5">
          <p>Have an account?</p>
          <a href="login.php" class="text-purple-600 hover:underline">Log In</a>
        </div>
       
        <div class="mt-2 text-center">
          <p class="text-gray-600">Or you can sign up with:</p>
          <div class="flex justify-center space-x-4 mt-2">
            <a
              href="#"
              class="bg-gray-100 p-3 rounded-full shadow hover:bg-gray-200"
            >
              <img
                src="https://cdn-icons-png.flaticon.com/512/2991/2991148.png"
                alt="Google"
                class="w-6 h-6"
              />
            </a>
            <a
              href="#"
              class="bg-gray-100 p-3 rounded-full shadow hover:bg-gray-200"
            >
              <img
                src="https://cdn-icons-png.flaticon.com/512/733/733553.png"
                alt="GitHub"
                class="w-6 h-6"
              />
            </a>
            <a
              href="#"
              class="bg-gray-100 p-3 rounded-full shadow hover:bg-gray-200"
            >
              <img
                src="https://cdn-icons-png.flaticon.com/512/145/145802.png"
                alt="Facebook"
                class="w-6 h-6"
              />
            </a>
          </div>
        </div>
        <p class="text-xs text-gray-400 text-center">
          This site is protected by reCAPTCHA and the Google Privacy Policy and
          Terms of Service apply.
        </p>
      </div>
    </div>
      
  </body>
 
   
</html>
