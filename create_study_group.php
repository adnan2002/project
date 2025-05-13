<?php 
// create_study_group.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'header.php'; 


?>

<div class="flex flex-col min-h-screen">
    <main class="flex-grow container mx-auto px-4 py-8 md:py-12">
        <div class="max-w-3xl mx-auto bg-white p-6 md:p-8 rounded-xl shadow-xl">
            <div class="mb-8 text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Create New Study Group</h1>
                <p class="text-gray-600 mt-2">Fill in the details below to start your study group.</p>
            </div>

            

            <form id="createStudyGroupForm" class="space-y-6">
                <div>
                    <label for="course_code" class="block text-sm font-medium text-gray-700 mb-1">Course <span class="text-red-500">*</span></label>
                    <select id="course_code" name="course_code" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select a course</option>
                        
                    </select>
                    <div id="course_loading_error" class="text-red-500 text-sm mt-1"></div>
                </div>

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Group Title <span class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" required minlength="5" maxlength="255" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g., Advanced Calculus Study Sessions">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
                    <textarea id="description" name="description" rows="4" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Describe the focus, goals, and activities of your study group."></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="max_members" class="block text-sm font-medium text-gray-700 mb-1">Max Members (Optional)</label>
                        <input type="number" id="max_members" name="max_members" min="2" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g., 10 (leave blank for unlimited)">
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location (Optional)</label>
                        <input type="text" id="location" name="location" maxlength="255" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g., Library Room 3B, Online via Zoom">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="day_schedule" class="block text-sm font-medium text-gray-700 mb-1">Meeting Day(s) <span class="text-red-500">*</span></label>
                        <select id="day_schedule" name="day_schedule" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select meeting days</option>
                            <option value="Every Sunday">Every Sunday</option>
                            <option value="Every Monday">Every Monday</option>
                            <option value="Every Tuesday">Every Tuesday</option>
                            <option value="Every Wednesday">Every Wednesday</option>
                            <option value="Every Thursday">Every Thursday</option>
                            <option value="Every Friday">Every Friday</option>
                            <option value="Every Saturday">Every Saturday</option>
                            <option value="Weekdays">Weekdays (Mon-Fri)</option>
                            <option value="Weekends">Weekends (Sat-Sun)</option>
                        </select>
                    </div>
                    <div>
                        <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Start Time <span class="text-red-500">*</span></label>
                        <input type="time" id="start_time" name="start_time" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">End Time <span class="text-red-500">*</span></label>
                        <input type="time" id="end_time" name="end_time" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" id="submitBtn" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 text-lg flex items-center justify-center">
                        <svg xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Create Study Group
                    </button>
                </div>
            </form>
            <div id="formResponseMessage" class="mt-4"></div>
        </div>
    </main>
</div>

<?php include 'footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('createStudyGroupForm');
    const submitBtn = document.getElementById('submitBtn');
    const responseMessageDiv = document.getElementById('formResponseMessage');
    const courseSelect = document.getElementById('course_code'); // Get the select element
    const courseLoadingErrorDiv = document.getElementById('course_loading_error');

    // --- NEW: Function to fetch and populate courses ---
    function loadCourses() {
        fetch('api/v1/get_courses.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success' && data.courses) {
                    courseSelect.innerHTML = '<option value="">Select a course</option>'; 
                    data.courses.forEach(course => {
                        const option = document.createElement('option');
                        option.value = course.course_code;
                        option.textContent = `${course.course_code} - ${course.course_title}`;
                        courseSelect.appendChild(option);
                    });
                    courseLoadingErrorDiv.textContent = ''; // Clear error
                } else {
                    courseLoadingErrorDiv.textContent = data.error || 'Could not load courses.';
                    console.error("Error loading courses:", data.error);
                }
            })
            .catch(error => {
                console.error('Fetch courses error:', error);
                courseLoadingErrorDiv.textContent = 'Failed to load courses. Please try refreshing.';
                courseSelect.innerHTML = '<option value="">Failed to load courses</option>';
            });
    }

    // --- Call the function to load courses ---
    loadCourses();

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        responseMessageDiv.innerHTML = ''; 
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Creating...
        `;

        const formData = new FormData(form);
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });
        
        if (data.start_time && data.end_time && data.start_time >= data.end_time) {
            responseMessageDiv.innerHTML = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"><strong class="font-bold">Error:</strong> End time must be after start time.</div>';
            submitBtn.disabled = false;
            submitBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Create Study Group`;
            return;
        }

        fetch('api/v1/create_study_group_api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json().then(resData => ({ok: response.ok, status: response.status, body: resData })))
        .then(result => {
            if (result.ok && result.body.status === 'success') {
                responseMessageDiv.innerHTML = `<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert"><strong class="font-bold">Success!</strong> ${result.body.message} Group ID: ${result.body.group_id}</div>`;
                form.reset();
                setTimeout(() => {
                    window.location.href = `study_group_detail.php?group_id=${result.body.group_id}`;
                }, 2000);
            } else {
                responseMessageDiv.innerHTML = `<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"><strong class="font-bold">Error:</strong> ${result.body.error || 'Could not create study group.'}</div>`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            responseMessageDiv.innerHTML = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"><strong class="font-bold">Network Error:</strong> Could not connect to the server.</div>';
        })
        .finally(() => {
            submitBtn.disabled = false;
             submitBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Create Study Group`;
        });
    });
});
</script>
</body>
</html>