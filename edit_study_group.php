<?php // edit_study_group.php
// This page now primarily serves the HTML form structure.
// Data fetching and population will be handled by JavaScript via an API call.

// NO direct database connection or data fetching in PHP on this page.
// require_once __DIR__ . '/../config/db.php'; // REMOVE THIS - DB access is via API

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// We still need the group_id from the URL to pass to JavaScript
$group_id_from_url = null;
$initial_page_error = null; 

if (isset($_GET['group_id']) && is_numeric($_GET['group_id'])) {
    $group_id_from_url = (int)$_GET['group_id'];
} else {
    $initial_page_error = "Study Group ID is required or invalid in the URL.";
}

include 'header.php'; 
?>

<div class="flex flex-col min-h-screen">
    <main class="flex-grow container mx-auto px-4 py-8 md:py-12">
        <div class="max-w-3xl mx-auto bg-white p-6 md:p-8 rounded-xl shadow-xl">
            <div class="mb-6">
                <a href="study_group_detail.php?group_id=<?php echo htmlspecialchars($group_id_from_url ?: ''); ?>" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 transition duration-300 group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Back to Group Details
                </a>
            </div>
            <div class="mb-8 text-center">
                <h1 id="editPageTitle" class="text-3xl md:text-4xl font-bold text-gray-800">Edit Study Group</h1>
                <p id="editPageSubtitle" class="text-gray-600 mt-2">Loading group details...</p>
            </div>

            <div id="pageErrorMessageContainer" class="mb-6">
                <?php if ($initial_page_error): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                        <strong class="font-bold">Error:</strong>
                        <span class="block sm:inline"><?php echo htmlspecialchars($initial_page_error); ?></span>
                    </div>
                <?php endif; ?>
            </div>
            
            <form id="editStudyGroupForm" class="space-y-6 hidden"> 
                <input type="hidden" id="group_id_hidden" name="group_id" value="">
                
                <div>
                    <label for="course_code_edit" class="block text-sm font-medium text-gray-700 mb-1">Course <span class="text-red-500">*</span></label>
                    <select id="course_code_edit" name="course_code" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Loading courses...</option>
                        <?php /* Courses will be loaded and selected by JavaScript */ ?>
                    </select>
                    <div id="course_loading_error_edit" class="text-red-500 text-sm mt-1"></div>
                </div>

                <div>
                    <label for="title_edit" class="block text-sm font-medium text-gray-700 mb-1">Group Title <span class="text-red-500">*</span></label>
                    <input type="text" id="title_edit" name="title" required minlength="5" maxlength="255" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g., Advanced Calculus Study Sessions" value="">
                </div>

                <div>
                    <label for="description_edit" class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
                    <textarea id="description_edit" name="description" rows="4" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Describe the focus, goals, and activities of your study group."></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="max_members_edit" class="block text-sm font-medium text-gray-700 mb-1">Max Members (Optional)</label>
                        <input type="number" id="max_members_edit" name="max_members" min="2" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g., 10 (leave blank for unlimited)" value="">
                    </div>
                    <div>
                        <label for="location_edit" class="block text-sm font-medium text-gray-700 mb-1">Location (Optional)</label>
                        <input type="text" id="location_edit" name="location" maxlength="255" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g., Library Room 3B, Online via Zoom" value="">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="day_schedule_edit" class="block text-sm font-medium text-gray-700 mb-1">Meeting Day(s) <span class="text-red-500">*</span></label>
                        <select id="day_schedule_edit" name="day_schedule" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select meeting days</option>
                            <?php
                            // These options can remain, JS will select the correct one.
                            $days = ["Every Sunday", "Every Monday", "Every Tuesday", "Every Wednesday", "Every Thursday", "Every Friday", "Every Saturday", "Weekdays (Mon-Fri)", "Weekends (Sat-Sun)"];
                            foreach ($days as $day) {
                                echo "<option value=\"".htmlspecialchars($day)."\">".htmlspecialchars($day)."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="start_time_edit" class="block text-sm font-medium text-gray-700 mb-1">Start Time <span class="text-red-500">*</span></label>
                        <input type="time" id="start_time_edit" name="start_time" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" value="">
                    </div>
                    <div>
                        <label for="end_time_edit" class="block text-sm font-medium text-gray-700 mb-1">End Time <span class="text-red-500">*</span></label>
                        <input type="time" id="end_time_edit" name="end_time" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" value="">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" id="submitEditBtn" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 text-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" /></svg>
                        Update Study Group
                    </button>
                </div>
            </form>
            <div id="formResponseMessageEdit" class="mt-4"></div>
            
            <div id="loadingIndicator" class="text-center p-10 text-gray-500 <?php if ($initial_page_error) echo 'hidden'; ?>">
                <svg class="animate-spin mx-auto h-8 w-8 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p class="mt-2">Loading study group data...</p>
            </div>

        </div>
    </main>
</div>

<?php include 'footer.php'; ?>

<script>
// The JavaScript from your previous message for edit_study_group.php is correct
// and should remain as it is. It's designed to fetch data via API.
// Ensure the <script> block with that JavaScript is present here.
document.addEventListener('DOMContentLoaded', function() {
    const editForm = document.getElementById('editStudyGroupForm');
    const submitEditBtn = document.getElementById('submitEditBtn');
    const responseMessageDivEdit = document.getElementById('formResponseMessageEdit');
    const courseSelectEdit = document.getElementById('course_code_edit');
    const courseLoadingErrorDivEdit = document.getElementById('course_loading_error_edit');
    const pageErrorMessageContainer = document.getElementById('pageErrorMessageContainer');
    const loadingIndicator = document.getElementById('loadingIndicator');
    const editPageTitle = document.getElementById('editPageTitle'); 
    const editPageSubtitle = document.getElementById('editPageSubtitle'); 
    const groupIdHiddenInput = document.getElementById('group_id_hidden');

    const groupIdFromPHP = <?php echo json_encode($group_id_from_url); ?>;
    const initialPageErrorFromPHP = <?php echo json_encode($initial_page_error); ?>;

    function displayPageError(message) {
        if (loadingIndicator) loadingIndicator.classList.add('hidden');
        if (editForm) editForm.classList.add('hidden'); 
        if (pageErrorMessageContainer) { 
            pageErrorMessageContainer.innerHTML = `<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert"><strong class="font-bold">Error:</strong> <span class="block sm:inline">${message}</span></div>`;
        }
        if (editPageSubtitle) editPageSubtitle.textContent = 'Could not load group details.';
    }

    if (initialPageErrorFromPHP) {
        displayPageError(initialPageErrorFromPHP);
        return; 
    }
    
    if (!groupIdFromPHP) {
        displayPageError("Study Group ID not available.");
        return; 
    }

    function populateForm(studyGroupData) {
        if (!editForm) return;
        console.log("Populating form with:", studyGroupData);

        if(groupIdHiddenInput) groupIdHiddenInput.value = studyGroupData.group_id;
        
        const titleInput = document.getElementById('title_edit');
        if(titleInput) titleInput.value = studyGroupData.title || '';
        
        const descriptionTextarea = document.getElementById('description_edit');
        if(descriptionTextarea) descriptionTextarea.value = studyGroupData.description || '';
        
        const maxMembersInput = document.getElementById('max_members_edit');
        if(maxMembersInput) maxMembersInput.value = studyGroupData.max_members || '';
        
        const locationInput = document.getElementById('location_edit');
        if(locationInput) locationInput.value = studyGroupData.location || '';
        
        const dayScheduleSelect = document.getElementById('day_schedule_edit');
        if(dayScheduleSelect) dayScheduleSelect.value = studyGroupData.day_schedule || '';
        
        const startTimeInput = document.getElementById('start_time_edit');
        if(startTimeInput) startTimeInput.value = studyGroupData.start_time || '';
        
        const endTimeInput = document.getElementById('end_time_edit');
        if(endTimeInput) endTimeInput.value = studyGroupData.end_time || '';
        
        loadCoursesForEdit(studyGroupData.course_code); 

        if (editPageSubtitle && studyGroupData.title) {
             editPageSubtitle.textContent = `Update the details for: ${studyGroupData.title}`;
        } else if (editPageSubtitle) {
            editPageSubtitle.textContent = 'Update study group details.';
        }
        
        if (loadingIndicator) loadingIndicator.classList.add('hidden');
        editForm.classList.remove('hidden');
    }

    console.log(`Fetching data for group ID (edit page): ${groupIdFromPHP}`);
    fetch(`api/v1/get_study_group_for_edit.php?group_id=${groupIdFromPHP}`)
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { 
                    console.error("API Error Response (get_study_group_for_edit.php):", err);
                    throw new Error(err.message || `HTTP error! Status: ${response.status}`);
                }).catch((parsingError) => { 
                    // If response.json() itself fails (e.g. HTML error page instead of JSON)
                    console.error("Failed to parse API error response as JSON:", parsingError);
                    // Get raw text to see what the server actually sent
                    return response.text().then(text => {
                        console.error("Raw non-JSON response from API:", text.substring(0, 500) + "..."); // Log first 500 chars
                        throw new Error(`HTTP error! Status: ${response.status}. Server sent non-JSON response.`);
                    });
                });
            }
            return response.json();
        })
        .then(data => {
            console.log("API response for edit page (get_study_group_for_edit.php):", data);
            if (data.status === 'success' && data.study_group) {
                populateForm(data.study_group);
            } else {
                displayPageError(data.message || 'Could not load study group details for editing. API returned an error.');
            }
        })
        .catch(error => {
            console.error('Fetch group data error (for edit page catch block):', error);
            displayPageError(`Failed to load group data: ${error.message}`);
        });

    function loadCoursesForEdit(currentSelectedCourseCode) {
        if (!courseSelectEdit) return; 
        fetch('api/v1/get_courses.php') 
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (data.status === 'success' && data.courses) {
                    courseSelectEdit.innerHTML = '<option value="">Select a course</option>'; 
                    data.courses.forEach(course => {
                        const option = document.createElement('option');
                        option.value = course.course_code;
                        option.textContent = `${course.course_code} - ${course.course_title}`;
                        if (course.course_code === currentSelectedCourseCode) {
                            option.selected = true; 
                        }
                        courseSelectEdit.appendChild(option);
                    });
                    if(courseLoadingErrorDivEdit) courseLoadingErrorDivEdit.textContent = '';
                } else {
                    if(courseLoadingErrorDivEdit) courseLoadingErrorDivEdit.textContent = data.error || 'Could not load courses.';
                }
            })
            .catch(error => {
                console.error('Fetch courses error (edit page):', error);
                if(courseLoadingErrorDivEdit) courseLoadingErrorDivEdit.textContent = 'Failed to load courses. Please try refreshing.';
                if(courseSelectEdit) courseSelectEdit.innerHTML = '<option value="">Failed to load courses</option>';
            });
    }

    if (editForm && submitEditBtn) { 
        editForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if(responseMessageDivEdit) responseMessageDivEdit.innerHTML = ''; 
            submitEditBtn.disabled = true;
            submitEditBtn.innerHTML = `<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Updating...`;
            const formData = new FormData(editForm);
            const dataToSubmit = {};
            formData.forEach((value, key) => { dataToSubmit[key] = value; });
            dataToSubmit.group_id = document.getElementById('group_id_hidden').value;

            if (dataToSubmit.start_time && dataToSubmit.end_time && dataToSubmit.start_time >= dataToSubmit.end_time) {
                if(responseMessageDivEdit) responseMessageDivEdit.innerHTML = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"><strong class="font-bold">Error:</strong> End time must be after start time.</div>';
                submitEditBtn.disabled = false;
                submitEditBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" /></svg>Update Study Group`;
                return;
            }

            fetch('api/v1/update_study_group.php', {
                method: 'PUT', 
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(dataToSubmit)
            })
            .then(response => response.json().then(resData => ({ok: response.ok, status: response.status, body: resData })))
            .then(result => {
                if (result.ok && result.body.status === 'success') {
                    if(responseMessageDivEdit) responseMessageDivEdit.innerHTML = `<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert"><strong class="font-bold">Success!</strong> ${result.body.message}</div>`;
                    setTimeout(() => {
                        window.location.href = `study_group_detail.php?group_id=${dataToSubmit.group_id}`;
                    }, 1500);
                } else {
                    if(responseMessageDivEdit) responseMessageDivEdit.innerHTML = `<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"><strong class="font-bold">Error:</strong> ${result.body.message || 'Could not update study group.'} ${(result.body.errors ? '<br>Details: ' + result.body.errors.join(', ') : '')}</div>`;
                }
            })
            .catch(error => {
                console.error('Update Error:', error);
                if(responseMessageDivEdit) responseMessageDivEdit.innerHTML = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"><strong class="font-bold">Network Error:</strong> Could not connect to the server.</div>';
            })
            .finally(() => {
                submitEditBtn.disabled = false;
                submitEditBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" /></svg>Update Study Group`;
            });
        });
    }
});
</script>
</body>
</html>
