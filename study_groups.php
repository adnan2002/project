<?php 
// study_groups.php
include 'header.php'; // This will start the session via header.php

$is_auth = false;
if (isset($_SESSION['user_id'])) {
    $is_auth = true;
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

            <div class="w-full md:w-3/4 lg:w-4/5">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 sm:mb-0">Study Groups</h1>

                        <button id="createStudyGroupBtn" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-5 rounded-lg shadow-md transition duration-300 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Create Study Group
                        </button>
                    
                </div>

                <div class="mb-8 p-6 bg-white rounded-xl shadow-lg">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        <div class="md:col-span-1">
                            <label for="search-groups" class="block text-sm font-medium text-gray-700 mb-1">Search study groups...</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </div>
                                <input type="search" id="search-groups" class="w-full p-2 pl-10 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Course name, subject...">
                            </div>
                        </div>
                        <div>
                            <label for="group-subject-filter" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                            <select id="group-subject-filter" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">All Subjects</option>
                                </select>
                        </div>
                        <div>
                            <label for="group-sort" class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                            <select id="group-sort" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="recent">Most Recent</option>
                                <option value="members">Most Members</option>
                                <option value="alphabetical">Alphabetical (A-Z)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="studyGroupsContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <p id="loadingMessage" class="col-span-full text-center text-gray-500">Loading study groups...</p>
                </div>

                <div id="paginationContainer" class="mt-12 flex justify-center items-center space-x-2">
                    </div>
            </div>
        </div>
    </main>
</div>

<?php include 'footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const studyGroupsContainer = document.getElementById('studyGroupsContainer');
    const paginationContainer = document.getElementById('paginationContainer');
    const loadingMessage = document.getElementById('loadingMessage');
    let currentPage = 1;

    // Define the color sequence
    const cardColors = [
        'bg-blue-50', 'bg-green-50', 'bg-sky-50', 
        'bg-yellow-50', 'bg-purple-50', 'bg-red-50'
    ];
    const subjectColors = [
        'bg-blue-500', 'bg-green-500', 'bg-sky-500',
        'bg-yellow-500', 'bg-purple-500', 'bg-red-500'
    ];

    function fetchStudyGroups(page = 1) {
        loadingMessage.style.display = 'block';
        studyGroupsContainer.innerHTML = ''; // Clear previous groups

        fetch(`api/v1/get_study_groups.php?page=${page}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                loadingMessage.style.display = 'none';
                if (data.status === 'success' && data.data.length > 0) {
                    renderStudyGroups(data.data);
                    renderPagination(data.pagination);
                } else if (data.data.length === 0) {
                    studyGroupsContainer.innerHTML = '<p class="col-span-full text-center text-gray-500">No study groups found.</p>';
                    paginationContainer.innerHTML = ''; // Clear pagination if no results
                } else {
                    studyGroupsContainer.innerHTML = `<p class="col-span-full text-center text-red-500">Error: ${data.error || 'Could not load study groups.'}</p>`;
                }
            })
            .catch(error => {
                loadingMessage.style.display = 'none';
                console.error('Fetch Error:', error);
                studyGroupsContainer.innerHTML = '<p class="col-span-full text-center text-red-500">Failed to load study groups. Please try again later.</p>';
            });
    }

 function renderStudyGroups(groups) {
    studyGroupsContainer.innerHTML = ''; // Clear before rendering
    groups.forEach((group, index) => {
        const cardBgColor = cardColors[index % cardColors.length];
        // This is the subject background color determined on the study_groups.php page
        const subjectBgColor = subjectColors[index % subjectColors.length]; 

        const groupCard = `
            <div class="study-group-card ${cardBgColor} p-6 rounded-xl shadow-lg flex flex-col hover:shadow-xl transition-shadow duration-300">
                <div class="mb-3">
                    <span class="text-xs font-semibold inline-block py-1 px-3 uppercase rounded-full ${subjectBgColor} text-white">
                        ${group.subject ? escapeHTML(group.subject) : 'General'}
                    </span>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2 flex-grow">${escapeHTML(group.title)}</h3>
                <p class="text-gray-700 text-sm mb-4 flex-grow">${escapeHTML(group.description.substring(0, 100))}${group.description.length > 100 ? '...' : ''}</p>
                <div class="text-xs text-gray-600 mb-1">
                    <span class="font-medium">Next:</span> ${escapeHTML(group.next_meeting)}
                </div>
                <div class="text-sm text-indigo-600 font-semibold">
                    ${group.members_count} member${group.members_count !== 1 ? 's' : ''}
                </div>
                <a href="study_group_detail.php?group_id=${group.group_id}&subjectTagColor=${encodeURIComponent(subjectBgColor)}" class="mt-4 inline-block bg-indigo-500 hover:bg-indigo-600 text-white text-center font-semibold py-2 px-4 rounded-lg transition duration-300 text-sm">
                    View Details
                </a>
            </div>
        `;
        studyGroupsContainer.insertAdjacentHTML('beforeend', groupCard);
    });
}

    function renderPagination(pagination) {
        paginationContainer.innerHTML = ''; // Clear previous pagination
        if (pagination.totalPages <= 1) {
            return; // No pagination needed for 0 or 1 page
        }

        // Previous Button
        let prevDisabled = pagination.currentPage === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-200';
        const prevButton = `
            <button data-page="${pagination.currentPage - 1}" class="pagination-link p-2 rounded-md text-gray-600 ${prevDisabled}" ${pagination.currentPage === 1 ? 'disabled' : ''}>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </button>
        `;
        paginationContainer.insertAdjacentHTML('beforeend', prevButton);

        // Page Number Buttons (simplified: show current, +/- 1, first, last)
        const pageRange = 2; // How many pages to show around current page
        let pagesHtml = '';

        for (let i = 1; i <= pagination.totalPages; i++) {
            if (i === pagination.currentPage) {
                pagesHtml += `<button data-page="${i}" class="pagination-link px-4 py-2 rounded-md bg-indigo-600 text-white font-medium" disabled>${i}</button>`;
            } else {
                 // Logic to limit number of page buttons shown
                if (i === 1 || i === pagination.totalPages || (i >= pagination.currentPage - pageRange && i <= pagination.currentPage + pageRange)) {
                    pagesHtml += `<button data-page="${i}" class="pagination-link px-4 py-2 rounded-md hover:bg-gray-200 text-gray-700">${i}</button>`;
                } else if ( (i === pagination.currentPage - pageRange - 1 && i > 1) || (i === pagination.currentPage + pageRange + 1 && i < pagination.totalPages) ) {
                     pagesHtml += `<span class="px-4 py-2 text-gray-700">...</span>`;
                }
            }
        }
        paginationContainer.insertAdjacentHTML('beforeend', pagesHtml);


        // Next Button
        let nextDisabled = pagination.currentPage === pagination.totalPages ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-200';
        const nextButton = `
            <button data-page="${pagination.currentPage + 1}" class="pagination-link p-2 rounded-md text-gray-600 ${nextDisabled}" ${pagination.currentPage === pagination.totalPages ? 'disabled' : ''}>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        `;
        paginationContainer.insertAdjacentHTML('beforeend', nextButton);

        // Add event listeners to new pagination links
        document.querySelectorAll('.pagination-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                if (this.disabled) return;
                const page = parseInt(this.getAttribute('data-page'));
                if (page && page !== currentPage) {
                    currentPage = page;
                    fetchStudyGroups(currentPage);
                     window.scrollTo({ top: studyGroupsContainer.offsetTop - 100, behavior: 'smooth' }); // Scroll to top of groups
                }
            });
        });
    }
    
    function escapeHTML(str) {
        if (str === null || str === undefined) return '';
        return str.toString().replace(/[&<>"']/g, function (match) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            }[match];
        });
    }

    // Initial fetch
    fetchStudyGroups(currentPage);

    // TODO: Add event listeners for search and filter elements to re-fetch study groups
    // const searchInput = document.getElementById('search-groups');
    // const subjectFilter = document.getElementById('group-subject-filter');
    // const sortSelect = document.getElementById('group-sort');
    // searchInput.addEventListener('input', () => fetchStudyGroups(1, searchInput.value, subjectFilter.value, sortSelect.value));
    // subjectFilter.addEventListener('change', () => fetchStudyGroups(1, searchInput.value, subjectFilter.value, sortSelect.value));
    // sortSelect.addEventListener('change', () => fetchStudyGroups(1, searchInput.value, subjectFilter.value, sortSelect.value));

    // Create Study Group Button redirect (if button exists)
    const createStudyGroupBtn = document.getElementById('createStudyGroupBtn');
    if(createStudyGroupBtn) {
        createStudyGroupBtn.addEventListener('click', function() {
            window.location.href = 'create_study_group.php'; 
        });
    }
});
</script>
</body>
</html>
