<?php // header.php - Header File
// This MUST be called before any HTML output.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
$is_logged_in = isset($_SESSION['user_id']);
$displayName = '';

if ($is_logged_in && isset($_SESSION['first_name'])) {
    $firstName = htmlspecialchars(ucfirst(strtolower($_SESSION['first_name'])));
    $lastNameInitial = '';
    if (isset($_SESSION['last_name']) && !empty($_SESSION['last_name'])) {
        $lastNameInitial = htmlspecialchars(strtoupper(substr($_SESSION['last_name'], 0, 1))) . '.';
    }
    $displayName = $firstName . ($lastNameInitial ? ' ' . $lastNameInitial : '');
}
?>
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
        /* Styles for user dropdown */
        .user-dropdown-menu {
            display: none; /* Hidden by default */
            position: absolute;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 60; /* Ensure it's above other content, higher than sticky header's z-index */
            border-radius: 0.375rem; /* rounded-md */
            right: 0; /* Align to the right of the button */
            top: 100%; /* Position below the button */
            margin-top: 0.5rem; /* Add some space */
        }
        .user-dropdown-menu a {
            color: #374151; /* gray-700 */
            padding: 0.75rem 1rem; /* py-3 px-4 */
            text-decoration: none;
            display: block;
            font-size: 0.875rem; /* text-sm */
        }
        .user-dropdown-menu a:hover {
            background-color: #e5e7eb; /* gray-200 */
            color: #1f2937; /* gray-800 */
        }
    </style>
</head>
<body class="bg-slate-50">
    <header class="bg-indigo-700 shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="index.php" class="text-2xl font-bold text-white">Campus Hub</a>
            
            <nav class="hidden md:flex items-center relative"> 
                <ul class="flex items-center space-x-6"> 
                    <li><a href="index.php" class="text-indigo-200 hover:text-white transition duration-300">Home</a></li>
                    <li><a href="index.php#about" class="text-indigo-200 hover:text-white transition duration-300 nav-link">About</a></li>
                    <li><a href="index.php#contact" class="text-indigo-200 hover:text-white transition duration-300 nav-link">Contact</a></li>

                    <?php if ($is_logged_in): ?>
                        <li class="relative"> 
                            <button id="userMenuButtonDesktop" class="flex items-center text-indigo-200 hover:text-white focus:outline-none transition duration-300">
                                <span class="mr-1"><?php echo $displayName; ?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="userDropdownMenuDesktop" class="user-dropdown-menu">
                                <a href="profile.php" class="rounded-t-md">Profile</a>
                                <a href="logout.php" class="rounded-b-md">Log out</a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li><a href="login.php" class="text-indigo-200 hover:text-white transition duration-300">Log in</a></li>
                        <li><a href="signup.php" class="bg-white text-indigo-700 font-medium px-4 py-2 rounded hover:bg-indigo-100 transition duration-300">Sign up</a></li>
                    <?php endif; ?>
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
                <li><a href="index.php#about" class="block py-2 px-4 text-base text-indigo-200 hover:bg-indigo-600 hover:text-white rounded transition duration-300 nav-link">About</a></li>
                <li><a href="index.php#contact" class="block py-2 px-4 text-base text-indigo-200 hover:bg-indigo-600 hover:text-white rounded transition duration-300 nav-link">Contact</a></li>
                
                <?php if ($is_logged_in): ?>
                    <li class="w-full text-center relative">
                         <button id="userMenuButtonMobile" class="w-full flex items-center justify-center py-2 px-4 text-base text-indigo-200 hover:bg-indigo-600 hover:text-white rounded focus:outline-none transition duration-300">
                            <span class="mr-1"><?php echo $displayName; ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div id="userDropdownMenuMobile" class="user-dropdown-menu left-1/2 transform -translate-x-1/2 mt-1 w-auto"> 
                            <a href="profile.php" class="rounded-t-md">Profile</a>
                            <a href="logout.php" class="rounded-b-md">Log out</a>
                        </div>
                    </li>
                <?php else: ?>
                    <li><a href="login.php" class="block w-full text-center py-2 px-4 text-base text-indigo-200 hover:bg-indigo-600 hover:text-white rounded transition duration-300">Log in</a></li>
                    <li><a href="signup.php" class="block w-full text-center py-2 px-4 text-base bg-white text-indigo-700 font-medium rounded hover:bg-indigo-100 transition duration-300 mt-1">Sign up</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>
    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        // const desktopNav = document.querySelector('header nav.hidden.md\\:flex'); // More specific selector for desktop nav

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Close mobile menu when a link inside it is clicked (if it's not a dropdown toggle)
        document.querySelectorAll('#mobile-menu a:not([id^="userMenuButton"])').forEach(link => {
            link.addEventListener('click', () => {
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    // Check if the clicked link is part of a dropdown, if so, don't close main mobile menu
                    if (!link.closest('.user-dropdown-menu')) {
                         mobileMenu.classList.add('hidden');
                    }
                }
            });
        });
        
        // User dropdown toggle function
        function setupDropdown(buttonId, menuId) {
            const button = document.getElementById(buttonId);
            const menu = document.getElementById(menuId);

            if (button && menu) {
                button.addEventListener('click', (event) => {
                    event.stopPropagation();
                    // Hide other dropdowns if any are open
                    document.querySelectorAll('.user-dropdown-menu').forEach(otherMenu => {
                        if (otherMenu !== menu) {
                            otherMenu.style.display = 'none';
                        }
                    });
                    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
                });
            }
        }

        // Setup for desktop and mobile dropdowns
        setupDropdown('userMenuButtonDesktop', 'userDropdownMenuDesktop');
        setupDropdown('userMenuButtonMobile', 'userDropdownMenuMobile');

        // Close all dropdowns if clicked outside
        window.addEventListener('click', (event) => {
            let clickedOnDesktopButton = document.getElementById('userMenuButtonDesktop')?.contains(event.target);
            let clickedOnMobileButton = document.getElementById('userMenuButtonMobile')?.contains(event.target);

            if (!clickedOnDesktopButton && !clickedOnMobileButton) {
                 document.querySelectorAll('.user-dropdown-menu').forEach(menu => {
                    if (!menu.contains(event.target)) { // Also check if click is inside an open menu
                        menu.style.display = 'none';
                    }
                });
            }
        });



    </script>
    <?php // The rest of your page content would be included by the specific page (e.g., index.php, signup.php) after this header. ?>
