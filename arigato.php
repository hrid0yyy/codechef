<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="assets/img/background/fav-logo.png">
    <title>Thankyou | CodeCraft</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400..800&display=swap');

*{
 
    font-family: "Syne", serif;
    font-optical-sizing: auto;
    
    font-style: normal;
  
} 
    </style>
</head>
<body class="bg-[url('Mask.png')] bg-cover bg-center bg-no-repeat min-h-screen bg-gray-50 font-sans">

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-1/5 shadow-lg flex flex-col justify-between h-screen sticky top-0">
            <div class="p-6">
                <!-- Logo -->
                <div class="text-2xl font-bold text-purple-600 mb-10">
                    <img src="assets/img/background/s-logo.png" alt="Dashboard logo">
                </div>

                <!-- Menu Links -->
                <nav class="space-y-6">
                    <a href="#" class="flex items-center space-x-4 text-purple-600">
                        <img src="assets/img/background/document-active.png" width="20px" alt="Dashboard Icon">
                        <span>Dashboard</span>
                    </a>
                    <a href="#" class="flex items-center space-x-4">
                        <img src="assets/img/background/test-active.png"  width="20px" alt="Tests Icon">
                        <span>Tests</span>
                    </a>
                    <a href="#" class="flex items-center space-x-4">
                        <img src="assets/img/background/document.png"  width="20px" alt="Courses Icon">
                        <span>Courses</span>
                    </a>
                    <a href="#" class="flex items-center space-x-4">
                        <img src="assets/img/background/dp.png"  width="20px" alt="Profile Icon">
                        <span>Profile</span>
                    </a>
                    <a href="#" class="flex items-center space-x-4">
                        <img src="assets/img/background/leaderboard.png"  width="20px" alt="Leaderboard Icon">
                        <span>Leaderboard</span>
                    </a>
                    <a href="#" class="flex items-center space-x-4">
                        <img src="assets/img/background/dark.png"  width="20px" alt="Dark Mode Icon">
                        <span>Dark Mode</span>
                    </a>
                </nav>
            </div>

            <div class="p-6 space-y-6">
                <!-- Bottom Links -->
                <a href="#" class="flex items-center space-x-4">
                    <img src="assets/img/background/setting.png" width="20px" alt="Settings Icon">
                    <span>Settings</span>
                </a>
                <a href="#" class="flex items-center space-x-4">
                    <img src="assets/img/background/logout.png" width="20px" alt="Logout Icon">
                    <span>Log Out</span>
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 p-8">
            <!-- Header -->
            <header class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold">Tests For You!</h1>
                <div class="flex items-center space-x-4">
                    <div class="relative flex items-center">
                        <img src="assets/img/background/search.png" alt="Search Icon" class="absolute left-3 w-4 h-4">
                        <input type="text" placeholder="Search" class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-full">
                    </div>
                    <img src="assets/img/background/Bell.png" width="20px" alt="Notification Icon" class="cursor-pointer">
                    <img src="https://via.placeholder.com/40" alt="Profile Icon" class="rounded-full cursor-pointer">
                </div>
            </header>

            <!-- Top Row -->
            <div class="flex justify-between items-center p-6 max-w-screen-lg mx-auto">
                <div class="flex items-center space-x-4">
                    <!-- Logo -->
                    <img src="assets/img/background/c-logo.png" alt="Logo" class="md:w-[150px] h-auto">
                </div>
                <div class="text-center flex flex-col items-center">
                    <!-- Company Title and Subtitle -->
                    <h1 class="text-xl font-semibold">TCS Quiz Competition</h1>
                    <p class="text-sm text-gray-200">TCS Campus Drive-2023</p>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Timer Icon and Text -->
                    <img src="assets/img/background/time-lg.png" alt="Timer Icon" class="w-8 h-8">
                    <span class="text-lg text-purple-600">00:00:00</span>
                </div>
            </div>

            <!-- Center Box -->
            <div class="flex justify-center items-center mt-10">
                <div class="w-full bg-white p-6 rounded-lg border border-gray-300 shadow-lg max-w-screen-lg mx-auto space-y-6">
                    <!-- 1st Row: Heading Text -->
                    <div class="text-center">
                        <h2 class="text-2xl font-semibold">Thanks For Participating</h2>
                    </div>
                    <!-- 2nd Row: Subheading Text -->
                    <div class="text-center">
                        <h3 class="text-lg text-gray-600">Your Test has completed!</h3>
                    </div>
                    <!-- 3rd Row: Image -->
                    <div class="flex justify-center">
                        <img src="assets/img/background/arigato.png" width="250px" alt="Image" class="rounded-md">
                    </div>
                    <!-- 4th Row: Text under the Image -->
                    <div class="text-center">
                        <p class="text-gray-500">You will be notified when your test results are released.</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
