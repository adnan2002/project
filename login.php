<?php
// login.php (Frontend Page)

// header.php will start the session.
// If you need to do session checks *before* any output from header.php,
// you'd put session_start() here. But since header.php now handles it,
// we can include it first.
include 'header.php'; // This already calls session_start()

// Check if user is already logged in (session started by header.php)
if (isset($_SESSION['user_id'])) {
    header('Location: index.php'); // Redirect to home page
    exit; // Important to prevent further script execution
}
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

        <div id="loginMessage" class="mb-4 text-center">
            </div>

        <div class="bg-white p-8 shadow-xl rounded-lg">
            <form id="loginForm" class="space-y-6"> 
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
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="john.doe@university.edu">
                    </div>
                    <span id="emailError" class="text-red-500 text-xs mt-1"></span>
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
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="••••••••">
                    </div>
                     <span id="passwordError" class="text-red-500 text-xs mt-1"></span>
                </div>

                

                <div>
                    <button type="submit" id="signInButton"
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const loginMessage = document.getElementById('loginMessage'); // For general messages
    const signInButton = document.getElementById('signInButton');

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();
        signInButton.disabled = true;
        signInButton.textContent = 'Signing in...';
        loginMessage.textContent = ''; // Clear previous messages
        emailError.textContent = '';
        passwordError.textContent = '';

        const email = emailInput.value.trim();
        const password = passwordInput.value; // No trim for password

        let isValid = true;
        if (email === '') {
            emailError.textContent = 'Email is required.';
            isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { // Simple email format check
            emailError.textContent = 'Please enter a valid email address.';
            isValid = false;
        }

        if (password === '') {
            passwordError.textContent = 'Password is required.';
            isValid = false;
        }

        if (!isValid) {
            signInButton.disabled = false;
            signInButton.textContent = 'Sign in';
            return;
        }

        const formData = {
            email: email,
            password: password
        };

        fetch('api/v1/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json().then(data => ({ status: response.status, ok: response.ok, body: data })))
        .then(result => {
            console.log('Login API Response:', result);
            if (result.ok && result.status === 200) {
                loginMessage.innerHTML = `<p class="text-green-600">${result.body.message || 'Login successful! Redirecting...'}</p>`;
                // Redirect to index.php after successful login
                window.location.href = 'index.php';
            } else {
                // Display error message from API
                let errorMessage = result.body.error || 'An unknown error occurred. Please try again.';
                if (result.status === 401) { // Incorrect password
                    passwordError.textContent = errorMessage;
                } else if (result.status === 404) { // Email not found
                    emailError.textContent = errorMessage;
                } else { // Other errors (400, 500)
                    loginMessage.innerHTML = `<p class="text-red-600">${errorMessage}</p>`;
                }
            }
        })
        .catch(error => {
            console.error('Login Fetch Error:', error);
            loginMessage.innerHTML = '<p class="text-red-600">An unexpected network error occurred. Please try again.</p>';
        })
        .finally(() => {
            // Re-enable button unless already redirected
            if (window.location.pathname.endsWith('login.php')) { // Check if still on login page
                 signInButton.disabled = false;
                 signInButton.textContent = 'Sign in';
            }
        });
    });
});
</script>

<?php
// Include your footer file if you have one
include 'footer.php';
?>
