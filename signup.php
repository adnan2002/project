<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: index.php'); // Redirect to home page
    exit; // Important to prevent further script execution
}

include 'header.php';
?>

<main class="bg-slate-50 min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-2xl">
        <div class="text-center mb-8">
            <a href="index.php" class="text-indigo-600 hover:text-indigo-500 inline-flex items-center mb-6 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                Back to Home
            </a>
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Create Your Campus Hub Account</h1>
            <p class="mt-2 text-sm text-gray-600">Join your campus community to access all features.</p>
        </div>

        <div class="bg-white p-8 shadow-xl rounded-lg">
            <form id="signupForm" action="signup.php" method="POST" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-gray-400">
                                    <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                                </svg>
                            </div>
                            <input type="text" name="first_name" id="first_name"
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                   placeholder="John">
                        </div>
                        <span id="firstNameError" class="text-red-500 text-xs mt-1"></span>
                    </div>

                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-gray-400">
                                    <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                                </svg>
                            </div>
                            <input type="text" name="last_name" id="last_name"
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                   placeholder="Doe">
                        </div>
                        <span id="lastNameError" class="text-red-500 text-xs mt-1"></span>
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-gray-400">
                                <path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                                <path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                            </svg>
                        </div>
                        <input type="email" name="email" id="email"
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="john.doe@university.edu">
                    </div>
                    <span id="emailError" class="text-red-500 text-xs mt-1"></span>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-gray-400">
                                <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="password" name="password" id="password"
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="••••••••">
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Must be at least 8 characters with a number and special character.</p>
                    <span id="passwordError" class="text-red-500 text-xs mt-1"></span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                    <div>
                        <label for="university_id" class="block text-sm font-medium text-gray-700 mb-1">University ID</label>
                        <input type="text" name="university_id" id="university_id"
                               class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="ID12345678">
                        <span id="universityIdError" class="text-red-500 text-xs mt-1"></span>
                    </div>
                </div>

                <div>
                    <label for="major" class="block text-sm font-medium text-gray-700 mb-1">Major</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-gray-400">
                                <path d="M3.5 2.75a.75.75 0 00-1.5 0v14.5a.75.75 0 001.5 0v-.585a3.001 3.001 0 015.285-1.952.75.75 0 001.43 0 3.001 3.001 0 015.285 1.952V17.25a.75.75 0 001.5 0V2.75a.75.75 0 00-1.5 0v.585a3.001 3.001 0 01-5.285 1.952.75.75 0 00-1.43 0A3.001 3.001 0 013.5 3.335V2.75z" />
                            </svg>
                        </div>
                        <input type="text" name="major" id="major"
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="Computer Science">
                    </div>
                    <span id="majorError" class="text-red-500 text-xs mt-1"></span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="academic_level" class="block text-sm font-medium text-gray-700 mb-1">Academic Level</label>
                        <select id="academic_level" name="academic_level"
                                class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select your level</option>
                            <option value="Freshman">Freshman</option>
                            <option value="Sophomore">Sophomore</option>
                            <option value="Junior">Junior</option>
                            <option value="Senior">Senior</option>
                            <option value="Graduate">Graduate</option>
                        </select>
                        <span id="academicLevelError" class="text-red-500 text-xs mt-1"></span>
                    </div>
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                        <div class="relative rounded-md shadow-sm">
                            <input type="text" name="date_of_birth" id="date_of_birth"
                                   class="block w-full pr-10 pl-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                   placeholder="dd/mm/yyyy">
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-gray-400">
                                    <path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zM4.5 6.75A1.25 1.25 0 015.75 5.5h8.5A1.25 1.25 0 0115.5 6.75v1.25H4.5V6.75zM4.5 9.5v5.75A1.25 1.25 0 005.75 16.5h8.5A1.25 1.25 0 0015.5 15.25V9.5H4.5z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <span id="dobError" class="text-red-500 text-xs mt-1"></span>
                    </div>
                </div>

                <div>
                    <button id="submitButton" type="submit"
                            class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                        Create Account
                    </button>
                </div>
                <p class="mt-8 text-center text-sm text-gray-600">
                    Already have an account?
                    <a href="login.php" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Log in
                    </a>
                </p>
            </form>
        </div>
    </div>
</main>

<script>
    async function hashPassword(password) {
    if (!password) return null; // Or handle as empty string hash if preferred
    if (!crypto || !crypto.subtle || !crypto.subtle.digest) {
        console.warn('SubtleCrypto API not available. Password will not be hashed for logging.');
        return password; // Fallback to plain password if API not available
    }
    try {
        const encoder = new TextEncoder();
        const data = encoder.encode(password);
        const hashBuffer = await crypto.subtle.digest('SHA-256', data);
        const hashArray = Array.from(new Uint8Array(hashBuffer)); // Convert buffer to byte array
        const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join(''); // Convert bytes to hex string
        return hashHex;
    } catch (error) {
        console.error('Error hashing password:', error);
        return password; // Fallback in case of error
    }
}
    document.addEventListener('DOMContentLoaded', function () {
        const signupForm = document.getElementById('signupForm');
        const firstNameInput = document.getElementById('first_name');
        const lastNameInput = document.getElementById('last_name');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const universityIdInput = document.getElementById('university_id');
        const majorInput = document.getElementById('major');
        const academicLevelInput = document.getElementById('academic_level');
        const dobInput = document.getElementById('date_of_birth');
        const submitButton = document.getElementById('submitButton');

        const firstNameError = document.getElementById('firstNameError');
        const lastNameError = document.getElementById('lastNameError');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');
        const universityIdError = document.getElementById('universityIdError');
        const majorError = document.getElementById('majorError');
        const academicLevelError = document.getElementById('academicLevelError');
        const dobError = document.getElementById('dobError');

        const validators = {
            first_name: {
                input: firstNameInput,
                errorElement: firstNameError,
                regex: /^[A-Za-z]+$/,
                errorMessage: 'First name can only contain letters.',
                isValid: false,
                isTouched: false
            },
            last_name: {
                input: lastNameInput,
                errorElement: lastNameError,
                regex: /^[A-Za-z]+$/,
                errorMessage: 'Last name can only contain letters.',
                isValid: false,
                isTouched: false
            },
            email: {
                input: emailInput,
                errorElement: emailError,
                // Common email regex
                regex: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
                errorMessage: 'Please enter a valid email address.',
                isValid: false,
                isTouched: false
            },
            password: {
                input: passwordInput,
                errorElement: passwordError,
                // At least 8 characters, 1 number, 1 special character
                regex: /^(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/,
                errorMessage: 'Password must be at least 8 characters, with a number and a special character.',
                isValid: false,
                isTouched: false
            },
            university_id: {
                input: universityIdInput,
                errorElement: universityIdError,
                validate: function(value) {
                    if (!/^\d{1,9}$/.test(value)) {
                        this.errorMessage = 'University ID can only contain digits and be up to 9 digits long.';
                        return false;
                    }
                    if (value.length >= 4) {
                        const year = parseInt(value.substring(0, 4));
                        if (year < 1980 || year > 2025) {
                           this.errorMessage = 'The first 4 digits of University ID must be a year between 1980 and 2025.';
                           return false;
                        }
                    }
                    this.errorMessage = 'University ID is invalid.'; // Default, should be more specific if needed
                    return true; // Passes initial digit and length check if no year issue
                },
                isValid: false,
                isTouched: false
            },
            major: {
                input: majorInput,
                errorElement: majorError,
                validate: function(value) { return value.trim() !== ''; }, // Simple non-empty check
                errorMessage: 'Major cannot be empty.',
                isValid: false,
                isTouched: false
            },
            academic_level: {
                input: academicLevelInput,
                errorElement: academicLevelError,
                validate: function(value) { return value !== '';},
                errorMessage: 'Please select your academic level.',
                isValid: false,
                isTouched: false
            },
            date_of_birth: {
    input: dobInput,
    errorElement: dobError,
    validate: function(value) {
        const dobRegex = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(\d{4})$/;
        if (!dobRegex.test(value)) {
            // This error message will be used if the format itself is wrong.
            this.errorMessage = 'Please use dd/mm/yyyy format (e.g., 23/03/1990).';
            return false;
        }

        const parts = value.split('/');
        const day = parseInt(parts[0], 10);
        const month = parseInt(parts[1], 10);
        const year = parseInt(parts[2], 10);

        // Basic year check (e.g., not in the distant future or too far past for a DOB)
        // You can adjust the year range as needed.
        const currentYear = new Date().getFullYear();
        if (year < 1900 || year > currentYear) {
            this.errorMessage = `Year must be between 1900 and ${currentYear}.`;
            return false;
        }

        // Month check (01-12) - Regex already covers this, but good for clarity if needed.
        // if (month < 1 || month > 12) {
        //     this.errorMessage = 'Month must be between 01 and 12.';
        //     return false; // Should be caught by regex
        // }

        // Day check (01-31) - Regex already covers this in general.
        // if (day < 1 || day > 31) {
        //    this.errorMessage = 'Day must be between 01 and 31.';
        //    return false; // Should be caught by regex
        // }

        // Specific day validation based on month
        switch (month) {
            case 2: // February
                if (day > 29) {
                    this.errorMessage = 'February cannot have more than 29 days.';
                    return false;
                }
                break;
            case 4: // April
            case 6: // June
            case 9: // September
            case 11: // November
                if (day > 30) {
                    this.errorMessage = `This month cannot have more than 30 days.`;
                    return false;
                }
                break;
            // For months 1, 3, 5, 7, 8, 10, 12, days up to 31 are allowed.
            // The regex `(0[1-9]|[12][0-9]|3[01])` already ensures day is not > 31.
        }

        // If all checks pass
        this.errorMessage = 'Please enter a valid date in dd/mm/yyyy format.'; // Reset to default if it was changed
        return true;
    },
    errorMessage: 'Please enter a valid date in dd/mm/yyyy format.', // Default/initial message
    isValid: false,
    isTouched: false
}

        };

function validateField(fieldName) {
            const field = validators[fieldName];
            const value = field.input.value;
            let isValid = true; // Assume valid, then prove otherwise
            let messageForDisplay = ''; // This will hold the error message for the current validation check

            // Get the original specific error message for this field (e.g., "Password must be at least...")
            const specificErrorMessage = validators[fieldName].errorMessage;

            // 1. Check if the field is empty (all fields are implicitly required by this logic)
            if (value.trim() === '') {
                messageForDisplay = `${field.input.labels[0].innerText} cannot be empty.`;
                isValid = false;
            }
            // 2. If not empty, perform specific validation (regex or custom function)
            else {
                if (field.regex) {
                    if (!field.regex.test(value)) {
                        messageForDisplay = specificErrorMessage; // Use the specific error for regex failure
                        isValid = false;
                    }
                } else if (field.validate) {
                    if (!field.validate(value)) {
                        // The validate function might update its own 'field.errorMessage' (like university_id)
                        // or use the one initially defined.
                        messageForDisplay = field.errorMessage; // Use the (potentially updated) specific error
                        isValid = false;
                    }
                }
            }

            field.isValid = isValid; // Update the validity status in the validators object
            field.errorElement.textContent = messageForDisplay; // Display the determined message (or empty if valid)

            if (isValid) {
                field.input.classList.remove('border-red-500');
                field.input.classList.add('border-gray-300');
            } else {
                field.input.classList.add('border-red-500');
                field.input.classList.remove('border-gray-300');
            }
            checkFormValidity(); // Update button state
        }

        function checkFormValidity() {
            let isFormReadyToSubmit = true;
            for (const fieldName in validators) {
                if (validators.hasOwnProperty(fieldName)) {
                    const field = validators[fieldName];
                    // If any field is not valid (which includes being empty for required fields,
                    // or failing its specific validation), the form is not ready.
                    if (!field.isValid) {
                        isFormReadyToSubmit = false;
                        break; // No need to check further
                    }
                }
            }
            submitButton.disabled = !isFormReadyToSubmit;
        }


        for (const fieldName in validators) {
            if (validators.hasOwnProperty(fieldName)) {
                const field = validators[fieldName];
                field.input.addEventListener('input', () => {
                    field.isTouched = true;
                    validateField(fieldName);
                });
                field.input.addEventListener('blur', () => {
                    field.isTouched = true;
                    validateField(fieldName);
                });
            }
        }

        dobInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); 
            let formattedValue = '';

            if (value.length > 0) {
                formattedValue += value.substring(0, 2);
            }
            if (value.length >= 3) {
                formattedValue += '/' + value.substring(2, 4);
            }
            if (value.length >= 5) {
                formattedValue += '/' + value.substring(4, 8);
            }
            e.target.value = formattedValue;
            validators.date_of_birth.isTouched = true;
            validateField('date_of_birth');
        });

        dobInput.addEventListener('keydown', function(e) {
            const originalValue = e.target.value;
            if (e.key === 'Backspace') {
                if (originalValue.endsWith('/')) {
                    e.target.value = originalValue.substring(0, originalValue.length - 2);
                    e.preventDefault();
                }
            }
        });


signupForm.addEventListener('submit', function (event) { // No longer async if not using client-side hashing
    event.preventDefault(); 

    let isFormFullyValid = true;
    for (const fieldName in validators) {
        if (validators.hasOwnProperty(fieldName)) {
            if (!validators[fieldName].isTouched) {
                 validators[fieldName].isTouched = true; 
            }
            validateField(fieldName); 
            if (!validators[fieldName].isValid) {
                isFormFullyValid = false;
            }
        }
    }

    if (isFormFullyValid) {
        const formDataToSubmit = {}; // Use a different name to avoid confusion with browser's FormData
        for (const fieldName in validators) {
            if (validators.hasOwnProperty(fieldName)) {
                const field = validators[fieldName];
                formDataToSubmit[fieldName] = field.input.value; 
            }
        }

        console.log("Submitting Form Data (Plain Text):", formDataToSubmit);

        // The API endpoint path
        const apiEndpoint = 'api/v1/signup.php'; // Correct path to your backend API

        fetch(apiEndpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', // Sending data as JSON
                // Or if sending as form data:
                // 'Content-Type': 'application/x-www-form-urlencoded',
            },
            // If sending as JSON:
            body: JSON.stringify(formDataToSubmit)
            // If sending as form data:
            // body: new URLSearchParams(formDataToSubmit).toString()
        })
        .then(response => {
           
            return response.json().then(data => ({ // Process body and pass status along
                status: response.status,
                ok: response.ok,
                body: data
            }));
        })
        .then(result => {
            console.log('API Response:', result);
            if (result.ok && result.status === 201) { // Check for specific success status
                alert(result.body.message || 'Signup successful! Redirecting...');
                window.location.href = 'index.php';
            } else {
                // Display error message(s) from the API (result.body.error)
                alert('Error: ' + (result.body.error || 'An unknown error occurred during signup. Status: ' + result.status));
            }
        })
        .catch(error => {
            console.error('Submission Network/Fetch Error:', error);
            alert('An unexpected network error occurred. Please check your connection and try again.');
        });

    } else {
        alert('Please correct the errors in the form before submitting.');
        for (const fieldName in validators) {
            if (validators.hasOwnProperty(fieldName) && !validators[fieldName].isValid) {
                validators[fieldName].input.focus();
                break;
            }
        }
    }
});
        checkFormValidity();
    });
</script>

<?php
include 'footer.php';
?>