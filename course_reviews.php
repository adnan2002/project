<?php include 'header.php'; // User's original include
$is_auth = false;
if (isset($_SESSION['user_id'])) {
    $is_auth = true;
}

$current_page_from_url = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
if ($current_page_from_url < 1) {
    $current_page_from_url = 1;
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
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12v-.008ZM12 18h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75v-.008ZM9.75 18h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5v-.008ZM7.5 18h.008v.008H7.5v-.008ZM14.25 15h.008v.008H14.25v-.008ZM14.25 18h.008v.008H14.25v-.008ZM16.5 15h.008v.008H16.5v-.008ZM16.5 18h.008v.008H16.5v-.008Z" />
                                </svg>
                                Events Calendar
                            </a>
                        </li>
                        <li>
                            <a href="study_groups.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>
                                Study Group Finder
                            </a>
                        </li>
                        <li>
                            <a href="course_reviews.php" class="flex items-center text-indigo-600 bg-indigo-100 p-3 rounded-lg font-semibold transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.822.672l-4.684-2.79a.563.563 0 0 0-.652 0l-4.684 2.79a.562.562 0 0 1-.822-.672l1.285-5.385a.562.562 0 0 0-.182-.557l-4.204-3.602a.563.563 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                </svg>
                                Course Reviews
                            </a>
                        </li>
                         <li>
                            <a href="./course_notes.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Course Notes
                            </a>
                        </li>
                        <li>
                            <a href="./campus_news.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25H5.625a2.25 2.25 0 0 1-2.25-2.25V7.5c0-.621.504-1.125 1.125-1.125H9M7.5 11.25h.008v.008H7.5v-.008Zm0 3h.008v.008H7.5v-.008Zm0 3h.008v.008H7.5v-.008Z" />
                                </svg>
                                Campus News
                            </a>
                        </li>
                        <li>
                            <a href="club_activities.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 1.516M6.528 9.918A9 9 0 0 1 12.75 3.031m0 0a9 9 0 0 1 6.222 6.887M12.75 3.031a9 9 0 0 1-6.222 6.887m6.222-6.887L18.5 7.5M12.75 3.03V5.25m0 0A2.25 2.25 0 0 1 15 7.5v.208c0 .621.448 1.17.956 1.397l.703.422a2.25 2.25 0 0 1 .956 1.397V13.5A2.25 2.25 0 0 1 15 15.75v.208c0 .621-.448 1.17-.956 1.397l-.703.422a2.25 2.25 0 0 1-.956 1.397V21m-4.5 0V19.208c0-.621.448-1.17.956-1.397l.703-.422a2.25 2.25 0 0 1 .956-1.397V13.5A2.25 2.25 0 0 1 10.5 11.25v-.208c0-.621-.448-1.17-.956-1.397L8.84 9.23a2.25 2.25 0 0 1-.956-1.397V5.25A2.25 2.25 0 0 1 10.5 3m-3.75 0h7.5" />
                                </svg>
                                Club Activities
                            </a>
                        </li>
                        <li>
                            <a href="student_marketplace.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300">
                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                Student Marketplace
                            </a>
                        </li>
                    </ul>
                </nav>
            </aside>

            <div class="w-full md:w-3/4 lg:w-4/5">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 sm:mb-0">Course Reviews</h1>
                    <button onclick="handleWriteReview()" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-5 rounded-lg shadow-md transition duration-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Write a Review
                    </button>
                </div>

                <div class="mb-8 p-6 bg-white rounded-xl shadow-lg">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        <div class="md:col-span-1">
                            <label for="search-reviews" class="block text-sm font-medium text-gray-700 mb-1">Search courses or professors...</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </div>
                                <input type="search" id="search-reviews" class="w-full p-2 pl-10 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g., CS 102 or Prof. Adnan">
                            </div>
                        </div>
                        <div>
                            <label for="review-department" class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                            <select id="review-department" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                <option selected value="">All Departments</option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="MATHEMATICS">Mathematics</option>
                                <option value="BIOLOGY">Biology</option>
                                <option value="CHEMISTRY">Chemistry</option>
                                <option value="PHYSICS">Physics</option>
                                <option value="HISTORY">History</option>
                                <option value="PSYCHOLOGY">Psychology</option>
                            </select>
                        </div>
                        <div>
                            <label for="review-sort" class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                            <select id="review-sort" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                <option selected value="created_at_desc">Most Recent</option>
                                <option value="overall_rating_desc">Highest Rated</option>
                                <option value="overall_rating_asc">Lowest Rated</option>
                                </select>
                        </div>
                    </div>
                </div>

                <div id="course-reviews-container" class="space-y-6">
                    <div class="text-center py-10 text-gray-500">Loading reviews...</div>
                </div>

                <div id="pagination-controls" class="mt-12 flex justify-center items-center space-x-1 sm:space-x-2">
                    </div>
            </div>
        </div>
    </main>
</div>

<?php include 'footer.php'; // User's original include ?>

<script>
    function generate_stars(rating, max_stars = 5) {
        const full_star_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-yellow-400"><path fill-rule="evenodd" d="M10.868 2.884c.321-.772 1.415-.772 1.736 0l1.681 4.06c.064.155.195.278.358.325l4.422.644c.828.121 1.164 1.132.533 1.72l-3.209 3.126a.427.427 0 00-.122.38l.758 4.398c.139.813-.71.1.443-.386l-3.952-2.078a.427.427 0 00-.401 0l-3.952 2.078c-.63.33-.982-.033-.843-.843l.758-4.398a.427.427 0 00-.122-.38L2.613 9.753c-.63-.613-.295-1.599.533-1.72l4.422-.644a.427.427 0 00.358-.325l1.681-4.06z" clip-rule="evenodd" /></svg>';
        const empty_star_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-gray-300"><path fill-rule="evenodd" d="M10.868 2.884c.321-.772 1.415-.772 1.736 0l1.681 4.06c.064.155.195.278.358.325l4.422.644c.828.121 1.164 1.132.533 1.72l-3.209 3.126a.427.427 0 00-.122.38l.758 4.398c.139.813-.71.1.443-.386l-3.952-2.078a.427.427 0 00-.401 0l-3.952 2.078c-.63.33-.982-.033-.843-.843l.758-4.398a.427.427 0 00-.122-.38L2.613 9.753c-.63-.613-.295-1.599.533-1.72l4.422-.644a.427.427 0 00.358-.325l1.681-4.06z" clip-rule="evenodd" /></svg>';
        let stars_html = '';
        rating = parseFloat(rating); // Ensure rating is a number
        for (let i = 1; i <= max_stars; i++) {
            stars_html += (i <= Math.round(rating)) ? full_star_svg : empty_star_svg;
        }
        return stars_html;
    }

    function handleWriteReview() {
        const isAuth = <?php echo $is_auth ? 'true' : 'false'; ?>;
        if (isAuth) {
            window.location.href = 'write_review.php';
        } else {
            window.location.href = 'login.php';
        }
    }

    const reviewsContainer = document.getElementById('course-reviews-container');
    const paginationControls = document.getElementById('pagination-controls');
    let currentPageGlobal = <?php echo $current_page_from_url; ?>;

    async function fetchCourseReviews(page = 1) {
        reviewsContainer.innerHTML = '<div class="text-center py-10 text-gray-500"><svg class="animate-spin h-8 w-8 text-indigo-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><p class="mt-2">Loading reviews...</p></div>';
        try {
            // Assuming course_reviews.php is in the root and api/ is a subdirectory.
            const response = await fetch(`./api/v1/get_course_reviews.php?page=${page}`);
            if (!response.ok) {
                const errorData = await response.json().catch(() => ({ error: "Unknown server error" }));
                throw new Error(`HTTP error! status: ${response.status}, Message: ${errorData.error || response.statusText}`);
            }
            const result = await response.json();

            if (result.status === 'success' && result.data) {
                renderReviews(result.data);
                renderPagination(result.pagination);
                if (history.pushState) {
                    const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page=' + page;
                    window.history.pushState({path:newUrl}, '', newUrl);
                }
            } else {
                reviewsContainer.innerHTML = `<div class="text-center py-10 text-red-500">Failed to load reviews: ${result.error || 'No data returned'}</div>`;
            }
        } catch (error) {
            console.error('Error fetching course reviews:', error);
            reviewsContainer.innerHTML = `<div class="text-center py-10 text-red-500">Error fetching reviews: ${error.message}. Please try again.</div>`;
        }
    }

    function renderReviews(reviews) {
        reviewsContainer.innerHTML = '';
        if (reviews.length === 0) {
            reviewsContainer.innerHTML = '<div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md shadow-md"><div class="flex"><div class="flex-shrink-0"><svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 6a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 6zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg></div><div class="ml-3"><p class="text-sm text-yellow-700">No reviews found for this page. Try checking other pages or adjusting filters.</p></div></div></div>';
            return;
        }

        reviews.forEach(review => {
            // The API now returns 'individual_rating' which is the 'overall_rating' for that specific review.
            // It also returns 'reviewer_name' (e.g., Thomas L.) and 'reviewer_name_full'.
            // The API also returns 'course_title'.
            // The 'professor' field from your original mock data isn't in the DB schema.
            // I'll use "Reviewed by [Reviewer Name]" for now.

            const reviewCard = `
                <a href="course_review_detail.php?review_id=${review.review_id}" class="block course-review-card bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 no-underline">
                    <div class="flex flex-col sm:flex-row justify-between items-start mb-3">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">${sanitizeHTML(review.course_title)}</h3>
                            <p class="text-sm text-gray-600">${sanitizeHTML(review.course_code)} &bull; </p>
                        </div>
                        <div class="mt-2 sm:mt-0 bg-green-100 text-green-700 font-bold text-sm px-3 py-1 rounded-full">
                            ${parseFloat(review.individual_rating).toFixed(1)} / 5
                        </div>
                    </div>
                    <blockquote class="text-gray-700 italic text-sm border-l-4 border-gray-200 pl-4 py-2 my-3">
                        ${sanitizeHTML(review.review_snippet)}
                    </blockquote>
                    <div class="flex flex-col sm:flex-row justify-between items-start text-sm text-gray-600 mb-3">
                        <span>By ${sanitizeHTML(review.reviewer_name)} &bull; ${sanitizeHTML(review.reviewer_term)}</span>
                        <div class="flex items-center mt-1 sm:mt-0">
                            ${generate_stars(review.individual_rating)}
                            <span class="ml-1">(${parseFloat(review.individual_rating).toFixed(1)})</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center text-xs text-gray-500 mt-2">
                        <span>Would take again: <span class="font-semibold ${review.would_take_again == 1 ? 'text-green-600' : 'text-red-600'}">${review.would_take_again == 1 ? 'Yes' : 'No'}</span></span>
                        </div>
                </a>
            `;
            reviewsContainer.innerHTML += reviewCard;
        });
    }

    function renderPagination(pagination) {
        paginationControls.innerHTML = '';
        const { currentPage, totalPages } = pagination;
        currentPageGlobal = parseInt(currentPage);

        if (totalPages <= 1) return;

        let paginationHTML = '';
        const pageUrlBase = "course_reviews.php?page=";

        paginationHTML += `
            <a href="${currentPageGlobal > 1 ? pageUrlBase + (currentPageGlobal - 1) : '#'}" class="p-2 rounded-md ${currentPageGlobal === 1 ? 'text-gray-400 cursor-not-allowed' : 'hover:bg-gray-200 text-gray-600'} pagination-link" data-page="${currentPageGlobal - 1}" ${currentPageGlobal === 1 ? 'aria-disabled="true" tabindex="-1"' : ''}>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" /></svg>
            </a>`;

        const maxPagesToShow = 5;
        let startPage = Math.max(1, currentPageGlobal - Math.floor(maxPagesToShow / 2));
        let endPage = Math.min(totalPages, startPage + maxPagesToShow - 1);
        if (totalPages > maxPagesToShow && endPage - startPage + 1 < maxPagesToShow) {
            startPage = Math.max(1, endPage - maxPagesToShow + 1);
        }
        
        if (startPage > 1) {
            paginationHTML += `<a href="${pageUrlBase}1" class="px-3 py-1 sm:px-4 sm:py-2 rounded-md hover:bg-gray-200 text-gray-700 pagination-link" data-page="1">1</a>`;
            if (startPage > 2) {
                paginationHTML += `<span class="px-3 py-1 sm:px-4 sm:py-2 text-gray-700">...</span>`;
            }
        }

        for (let i = startPage; i <= endPage; i++) {
            paginationHTML += `
                <a href="${pageUrlBase}${i}" class="px-3 py-1 sm:px-4 sm:py-2 rounded-md pagination-link ${i === currentPageGlobal ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-gray-200 text-gray-700'}" data-page="${i}">${i}</a>`;
        }

        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                paginationHTML += `<span class="px-3 py-1 sm:px-4 sm:py-2 text-gray-700">...</span>`;
            }
            paginationHTML += `<a href="${pageUrlBase}${totalPages}" class="px-3 py-1 sm:px-4 sm:py-2 rounded-md hover:bg-gray-200 text-gray-700 pagination-link" data-page="${totalPages}">${totalPages}</a>`;
        }

        paginationHTML += `
            <a href="${currentPageGlobal < totalPages ? pageUrlBase + (currentPageGlobal + 1) : '#'}" class="p-2 rounded-md ${currentPageGlobal === totalPages ? 'text-gray-400 cursor-not-allowed' : 'hover:bg-gray-200 text-gray-600'} pagination-link" data-page="${currentPageGlobal + 1}" ${currentPageGlobal === totalPages ? 'aria-disabled="true" tabindex="-1"' : ''}>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
            </a>`;
        paginationControls.innerHTML = paginationHTML;

        document.querySelectorAll('.pagination-link').forEach(link => {
            link.addEventListener('click', function(e) {
                // Allow default navigation for href, but also fetch via JS if preferred for SPA-like feel
                // For this setup, let's rely on href for simplicity and state management via URL
                const page = parseInt(this.dataset.page);
                 if (this.getAttribute('aria-disabled') === 'true') {
                    e.preventDefault(); // Prevent action on disabled links
                    return;
                }
                // If you want full JS navigation without page reload:
                // e.preventDefault();
                // if (page && page !== currentPageGlobal && page >= 1 && page <= totalPages) {
                //     fetchCourseReviews(page);
                // }
            });
        });
    }
    
    function sanitizeHTML(str) {
        if (str === null || typeof str === 'undefined') return '';
        const temp = document.createElement('div');
        temp.textContent = str;
        return temp.innerHTML;
    }

    document.addEventListener('DOMContentLoaded', () => {
        fetchCourseReviews(currentPageGlobal);
    });
</script>
</body>
</html>