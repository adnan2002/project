<?php
// login.php
// Start session
// session_start();

// Include your header file
include 'header.php';

// --- PHP Logic for form submission and error display would go here ---
// Example:
// $error_message = '';
// $email_input = '';
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $email_input = htmlspecialchars(trim($_POST['email']));
//     $password_input = trim($_POST['password']);

//     // Authenticate user (check database, verify password)
//     // if (authentication_successful) {
//     //     $_SESSION['user_id'] = $user_id_from_db;
//     //     $_SESSION['user_email'] = $email_input;
//     //     header("Location: index.php"); // or dashboard.php
//     //     exit();
//     // } else {
//     //     $error_message = "Invalid email address or password.";
//     // }
// }

// // Check for signup success message
// if (isset($_GET['signup']) && $_GET['signup'] === 'success') {
//    $success_message = "Account created successfully! Please log in.";
// }
?>

<main class="bg-slate-50 min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
             <a href="index.php" class="text-indigo-600 hover:text-indigo-500 inline-flex items-center mb-6 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                Back to Home
            </a>
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Welcome Back</h1>
            <p class="mt-2 text-sm text-gray-600">Log in to your Campus Hub account.</p>
        </div>

        <?php // if (!empty($success_message)): ?>
            <?php // endif; ?>

        <?php // if (!empty($error_message)): ?>
            <?php // endif; ?>

        <div class="bg-white p-8 shadow-xl rounded-lg">
            <form action="login.php" method="POST" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-gray-400">
                                <path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                                <path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                            </svg>
                        </div>
                        <input type="email" name="email" id="email" required
                               class="block w-full pl-10 pr-3 py-2 border <?php // echo !empty($error_message) ? 'border-red-500' : 'border-gray-300'; ?> rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="john.doe@university.edu" value="<?php // echo $email_input ?? ''; ?>">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="text-sm">
                            <a href="forgot-password.php" class="font-medium text-indigo-600 hover:text-indigo-500">
                                Forgot password?
                            </a>
                        </div>
                    </div>
                    <div class="relative rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-gray-400">
                               <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="password" name="password" id="password" required
                               class="block w-full pl-10 pr-3 py-2 border <?php // echo !empty($error_message) ? 'border-red-500' : 'border-gray-300'; ?> rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox"
                           class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                </div>

                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Sign in
                    </button>
                </div>
            </form>



            <p class="mt-8 text-center text-sm text-gray-600">
                Don't have an account?
                <a href="signup.php" class="font-medium text-indigo-600 hover:text-indigo-500">Sign up</a>
            </p>
        </div>
    </div>
</main>

<?php
// Include your footer file if you have one
include 'footer.php';
?>