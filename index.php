<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CodeCraft - A New Way to Learn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      rel="icon"
      type="image/x-icon"
      href="assets/img/background/fav-logo.png"
    />
    <style>
      @keyframes jump {
        0%,
        100% {
          transform: translateY(0);
        }
        50% {
          transform: translateY(-20px);
        }
      }

      .jump-animation {
        animation: jump 3s infinite;
      }
    </style>
  </head>
  <body
    class="bg-[url('assets/img/background/Mask.png')] bg-center bg-cover bg-no-repeat bg-fixed"
  >
    <header class="flex items-center justify-between px-8 py-4">
      <h1
        class="text-3xl font-bold text-purple-600"
        style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5)"
      >
        Code<span
          class="text-white"
          style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5)"
          >Craft</span
        >
      </h1>
      <nav class="flex items-center justify-between space-x-6">
        <a href="#" class="text-gray-500 hover:text-gray-800">Practice</a>
        <a href="#" class="text-gray-500 hover:text-gray-800">Explore</a>
        <a href="login.php" class="text-gray-500 hover:text-purple-600"
          >Login</a
        >
        <a href="signup.php">
          <button
            class="px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-bold rounded-full"
          >
            Sign Up
          </button>
        </a>
      </nav>
    </header>

    <main class="text-center py-16">
      <section
        class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center px-4"
      >
        <!-- Left Part -->
        <div>
          <h2 class="text-5xl font-bold text-gray-100">
            <span
              class="text-5xl font-bold bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent"
            >
              A
            </span>
            New Way
            <span
              class="text-5xl font-bold bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent"
              >To <br />
              Learn</span
            >
          </h2>
          <p class="mt-4 text-gray-600">
            Code Craft Is The Best Platform To Help You Enhance Your Skills,
            Expand Your Knowledge And Prepare For Technical Interviews.
          </p>
          <a href="signup.php">
            <button
              class="mt-6 px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-500 text-white rounded-full"
            >
              Create Account
            </button>
          </a>
        </div>

        <!-- Right Part -->
        <div class="relative flex justify-center items-center">
          <img
            src="assets/img/background/bg1.png"
            alt="Learning Illustration"
            class="rounded-lg shadow-lg"
          />
          <!-- Floating Buttons -->
          <button
            class="absolute top-10 left-12 px-4 py-2 bg-white text-purple-600 font-semibold rounded-lg shadow-lg cursor"
          >
            Test
          </button>
          <button
            class="absolute bottom-8 right-10 px-4 py-2 bg-white text-purple-600 font-semibold rounded-lg shadow-lg"
          >
            Courses
          </button>

          <!-- Decorative Circles -->
          <div
            class="absolute top-10 left-24 w-16 h-16 border-8 border-purple-300 rounded-full jump-animation"
          ></div>
          <div
            class="absolute -bottom-10 right-20 w-16 h-16 border-8 border-pink-300 rounded-full jump-animation"
          ></div>
        </div>
      </section>

      <section class="mt-20 px-8">
        <div class="grid grid-cols-2 gap-8 items-center">
          <div
            class="w-full h-64 rounded-lg bg-[url('assets/img/background/pana.png')] bg-center bg-contain bg-no-repeat"
          ></div>

          <div class="text-left w-3/4">
            <h3
              class="text-3xl font-bold text-purple-600 bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent"
            >
              Companies & Candidates
            </h3>
            <p class="mt-4 text-gray-600">
              Not only does CodeCraft prepare candidates for technical
              interviews, we also help companies identify top technical talent.
            </p>
            <button
              class="mt-6 px-6 py-3 bg-purple-600 text-white bg-gradient-to-r from-purple-600 to-pink-500 text-white rounded-full"
            >
              Business Opportunities
            </button>
          </div>
        </div>
      </section>
      <section class="mt-20 px-8">
        <div class="flex justify-center items-center h-full">
          <div
            class="grid grid-cols-2 gap-4 items-center w-full max-w-screen-lg"
          >
            <!-- Left Text Section (75% width) -->
            <div class="text-right w-3/4">
              <h3
                class="text-3xl font-bold text-purple-600 text-left bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent"
              >
                Questions, Community & Contests
              </h3>
              <p class="mt-4 text-gray-600 text-left">
                Over 2800 questions for you to practice. Come and join one of
                the largest tech communities with hundreds of thousands of
                active users.
              </p>
              <div class="w-full text-left">
                <button
                  class="mt-6 px-6 py-3 bg-purple-600 text-white bg-gradient-to-r from-purple-600 to-pink-500 text-purple-600 rounded-full"
                >
                  View Questions
                </button>
              </div>
            </div>

            <!-- Right Image Section (25% width) -->
            <div
              class="w-full h-64 rounded-lg bg-[url('assets/img/background/pana2.png')] bg-center bg-contain bg-no-repeat"
            >
              <!-- Image Background -->
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer class="mt-20 bg-gray-100 py-8">
      <div class="max-w-6xl mx-auto grid grid-cols-2 gap-8 px-8">
        <div>
          <h4 class="text-xl font-bold text-gray-800">CodeCraft</h4>
          <address class="mt-4 text-gray-600">
            Level 1, Sample St, Sydney NSW 2000<br />
            Contact: 1800 123 4567<br />
            Email: info@codecraft.io
          </address>
          <div class="mt-4 flex space-x-4">
            <a href="#" class="text-purple-600">Facebook</a>
            <a href="#" class="text-purple-600">Twitter</a>
            <a href="#" class="text-purple-600">Instagram</a>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <h5 class="text-lg font-bold text-gray-800">Quick Links</h5>
            <ul class="mt-2 text-gray-600">
              <li><a href="#" class="hover:text-purple-600">About Us</a></li>
              <li>
                <a href="#" class="hover:text-purple-600">Privacy Policy</a>
              </li>
              <li><a href="#" class="hover:text-purple-600">Careers</a></li>
              <li><a href="#" class="hover:text-purple-600">Contact Us</a></li>
            </ul>
          </div>
          <div>
            <h5 class="text-lg font-bold text-gray-800">Resources</h5>
            <ul class="mt-2 text-gray-600">
              <li><a href="#" class="hover:text-purple-600">Courses</a></li>
              <li><a href="#" class="hover:text-purple-600">Tests</a></li>
              <li>
                <a href="#" class="hover:text-purple-600">How to Begin?</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <p class="mt-8 text-center text-gray-600">
        © 2022 CodeCraft. All rights reserved.
      </p>
    </footer>
  </body>
</html>
