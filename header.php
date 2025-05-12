<?php // header.php - Header File ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Custom scrollbar for better aesthetics (optional) */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>
<body class="bg-slate-50">
    <header class="bg-indigo-700 shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="index.php" class="text-2xl font-bold text-white">Campus Hub</a>
            <nav class="hidden md:flex items-center"> 
                <ul class="flex items-center space-x-6"> 
                    <li><a href="index.php" class="text-indigo-200 hover:text-white transition duration-300">Home</a></li>
                    <li><a href="#about" class="text-indigo-200 hover:text-white transition duration-300 nav-link">About</a></li>
                    <li><a href="#contact" class="text-indigo-200 hover:text-white transition duration-300 nav-link">Contact</a></li>

                    <?php
                        // Example: Assume $is_logged_in is set somewhere (e.g., session check)
                        // session_start(); // Needed if using sessions
                        // $is_logged_in = isset($_SESSION['user_id']); // Example check

                        $is_logged_in = false; // Set to false for now to show Log in/Sign up

                        if ($is_logged_in) {
                            // Show Profile/Logout if logged in
                            echo '<li><a href="profile.php" class="text-indigo-200 hover:text-white transition duration-300">Profile</a></li>';
                            echo '<li><a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded transition duration-300">Log out</a></li>';
                        } else {
                            // Show Log in/Sign up if not logged in
                            echo '<li><a href="login.php" class="text-indigo-200 hover:text-white transition duration-300">Log in</a></li>';
                            echo '<li><a href="signup.php" class="bg-white text-indigo-700 font-medium px-4 py-1 rounded hover:bg-indigo-100 transition duration-300">Sign up</a></li>';
                        }
                    ?>
                </ul>
            </nav>
            <button id="mobile-menu-button" class="md:hidden text-indigo-200 hover:text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
     
        <div id="mobile-menu" class="md:hidden hidden bg-indigo-700">
             <ul class="flex flex-col items-center space-y-3 py-4"> 
                <li><a href="index.php" class="block py-2 px-4 text-base text-indigo-200 hover:bg-indigo-600 hover:text-white rounded transition duration-300">Home</a></li>
                <li><a href="#about" class="block py-2 px-4 text-base text-indigo-200 hover:bg-indigo-600 hover:text-white rounded transition duration-300 nav-link">About</a></li>
                <li><a href="#contact" class="block py-2 px-4 text-base text-indigo-200 hover:bg-indigo-600 hover:text-white rounded transition duration-300 nav-link">Contact</a></li>
                <li class="pt-2"> 
                <?php
                    if ($is_logged_in) {
                         // Show Profile/Logout if logged in (Mobile)
                         echo '<a href="profile.php" class="block w-full text-center py-2 px-4 text-base text-indigo-200 hover:bg-indigo-600 hover:text-white rounded transition duration-300">Profile</a></li>';
                         echo '<li><a href="logout.php" class="block w-full text-center py-2 px-4 text-base bg-red-500 hover:bg-red-600 text-white rounded transition duration-300 mt-2">Log out</a>';

                    } else {
                        // Show Log in/Sign up if not logged in (Mobile)
                        echo '<a href="login.php" class="block w-full text-center py-2 px-4 text-base text-indigo-200 hover:bg-indigo-600 hover:text-white rounded transition duration-300">Log in</a></li>';
                        echo '<li><a href="signup.php" class="block w-full text-center py-2 px-4 text-base bg-white text-indigo-700 font-medium rounded hover:bg-indigo-100 transition duration-300 mt-2">Sign up</a>';
                    }
                ?>
                </li>
            </ul>
        </div>
    </header>
    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const desktopNav = document.querySelector('header nav'); // Get desktop nav

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                // Optional: hide desktop nav if screen is small and menu button is shown
                // This might not be necessary depending on your exact layout needs
                // if (desktopNav && !mobileMenu.classList.contains('hidden')) {
                //    desktopNav.classList.add('hidden');
                // } else if (desktopNav) {
                //    desktopNav.classList.remove('hidden');
                // }
            });
        }

        // Close mobile menu when a link is clicked
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            });
        });

         // Make sure desktop nav is visible when resizing from mobile to desktop
         window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) { // Tailwind's 'md' breakpoint
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                     mobileMenu.classList.add('hidden'); // Hide mobile menu on resize to desktop
                }
                 if (desktopNav && desktopNav.classList.contains('hidden')) {
                    // Only remove hidden if it was added by md:flex initially
                    // This assumes you use md:flex on the nav element
                    desktopNav.classList.remove('hidden');
                 }
            } else {
                 // Optional: ensure desktop nav is hidden if below md breakpoint
                 // if (desktopNav && !desktopNav.classList.contains('hidden')) {
                 //    desktopNav.classList.add('hidden');
                 // }
            }
         });

         // Initial check in case the page loads on desktop view
         if (window.innerWidth >= 768) {
             if (desktopNav && desktopNav.classList.contains('hidden')) {
                desktopNav.classList.remove('hidden');
             }
         }

    </script>
    <?php // The rest of your page content would go here ?>
</body>
</html>