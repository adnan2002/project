<?php 
// study_group_detail.php - Study Group Detail Page
include 'header.php'; // This will start the session via header.php

$group_id = null;
$error_message = null;
$group_data = null; // To store fetched data
$passed_subject_tag_color = null; // To store color from URL

if (isset($_GET['group_id']) && is_numeric($_GET['group_id'])) {
    $group_id = (int)$_GET['group_id'];
} else {
    $error_message = "Study Group ID is required or invalid.";
}

if (isset($_GET['subjectTagColor'])) {
    if (preg_match('/^bg-[a-z]+-\d{2,3}$/', $_GET['subjectTagColor'])) {
        $passed_subject_tag_color = $_GET['subjectTagColor'];
    }
}
?>

<div class="flex flex-col min-h-screen">
    <main class="flex-grow container mx-auto px-4 py-8 md:py-12">
        <div class="flex flex-col md:flex-row gap-8">
            <aside class="w-full md:w-1/4 lg:w-1/5 bg-white p-6 rounded-xl shadow-lg self-start">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Modules</h2>
                <nav>
                    <ul class="space-y-3">
                        <li>
                            <a href="events.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12v-.008ZM12 18h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75v-.008ZM9.75 18h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5v-.008ZM7.5 18h.008v.008H7.5v-.008ZM14.25 15h.008v.008H14.25v-.008ZM14.25 18h.008v.008H14.25v-.008ZM16.5 15h.008v.008H16.5v-.008ZM16.5 18h.008v.008H16.5v-.008Z" /></svg>
                                Events Calendar
                            </a>
                        </li>
                        <li>
                            <a href="study_groups.php" class="flex items-center text-indigo-600 bg-indigo-100 p-3 rounded-lg font-semibold transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" /></svg>
                                Study Group Finder
                            </a>
                        </li>
                        <li>
                            <a href="course_reviews.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.822.672l-4.684-2.79a.563.563 0 0 0-.652 0l-4.684 2.79a.562.562 0 0 1-.822-.672l1.285-5.385a.562.562 0 0 0-.182-.557l-4.204-3.602a.563.563 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" /></svg>
                                Course Reviews
                            </a>
                        </li>
                        <li>
                            <a href="course_notes.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                                Course Notes
                            </a>
                        </li>
                        <li>
                            <a href="campus_news.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25H5.625a2.25 2.25 0 0 1-2.25-2.25V7.5c0-.621.504-1.125 1.125-1.125H9M7.5 11.25h.008v.008H7.5v-.008Zm0 3h.008v.008H7.5v-.008Zm0 3h.008v.008H7.5v-.008Z" /></svg>
                                Campus News
                            </a>
                        </li>
                        <li>
                            <a href="club_activities.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 1.516M6.528 9.918A9 9 0 0 1 12.75 3.031m0 0a9 9 0 0 1 6.222 6.887M12.75 3.031a9 9 0 0 1-6.222 6.887m6.222-6.887L18.5 7.5M12.75 3.03V5.25m0 0A2.25 2.25 0 0 1 15 7.5v.208c0 .621.448 1.17.956 1.397l.703.422a2.25 2.25 0 0 1 .956 1.397V13.5A2.25 2.25 0 0 1 15 15.75v.208c0 .621-.448 1.17-.956 1.397l-.703.422a2.25 2.25 0 0 1-.956 1.397V21m-4.5 0V19.208c0-.621.448-1.17.956-1.397l.703-.422a2.25 2.25 0 0 1 .956-1.397V13.5A2.25 2.25 0 0 1 10.5 11.25v-.208c0-.621-.448-1.17-.956-1.397L8.84 9.23a2.25 2.25 0 0 1-.956-1.397V5.25A2.25 2.25 0 0 1 10.5 3m-3.75 0h7.5" /></svg>
                                Club Activities
                            </a>
                        </li>
                        <li>
                            <a href="student_marketplace.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                                Student Marketplace
                            </a>
                        </li>
                    </ul>
                </nav>
            </aside>

            <div class="w-full md:w-3/4 lg:w-4/5" id="studyGroupDetailContent">
                <?php if ($error_message): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                        <strong class="font-bold">Error:</strong>
                        <span class="block sm:inline"><?php echo htmlspecialchars($error_message); ?></span>
                    </div>
                <?php elseif ($group_id): ?>
                    <div class="mb-6">
                        <a href="study_groups.php" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 transition duration-300 group">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                            </svg>
                            Back to Study Groups
                        </a>
                    </div>

                    <div id="loadingMessageDetail" class="text-center p-10 text-gray-500">Loading group details...</div>
                    
                    <div id="groupContentContainer" class="hidden bg-white p-6 md:p-8 rounded-xl shadow-xl">
                      
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
</div>

<?php include 'footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const groupId = <?php echo json_encode($group_id); ?>;
    const errorMessage = <?php echo json_encode($error_message); ?>;
    const passedSubjectTagColor = <?php echo json_encode($passed_subject_tag_color); ?>; 
    const isLoggedIn = <?php echo json_encode(isset($_SESSION['user_id'])); ?>; 

    

    const groupContentContainer = document.getElementById('groupContentContainer');
    const loadingMessageDetail = document.getElementById('loadingMessageDetail');

    const defaultSubjectTagColors = { 
        'MATHEMATICS': 'bg-blue-500',
        'BIOLOGY': 'bg-green-500',
        'COMPUTER SCIENCE': 'bg-sky-500',
        'CHEMISTRY': 'bg-yellow-500',
        'PSYCHOLOGY': 'bg-purple-500',
        'PHYSICS': 'bg-red-500',
        'ENGINEERING': 'bg-orange-500',
        'LITERATURE': 'bg-pink-500',
        'HISTORY': 'bg-teal-500',
        'BUSINESS': 'bg-gray-500',
        'OTHER': 'bg-slate-500',
        'GENERAL': 'bg-lime-500'
    };
    const avatarColors = [
        'bg-indigo-500', 'bg-pink-500', 'bg-green-500', 'bg-yellow-500', 
        'bg-purple-500', 'bg-teal-500', 'bg-orange-500', 'bg-red-500',
        'bg-blue-400', 'bg-emerald-400', 'bg-rose-400', 'bg-fuchsia-400'
    ];

    function formatTimeAgoJS(timestampStr) {
    if (!timestampStr) return 'Some time ago';

    const date = new Date(timestampStr.replace(/-/g, "/")); // Ensure cross-browser compatibility for date parsing
    const now = new Date();
    const seconds = Math.round((now.getTime() - date.getTime()) / 1000);

    if (seconds < 5) return 'Just now'; // Immediate posts

    let interval = Math.floor(seconds / 31536000); // year
    if (interval >= 1) return interval + ' year' + (interval > 1 ? 's' : '') + ' ago';

    interval = Math.floor(seconds / 2592000); // month
    if (interval >= 1) return interval + ' month' + (interval > 1 ? 's' : '') + ' ago';

    interval = Math.floor(seconds / 86400); // day
    if (interval >= 1) return interval + ' day' + (interval > 1 ? 's' : '') + ' ago';

    interval = Math.floor(seconds / 3600); // hour
    if (interval >= 1) return interval + ' hour' + (interval > 1 ? 's' : '') + ' ago';

    interval = Math.floor(seconds / 60); // minute
    if (interval >= 1) return interval + ' minute' + (interval > 1 ? 's' : '') + ' ago';

    return Math.floor(seconds) + ' second' + (seconds !== 1 ? 's' : '') + ' ago';
}

    function getInitials(firstName, lastName) {
        const firstInitial = firstName ? firstName.charAt(0).toUpperCase() : '';
        const lastInitial = lastName ? lastName.charAt(0).toUpperCase() : '';
        return firstInitial + lastInitial;
    }
    
    function escapeHTML(str) {
        if (str === null || str === undefined) return '';
        return str.toString().replace(/[&<>"']/g, function (match) {
            return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[match];
        });
    }

    if (groupId && !errorMessage) {
        fetch(`api/v1/get_study_group_detail.php?group_id=${groupId}`)
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw new Error(err.error || `HTTP error! Status: ${response.status}`) });
                }
                return response.json();
            })
            .then(data => {
                loadingMessageDetail.style.display = 'none';
                if (data.status === 'success') {
                    renderGroupDetails(data);
                    groupContentContainer.classList.remove('hidden');
                } else {
                    groupContentContainer.innerHTML = `<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                        <strong class="font-bold">Error:</strong>
                        <span class="block sm:inline">${escapeHTML(data.error || 'Could not load study group details.')}</span></div>`;
                    groupContentContainer.classList.remove('hidden');
                }
            })
            .catch(error => {
                loadingMessageDetail.style.display = 'none';
                console.error('Fetch Error:', error);
                groupContentContainer.innerHTML = `<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                    <strong class="font-bold">Error:</strong>
                    <span class="block sm:inline">Failed to load study group details: ${escapeHTML(error.message)}</span></div>`;
                groupContentContainer.classList.remove('hidden');
            });
    } else if (!errorMessage) { 
        loadingMessageDetail.style.display = 'none';
        document.getElementById('studyGroupDetailContent').innerHTML = `<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
            <strong class="font-bold">Error:</strong>
            <span class="block sm:inline">No Study Group ID provided.</span></div>`;
    }

        function renderGroupDetails(apiResponse) {
        const group = apiResponse.group_details;
        const members = apiResponse.members || []; // Ensure members is always an array
        const comments = apiResponse.comments;
        const isCurrentUserMember = apiResponse.is_current_user_member;
        const currentUserId = apiResponse.current_user_id;
        const currentUserFirstName = apiResponse.current_user_first_name;
        const currentUserLastName = apiResponse.current_user_last_name;

        const subjectColor = passedSubjectTagColor || defaultSubjectTagColors[group.subject_department?.toUpperCase()] || 'bg-gray-500';
        const creatorName = `${escapeHTML(group.leader_first_name)} ${escapeHTML(group.leader_last_name)}`;
        
        let joinButtonHTML = '';
        let editDeleteButtonsHTML = '';

        if (isLoggedIn && currentUserId === group.leader_id) {
            // User is the leader
            joinButtonHTML = `
                <button id="joinGroupButton" 
                        class="w-full bg-gray-400 text-white font-bold py-3 px-4 rounded-lg shadow-md flex items-center justify-center text-lg cursor-not-allowed" 
                        disabled title="You are the group leader">
                    Group Leader
                </button>`;
            editDeleteButtonsHTML = `
                <button title="Edit Group (Coming Soon)" class="p-2 text-gray-700 hover:text-indigo-600 cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg></button>
                <button title="Delete Group (Coming Soon)" class="p-2 text-gray-700 hover:text-red-600 cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12.56 0c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg></button>
            `;
        } else if (isLoggedIn) {
            // User is logged in, not the leader
            const buttonText = isCurrentUserMember ? 'Leave Group' : 'Join Group';
            const buttonColor = isCurrentUserMember ? 'bg-red-600 hover:bg-red-700' : 'bg-indigo-600 hover:bg-indigo-700';
            const buttonIcon = isCurrentUserMember 
                ? `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H21" /></svg>`
                : `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>`;
            
            joinButtonHTML = `
                <button id="joinGroupButton" 
                        class="w-full ${buttonColor} text-white font-bold py-3 px-4 rounded-lg shadow-md transition duration-300 flex items-center justify-center text-lg" 
                        data-is-member="${isCurrentUserMember}"
                        data-group-id="${group.group_id}">
                    ${buttonIcon}
                    <span id="joinGroupButtonText">${buttonText}</span>
                </button>`;
            editDeleteButtonsHTML = `
                <button title="Edit Group (Feature not active)" class="p-2 text-gray-400 cursor-not-allowed"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg></button>
                <button title="Delete Group (Feature not active)" class="p-2 text-gray-400 cursor-not-allowed"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12.56 0c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg></button>
            `;
        } else {
             // User not logged in
             joinButtonHTML = `
                <a href="login.php" 
                        class="w-full bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 px-4 rounded-lg shadow-md transition duration-300 flex items-center justify-center text-lg" 
                        title="Login to join group">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    Join Group
                </a>`;
            editDeleteButtonsHTML = `
                <button title="Edit Group (Feature not active)" class="p-2 text-gray-400 cursor-not-allowed"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg></button>
                <button title="Delete Group (Feature not active)" class="p-2 text-gray-400 cursor-not-allowed"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12.56 0c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg></button>
            `;
        }

        const membersCountDisplayHTML = `<p id="membersCountDisplay" class="text-sm text-gray-600 text-center mt-2">${group.members_count} member(s) / ${group.max_members ? escapeHTML(group.max_members) + ' spots' : 'Unlimited spots'}</p>`;
        
 let groupHTML = `
      <div class="flex flex-col sm:flex-row justify-between items-start mb-6 pb-6 border-b border-gray-200">
        <div>
          <span class="text-xs font-semibold inline-block py-1 px-3 uppercase rounded-full ${escapeHTML(subjectColor)} text-white mb-2">
            ${escapeHTML(group.subject_department) || 'General'}
          </span>
          <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mt-1">${escapeHTML(group.title)}</h1>
          <p class="text-sm text-gray-500 mt-1">${escapeHTML(group.course_code)} &bull; Created by ${creatorName}</p>
        </div>
        <div class="flex space-x-2 mt-4 sm:mt-0">
          ${editDeleteButtonsHTML}
        </div>
      </div>
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
          <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-3">About this group</h2>
            <div class="prose max-w-none text-gray-700 leading-relaxed">${group.description.replace(/\n/g, '<br>')}</div>
          </div>
          <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Meeting Information</h2>
            <div class="space-y-3 text-gray-700">
              <div class="flex items-start"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-3 text-indigo-500 flex-shrink-0 mt-1"><path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.145l.002-.001L10 18.41l.002.001.282.144a5.74 5.74 0 00.28.145l.018.008.006.003.003.001.002.001c.198.086.307.066.307.066s.11-.02.308.066l.002.001.006.003.018.008a5.741 5.741 0 00.281-.145l.002-.001L10 18.41l.002.001.282.144a5.74 5.74 0 00.28.145l.018.008.006.003.003.001ZM10 4a4 4 0 100 8 4 4 0 000-8zm0 6a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg><div><strong>Location:</strong> ${escapeHTML(group.location) || 'Not specified'}</div></div>
              <div class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-3 text-indigo-500 flex-shrink-0"><path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5h10.5a.75.75 0 000-1.5H4.75a.75.75 0 000 1.5z" clip-rule="evenodd" /></svg><div><strong>Day:</strong> ${escapeHTML(group.day_schedule)}</div></div>
              <div class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-3 text-indigo-500 flex-shrink-0"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" /></svg><div><strong>Time:</strong> ${escapeHTML(group.meeting_time_range)}</div></div>
            </div>
          </div>
          <div class="pt-8 border-t border-gray-200">
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Comments (${comments.length})</h3>
            <div id="commentsContainer" class="space-y-6 mb-6">
              ${comments.length > 0 ? comments.map((comment, index) => `
                <div class="flex items-start"><div class="w-10 h-10 ${avatarColors[index % avatarColors.length]} text-white flex items-center justify-center rounded-full text-lg font-bold mr-3 flex-shrink-0">${getInitials(comment.commenter_first_name, comment.commenter_last_name)}</div><div class="bg-gray-100 p-4 rounded-lg flex-grow"><div class="flex justify-between items-center mb-1"><span class="font-semibold text-gray-800 text-sm">${escapeHTML(comment.commenter_first_name)} ${escapeHTML(comment.commenter_last_name)}</span><span class="text-xs text-gray-500">${formatTimeAgoJS(comment.comment_created_at)}</span></div><p class="text-gray-700 text-sm">${escapeHTML(comment.comment_text)}</p><div class="mt-2 text-xs"><button class="text-indigo-600 hover:underline helpful-vote-button" data-comment-id="${comment.comment_id}">Helpful (${comment.helpful_count})</button></div></div></div>
              `).join('') : '<p class="text-gray-500">No comments yet. Be the first to comment!</p>'}
            </div>
            <div>
              <h4 class="text-md font-semibold text-gray-800 mb-2">Add a comment...</h4>
              <form id="addCommentForm" method="POST"><input type="hidden" name="group_id" value="${group.group_id}"><textarea name="comment_text" id="commentTextArea" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 mb-3" placeholder="Write your comment..." required></textarea><div class="text-right"><button type="submit" id="postCommentButton" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-5 rounded-lg shadow-md transition duration-300">Post Comment</button></div></form>
            </div>
          </div>
        </div>
        
        <div class="lg:col-span-1 space-y-8">
          <div>
           ${joinButtonHTML}
           ${membersCountDisplayHTML}
          </div>
          <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
            <h3 id="membersListHeading" class="text-xl font-semibold text-gray-800 mb-4">Members (${members.length})</h3>
            <ul class="space-y-3" id="membersList">
              ${members.length > 0 ? members.map((member, index) => `
                <li class="flex items-center" data-user-id="${member.user_id}">
                  <div class="w-8 h-8 ${avatarColors[index % avatarColors.length]} text-white flex items-center justify-center rounded-full text-sm font-bold mr-3">${getInitials(member.first_name, member.last_name)}</div>
                  <span class="text-gray-700 text-sm">${escapeHTML(member.first_name)} ${escapeHTML(member.last_name)}</span>
                  ${member.user_id === group.leader_id ? '<span class="ml-2 text-xs text-indigo-600 font-semibold">(Leader)</span>' : ''}
                </li>
              `).join('') : '<p class="text-gray-500 text-sm" id="noMembersMessage">No members yet (besides the leader).</p>'}
            </ul>
            ${members.length > 8 ? '<a href="#" id="viewAllMembersLink" class="text-sm text-indigo-600 hover:underline mt-3 inline-block">View all members</a>' : ''}
          </div>
        </div>
      </div>
    `;
    groupContentContainer.innerHTML = groupHTML;
    
    addCommentFormListener(); 
    addHelpfulVoteListeners();
    // Pass necessary info from apiResponse for dynamic list updates
    addJoinLeaveButtonListener(
      currentUserId, 
      currentUserFirstName, // From session, via get_study_group_detail API
      currentUserLastName  // From session, via get_study_group_detail API
    ); 
  }    
  
  
  function addJoinLeaveButtonListener(loggedInUserId, loggedInUserFirstName, loggedInUserLastName) {
        const joinGroupButton = document.getElementById('joinGroupButton');
        
        // If button is a link (user not logged in) or disabled (user is leader), do nothing
        if (!joinGroupButton || joinGroupButton.tagName === 'A' || joinGroupButton.disabled) {
            return;
        }

        joinGroupButton.addEventListener('click', function() {
            if (!isLoggedIn) { // Double check, though button should be a link if not logged in
                alert('You must be logged in to join or leave the group.');
                window.location.href = 'login.php'; // Redirect to login
                return;
            }

            const groupId = this.dataset.groupId;
            let isMember = this.dataset.isMember === 'true';
            const action = isMember ? 'leave' : 'join';
            const endpoint = action === 'join' ? 'api/v1/join_study_group.php' : 'api/v1/leave_study_group.php';
            
            const buttonTextSpan = this.querySelector('#joinGroupButtonText');
            const originalButtonTextContent = buttonTextSpan ? buttonTextSpan.textContent : (isMember ? 'Leave Group' : 'Join Group');
            const originalButtonClasses = Array.from(this.classList); // Store original classes for full revert on error

            this.disabled = true;
            if(buttonTextSpan) buttonTextSpan.textContent = 'Processing...';

            fetch(endpoint, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ group_id: groupId })
            })
            .then(response => response.json().then(data => ({ ok: response.ok, status: response.status, body: data })))
            .then(result => {
                if (result.ok && result.body.status === 'success') {
                    isMember = (action === 'join');
                    this.dataset.isMember = isMember;

                    // Update Button: Text, Color, Icon
                    if(buttonTextSpan) buttonTextSpan.textContent = isMember ? 'Leave Group' : 'Join Group';
                    this.classList.remove('bg-indigo-600', 'hover:bg-indigo-700', 'bg-red-600', 'hover:bg-red-700');
                    this.classList.add(isMember ? 'bg-red-600' : 'bg-indigo-600');
                    this.classList.add(isMember ? 'hover:bg-red-700' : 'hover:bg-indigo-700');
                    
                    const newIconSVG = isMember 
                        ? `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H21" /></svg>`
                        : `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>`;
                    const existingIcon = this.querySelector('svg');
                    if (existingIcon) existingIcon.insertAdjacentHTML('beforebegin', newIconSVG); existingIcon.remove();


                    // Update Members Count Display (under button)
                    const membersCountDisplay = document.getElementById('membersCountDisplay');
                    const groupDataElement = document.getElementById('groupContentContainer'); // Parent for max_members
                    let maxMembersText = 'Unlimited spots';
                    if (groupDataElement) { // Find the p tag to extract max_members
                        const pElement = groupDataElement.querySelector('div > p.text-sm.text-gray-600.text-center.mt-2');
                        if(pElement && pElement.textContent.includes('/')) {
                            const parts = pElement.textContent.split('/');
                            if(parts.length > 1) maxMembersText = parts[1].trim();
                        }
                    }
                    if (membersCountDisplay) {
                        membersCountDisplay.textContent = `${result.body.new_member_count} member(s) / ${maxMembersText}`;
                    }
                    
                    // Update Members List (ul#membersList) and its Heading (h3#membersListHeading)
                    const membersListUL = document.getElementById('membersList');
                    const membersListHeading = document.getElementById('membersListHeading');
                    let currentListedMemberElements = membersListUL.querySelectorAll('li[data-user-id]');

                    if (action === 'join') {
                        // Use details of the user who just joined (the current logged-in user)
                        // The join API should ideally return the full member_info (user_id, first_name, last_name)
                        // For now, using loggedInUserFirstName and loggedInUserLastName passed to this function
                        const newMemberInfo = result.body.member_info || { user_id: loggedInUserId, first_name: loggedInUserFirstName, last_name: loggedInUserLastName };
                        
                        const noMembersMessage = document.getElementById('noMembersMessage');
                        if (noMembersMessage) noMembersMessage.remove();

                        const memberExistsInList = membersListUL.querySelector(`li[data-user-id="${newMemberInfo.user_id}"]`);
                        if (!memberExistsInList) {
                             const avatarColorIndex = currentListedMemberElements.length % avatarColors.length;
                             const memberLi = `
                                <li class="flex items-center" data-user-id="${newMemberInfo.user_id}">
                                    <div class="w-8 h-8 ${avatarColors[avatarColorIndex]} text-white flex items-center justify-center rounded-full text-sm font-bold mr-3">${getInitials(newMemberInfo.first_name, newMemberInfo.last_name)}</div>
                                    <span class="text-gray-700 text-sm">${escapeHTML(newMemberInfo.first_name)} ${escapeHTML(newMemberInfo.last_name)}</span>
                                </li>`;
                            membersListUL.insertAdjacentHTML('beforeend', memberLi);
                        }
                    } else if (action === 'leave') {
                        const userLiToRemove = membersListUL.querySelector(`li[data-user-id="${result.body.user_id_left}"]`);
                        if (userLiToRemove) {
                            userLiToRemove.remove();
                        }
                        currentListedMemberElements = membersListUL.querySelectorAll('li[data-user-id]'); // Re-query
                        if (currentListedMemberElements.length === 0 && !document.getElementById('noMembersMessage')) {
                           membersListUL.innerHTML = '<p class="text-gray-500 text-sm" id="noMembersMessage">No members yet (besides the leader).</p>';
                        }
                    }
                    // Update the count in the heading after add/remove
                    currentListedMemberElements = membersListUL.querySelectorAll('li[data-user-id]');
                    if(membersListHeading) membersListHeading.textContent = `Members (${currentListedMemberElements.length})`;

                } else {
                    alert('Error: ' + (result.body.error || 'Could not complete action.'));
                    if(buttonTextSpan) buttonTextSpan.textContent = originalButtonTextContent; // Revert text on error
                }
            })
            .catch(error => {
                console.error('Join/Leave Group Error:', error);
                alert('Failed to process request. Please try again.');
                if(buttonTextSpan) buttonTextSpan.textContent = originalButtonTextContent; // Revert text on error
            })
            .finally(() => {
                this.disabled = false;
            });
        });
    }





    function addCommentFormListener() {
        const commentForm = document.getElementById('addCommentForm');
        if (commentForm) {
            commentForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const commentText = document.getElementById('commentTextArea').value.trim();
                const currentGroupId = this.elements['group_id'].value;
                if (!commentText) { alert('Comment cannot be empty.'); return; }
                const isLoggedIn = <?php echo json_encode(isset($_SESSION['user_id'])); ?>; 
                if (!isLoggedIn) { alert('You must be logged in to post a comment.'); return; }

                const postCommentButton = document.getElementById('postCommentButton');
                postCommentButton.disabled = true;
                postCommentButton.textContent = 'Posting...';

                fetch('api/v1/add_study_group_comment.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ group_id: currentGroupId, comment_text: commentText })
                })
                .then(response => response.json().then(data => ({ status: response.status, ok: response.ok, body: data })))
                .then(result => {
                    if (result.ok && result.body.status === 'success') {
                        alert('Comment posted successfully!');
                        document.getElementById('commentTextArea').value = '';
                        const newComment = result.body.comment;
                        if (newComment) {
                             const commentsContainer = document.getElementById('commentsContainer');
                             const noCommentsP = commentsContainer.querySelector('p.text-gray-500');
                             if (noCommentsP) noCommentsP.remove();
                             const commentHtml = `<div class="flex items-start"><div class="w-10 h-10 ${avatarColors[Math.floor(Math.random() * avatarColors.length)]} text-white flex items-center justify-center rounded-full text-lg font-bold mr-3 flex-shrink-0">${getInitials(newComment.commenter_first_name, newComment.commenter_last_name)}</div><div class="bg-gray-100 p-4 rounded-lg flex-grow"><div class="flex justify-between items-center mb-1"><span class="font-semibold text-gray-800 text-sm">${escapeHTML(newComment.commenter_first_name)} ${escapeHTML(newComment.commenter_last_name)}</span><span class="text-xs text-gray-500">${formatTimeAgoJS(newComment.comment_created_at)}</span></div><p class="text-gray-700 text-sm">${escapeHTML(newComment.comment_text)}</p><div class="mt-2 text-xs"><button class="text-indigo-600 hover:underline helpful-vote-button" data-comment-id="${newComment.comment_id}">Helpful (${newComment.helpful_count})</button></div></div></div>`;
                            commentsContainer.insertAdjacentHTML('afterbegin', commentHtml);
                            addHelpfulVoteListeners();
                        }
                    } else {
                        alert('Error posting comment: ' + (result.body.error || 'Unknown error'));
                    }
                })
                .catch(error => { console.error('Comment post error:', error); alert('Failed to post comment. Please try again.'); })
                .finally(() => { postCommentButton.disabled = false; postCommentButton.textContent = 'Post Comment'; });
            });
        }
    }

    function addHelpfulVoteListeners() {
        document.querySelectorAll('.helpful-vote-button').forEach(button => {
            const newButton = button.cloneNode(true);
            button.parentNode.replaceChild(newButton, button);
            newButton.addEventListener('click', function() {
                const commentId = this.dataset.commentId;
                const isLoggedIn = <?php echo json_encode(isset($_SESSION['user_id'])); ?>;
                if (!isLoggedIn) { alert('You must be logged in to vote.'); return; }
                fetch('api/v1/vote_study_group_comment.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ comment_id: commentId })
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') {
                        this.textContent = `Helpful (${result.new_helpful_count})`;
                    } else {
                        alert('Error: ' + result.error);
                    }
                })
                .catch(error => { console.error('Vote error:', error); alert('Failed to process vote.'); });
            });
        });
    }
});
</script>
</body>
</html>
