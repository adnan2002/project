<?php
// course_review_detail.php

include 'header.php';
// Get review_id from URL. Critical for fetching data.
$review_id_from_url = isset($_GET['review_id']) && filter_var($_GET['review_id'], FILTER_VALIDATE_INT)
    ? (int)$_GET['review_id']
    : 0;

// Initial $review_detail structure for placeholders until JS loads
$review_detail_placeholder = [
    'id' => $review_id_from_url,
    'course_title' => 'Loading...',
    'course_code' => '---',
    'overall_rating' => 0, // Course overall rating (from stats API)
    'total_reviews_count' => 0, // (from stats API)
    'reviewer_name' => 'Loading...',
    'review_term' => '---',
    'individual_rating' => 0,
    'difficulty' => '---',
    'difficulty_value' => 0,
    'workload' => '---',
    'workload_value' => 0,
    'would_take_again' => false,
    'attendance_required' => false,
    'review_text' => '<p>Loading review content...</p>', // Combined text
    'pros' => [],
    'cons' => [],
    'advice' => 'Loading advice...',
    'helpful_yes_count' => 0,
    'helpful_no_count' => 0,
    // These will be populated by a separate API call for course_stats
    'course_stats' => [
        'rating_distribution' => ['5' => 0, '4' => 0, '3' => 0, '2' => 0, '1' => 0],
        'would_take_again_percentage' => 0,
        'difficulty_level_value' => 0,
        'difficulty_level_text' => 'N/A',
    ],
    'other_reviews' => [],
    'page_comments' => []
];
$review_detail = $review_detail_placeholder; // Use placeholder initially


function display_stars_php($rating, $color = 'text-yellow-400', $size = 'w-5 h-5') {
    $output = '<div class="flex items-center">';
    for ($i = 1; $i <= 5; $i++) {
        $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="' . $size . ' ' . ($i <= round($rating) ? $color : 'text-gray-300') . '">';
        $output .= '<path fill-rule="evenodd" d="M10.868 2.884c.321-.772 1.415-.772 1.736 0l1.681 4.06c.064.155.195.278.358.325l4.422.644c.828.121 1.164 1.132.533 1.72l-3.209 3.126a.427.427 0 00-.122.38l.758 4.398c.139.813-.71.1.443-.386l-3.952-2.078a.427.427 0 00-.401 0l-3.952 2.078c-.63.33-.982-.033-.843-.843l.758-4.398a.427.427 0 00-.122-.38L2.613 9.753c-.63-.613-.295-1.599.533-1.72l4.422-.644a.427.427 0 00.358-.325l1.681-4.06z" clip-rule="evenodd" /></svg>';
    }
    $output .= '<span class="ml-1 text-sm text-gray-600">(' . number_format(floatval($rating), 1) . ')</span></div>';
    return $output;
}

$is_auth = isset($_SESSION['user_id']); // Simplified
$current_user_id = $is_auth ? $_SESSION['user_id'] : 0;
?>

<div class="flex flex-col min-h-screen">
    <main class="flex-grow container mx-auto px-4 py-8 md:py-12">
        <div class="flex flex-col md:flex-row gap-8">
            <aside class="w-full md:w-1/4 lg:w-1/5 bg-white p-6 rounded-xl shadow-lg self-start">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Modules</h2>
                <nav>
                     <ul class="space-y-3">
                        <li><a href="events.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12v-.008ZM12 18h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75v-.008ZM9.75 18h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5v-.008ZM7.5 18h.008v.008H7.5v-.008ZM14.25 15h.008v.008H14.25v-.008ZM14.25 18h.008v.008H14.25v-.008ZM16.5 15h.008v.008H16.5v-.008ZM16.5 18h.008v.008H16.5v-.008Z" /></svg>Events Calendar</a></li>
                        <li><a href="study_groups.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" /></svg>Study Group Finder</a></li>
                        <li><a href="course_reviews.php" class="flex items-center text-indigo-600 bg-indigo-100 p-3 rounded-lg font-semibold transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.822.672l-4.684-2.79a.563.563 0 0 0-.652 0l-4.684 2.79a.562.562 0 0 1-.822-.672l1.285-5.385a.562.562 0 0 0-.182-.557l-4.204-3.602a.563.563 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" /></svg>Course Reviews</a></li>
                        <li><a href="course_notes.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>Course Notes</a></li>
                        <li><a href="campus_news.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25H5.625a2.25 2.25 0 0 1-2.25-2.25V7.5c0-.621.504-1.125 1.125-1.125H9M7.5 11.25h.008v.008H7.5v-.008Zm0 3h.008v.008H7.5v-.008Zm0 3h.008v.008H7.5v-.008Z" /></svg>Campus News</a></li>
                        <li><a href="club_activities.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 1.516M6.528 9.918A9 9 0 0 1 12.75 3.031m0 0a9 9 0 0 1 6.222 6.887M12.75 3.031a9 9 0 0 1-6.222 6.887m6.222-6.887L18.5 7.5M12.75 3.03V5.25m0 0A2.25 2.25 0 0 1 15 7.5v.208c0 .621.448 1.17.956 1.397l.703.422a2.25 2.25 0 0 1 .956 1.397V13.5A2.25 2.25 0 0 1 15 15.75v.208c0 .621-.448 1.17-.956 1.397l-.703.422a2.25 2.25 0 0 1-.956 1.397V21m-4.5 0V19.208c0-.621.448-1.17.956-1.397l.703-.422a2.25 2.25 0 0 1 .956-1.397V13.5A2.25 2.25 0 0 1 10.5 11.25v-.208c0-.621-.448-1.17-.956-1.397L8.84 9.23a2.25 2.25 0 0 1-.956-1.397V5.25A2.25 2.25 0 0 1 10.5 3m-3.75 0h7.5" /></svg>Club Activities</a></li>
                        <li><a href="student_marketplace.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>Student Marketplace</a></li>
                    </ul>
                </nav>
            </aside>

            <div class="w-full md:w-3/4 lg:w-4/5" id="review-detail-content-wrapper">
                <div class="text-center py-20">
                    <svg class="animate-spin h-10 w-10 text-indigo-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    <p class="mt-4 text-gray-500">Loading review details...</p>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include 'footer.php'; ?>

<script>
    const reviewIdFromPHP = <?php echo $review_id_from_url; ?>;
    const isUserAuthenticated = <?php echo json_encode($is_auth); ?>;
    const currentUserId = <?php echo json_encode($current_user_id); ?>;

    // Helper function to safely get data or return a default
    function getData(dataObj, key, defaultValue = '') {
        return dataObj && typeof dataObj[key] !== 'undefined' && dataObj[key] !== null ? dataObj[key] : defaultValue;
    }
    function getNumericData(dataObj, key, defaultValue = 0) {
        const val = dataObj && typeof dataObj[key] !== 'undefined' && dataObj[key] !== null ? parseFloat(dataObj[key]) : defaultValue;
        return isNaN(val) ? defaultValue : val;
    }
    function getBoolData(dataObj, key, defaultValue = false) {
        return dataObj && typeof dataObj[key] !== 'undefined' && dataObj[key] !== null ? Boolean(dataObj[key]) : defaultValue;
    }

    function parseProsCons(textInput) {
        let textToParse = textInput;
        if (Array.isArray(textInput) && textInput.length === 1 && typeof textInput[0] === 'string') {
            textToParse = textInput[0];
        } else if (typeof textInput !== 'string') {
            return [];
        }
        if (textToParse.trim() === '') {
            return [];
        }
        const items = [];
        const lines = textToParse.split(/\r?\n/); 
        lines.forEach((line) => {
            if (line.trim() === '') return;
            const points = line.split(';');
            points.forEach((point) => {
                const trimmedPoint = point.trim();
                if (trimmedPoint) {
                    items.push(trimmedPoint);
                }
            });
        });
        return items;
    }

    function display_stars_js(rating, color = 'text-yellow-400', size = 'w-5 h-5') {
        let output = '<div class="flex items-center">';
        rating = parseFloat(rating);
        for (let i = 1; i <= 5; i++) {
            output += `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="${size} ${i <= Math.round(rating) ? color : 'text-gray-300'}">`;
            output += '<path fill-rule="evenodd" d="M10.868 2.884c.321-.772 1.415-.772 1.736 0l1.681 4.06c.064.155.195.278.358.325l4.422.644c.828.121 1.164 1.132.533 1.72l-3.209 3.126a.427.427 0 00-.122.38l.758 4.398c.139.813-.71.1.443-.386l-3.952-2.078a.427.427 0 00-.401 0l-3.952 2.078c-.63.33-.982-.033-.843-.843l.758-4.398a.427.427 0 00-.122-.38L2.613 9.753c-.63-.613-.295-1.599.533-1.72l4.422-.644a.427.427 0 00.358-.325l1.681-4.06z" clip-rule="evenodd" /></svg>';
        }
        output += `<span class="ml-1 text-sm text-gray-600">(${Number(rating).toFixed(1)})</span></div>`;
        return output;
    }

    function sanitizeHTML(str) {
        if (str === null || typeof str === 'undefined') return '';
        const temp = document.createElement('div');
        temp.textContent = str;
        return temp.innerHTML;
    }

    async function fetchReviewData(reviewId) {
        console.log(`[JS LOG] Attempting to fetch data for reviewId: ${reviewId}`);
        const contentWrapper = document.getElementById('review-detail-content-wrapper');
        contentWrapper.innerHTML = `<div class="text-center py-20"><svg class="animate-spin h-10 w-10 text-indigo-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><p class="mt-4 text-gray-500">Loading review details...</p></div>`;

        if (!reviewId) {
            console.error("[JS LOG] fetchReviewData: Review ID is missing or invalid before API call.");
            contentWrapper.innerHTML = '<p class="text-red-500 text-center py-10">Error: Review ID is missing.</p>';
            return;
        }

        try {
            const response = await fetch(`./api/v1/get_review_detail.php?review_id=${reviewId}`);
            console.log(`[JS LOG] API call to get_review_detail.php - Status: ${response.status}`);

            if (!response.ok) {
                const errorText = await response.text(); // Attempt to get raw error text
                console.error(`[JS LOG] API HTTP error! Status: ${response.status}, Response Text: ${errorText}`);
                // Try to parse as JSON if it might be a structured error from sendJsonResponse
                let errorDetail = `HTTP error ${response.status}.`;
                try {
                    const jsonError = JSON.parse(errorText);
                    if (jsonError && jsonError.error) {
                        errorDetail = jsonError.error;
                    }
                } catch (e) {
                    // Not a JSON error, use the raw text if it's short, or a generic message
                    errorDetail = errorText.length < 100 ? errorText : `Server error ${response.status}. Check console for details.`;
                }
                throw new Error(errorDetail);
            }
            
            const result = await response.json();
            console.log("[JS LOG] API Response from get_review_detail.php (parsed JSON):", result);


            if (result.status === 'success' && result.data) {
                const reviewData = result.data;
                console.log("[JS LOG] Successfully fetched main review data. Course code:", reviewData.course_code);

                const [statsResult, otherReviewsResult, commentsResult] = await Promise.all([
                    fetch(`./api/v1/get_course_statistics.php?course_code=${reviewData.course_code}`).then(res => res.json()),
                    fetch(`./api/v1/get_other_reviews_for_course.php?course_code=${reviewData.course_code}&exclude_review_id=${reviewId}&limit=2`).then(res => res.json()),
                    fetch(`./api/v1/get_review_comments.php?review_id=${reviewId}`).then(res => res.json())
                ]);
                
                console.log("[JS LOG] Course Stats API response:", statsResult);
                console.log("[JS LOG] Other Reviews API response:", otherReviewsResult);
                console.log("[JS LOG] Comments API response:", commentsResult);

                const courseStats = statsResult.status === 'success' ? statsResult.data : null;
                const otherReviews = otherReviewsResult.status === 'success' ? otherReviewsResult.data : [];
                const pageComments = commentsResult.status === 'success' ? commentsResult.data : [];
                
                renderReviewDetail(reviewData, courseStats, otherReviews, pageComments);
            } else {
                console.error("[JS LOG] API status not 'success' or data missing. Result:", result);
                throw new Error(result.error || 'Failed to load review details from API.');
            }
        } catch (error) {
            console.error('[JS LOG] Error in fetchReviewData catch block:', error);
            contentWrapper.innerHTML = `<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative text-center" role="alert">
                                            <strong class="font-bold">Error Loading Review!</strong><br>
                                            <span class="block sm:inline">${sanitizeHTML(error.message)}</span><br>
                                            <span class="block sm:inline text-xs">Please check the console for more details or contact support if the issue persists.</span>
                                        </div>`;
        }
    }

    function renderReviewDetail(review, courseStats, otherReviews, pageComments) {
        // ... (rest of renderReviewDetail as in your previous version - it should be fine)
        // Ensure it uses the corrected parseProsCons
        const wrapper = document.getElementById('review-detail-content-wrapper');
        
        const stats = courseStats || {
            overall_rating_avg: review.individual_rating, 
            total_reviews_count: 1, 
            rating_distribution: {'5':0,'4':0,'3':0,'2':0,'1':0},
            would_take_again_percentage: review.would_take_again ? 100 : 0,
            difficulty_level_value: review.difficulty_value,
            difficulty_level_text: review.difficulty
        };
        
        let reviewTextHTML = '';
        if (review.review_text) {
            const paragraphs = review.review_text.split(/\n\s*\n/);
            paragraphs.forEach(p => {
                reviewTextHTML += `<p>${sanitizeHTML(p)}</p>`;
            });
        }

        const prosArray = parseProsCons(review.pros); // Uses the corrected parseProsCons
        let prosHTML = '';
        if (prosArray.length > 0) {
            prosArray.forEach(pro => prosHTML += `<li>${sanitizeHTML(pro)}</li>`);
        } else {
            prosHTML = '<li>No pros listed.</li>';
        }

        const consArray = parseProsCons(review.cons); // Uses the corrected parseProsCons
        let consHTML = '';
        if (consArray.length > 0) {
            consArray.forEach(con => consHTML += `<li>${sanitizeHTML(con)}</li>`);
        } else {
            consHTML = '<li>No cons listed.</li>';
        }
        
        let ratingDistributionHTML = '';
        if (stats.rating_distribution) {
            for (let star = 5; star >= 1; star--) {
                const percent = stats.rating_distribution[String(star)] || 0;
                ratingDistributionHTML += `
                <div class="flex items-center mb-1">
                    <span class="text-xs w-6 text-gray-500">${star}★</span>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 ml-1">
                        <div class="bg-yellow-400 h-2.5 rounded-full" style="width: ${percent}%"></div>
                    </div>
                    <span class="text-xs w-8 text-right text-gray-500 ml-1">${percent}%</span>
                </div>`;
            }
        }

        let otherReviewsHTML = '';
        if (otherReviews && otherReviews.length > 0) {
            otherReviews.forEach(or => {
                otherReviewsHTML += `
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-1">
                        <span class="font-semibold text-gray-700 text-sm">${sanitizeHTML(or.reviewer_name)} &bull; <span class="text-xs text-gray-500">${sanitizeHTML(or.review_term)}</span></span>
                        ${display_stars_js(getNumericData(or, 'rating'), 'text-yellow-400', 'w-4 h-4')}
                    </div>
                    <p class="text-sm text-gray-600 line-clamp-2">${sanitizeHTML(or.snippet)}</p>
                    <a href="course_review_detail.php?review_id=${or.id}" class="text-xs text-indigo-600 hover:underline mt-1 inline-block">Read more</a>
                </div>`;
            });
        } else {
            otherReviewsHTML = '<p class="text-sm text-gray-500">No other reviews for this course yet.</p>';
        }

        let commentsHTML = '';
         if (pageComments && pageComments.length > 0) {
            pageComments.forEach(comment => {
                const avatarColors = ['bg-blue-400', 'bg-green-400', 'bg-red-400', 'bg-yellow-400', 'bg-purple-400', 'bg-pink-400'];
                const avatarBg = comment.avatar_bg || avatarColors[comment.user_id % avatarColors.length];

                commentsHTML += `
                <div class="comment-item" data-comment-id="${comment.id}">
                    <div class="flex items-start">
                        <div class="w-10 h-10 ${avatarBg} text-white flex items-center justify-center rounded-full text-lg font-bold mr-3 flex-shrink-0">
                            ${sanitizeHTML(comment.initials)}
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg flex-grow">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-semibold text-gray-800 text-sm">${sanitizeHTML(comment.name)}</span>
                                <span class="text-xs text-gray-500">${sanitizeHTML(comment.time_ago)}</span>
                            </div>
                            <p class="text-gray-700 text-sm">${sanitizeHTML(comment.text)}</p>
                            <div class="mt-2 text-xs">
                                <button class="text-indigo-600 hover:underline vote-comment-btn" data-comment-id="${comment.id}">Helpful (<span class="comment-helpful-count">${comment.helpful_count || 0}</span>)</button>
                            </div>
                        </div>
                    </div>
                </div>`;
            });
        } else {
            commentsHTML = '<p class="text-sm text-gray-500" id="no-comments-message">No comments yet. Be the first to comment!</p>';
        }

        wrapper.innerHTML = `
            <div class="mb-6">
                <a href="course_reviews.php" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 transition duration-300 group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                    Back to Course Reviews
                </a>
            </div>

            <article class="bg-white p-6 md:p-8 rounded-xl shadow-xl">
                <div class="flex flex-col sm:flex-row justify-between items-start mb-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">${sanitizeHTML(review.course_title)}</h1>
                        <p class="text-sm text-gray-500">${sanitizeHTML(review.course_code)} &bull; ${sanitizeHTML(review.professor_name)}</p>
                    </div>
                    <div class="mt-2 sm:mt-0 flex items-center bg-green-100 text-green-700 font-bold text-sm px-3 py-1.5 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 mr-1"><path fill-rule="evenodd" d="M10.868 2.884c.321-.772 1.415-.772 1.736 0l1.681 4.06c.064.155.195.278.358.325l4.422.644c.828.121 1.164 1.132.533 1.72l-3.209 3.126a.427.427 0 00-.122.38l.758 4.398c.139.813-.71.1.443-.386l-3.952-2.078a.427.427 0 00-.401 0l-3.952 2.078c-.63.33-.982-.033-.843-.843l.758-4.398a.427.427 0 00-.122-.38L2.613 9.753c-.63-.613-.295-1.599.533-1.72l4.422-.644a.427.427 0 00.358-.325l1.681-4.06z" clip-rule="evenodd" /></svg>
                        ${getNumericData(stats, 'overall_rating_avg', review.individual_rating).toFixed(1)} / 5
                    </div>
                </div>
                <p class="text-xs text-gray-500 mb-6">Based on ${stats.total_reviews_count} reviews</p>

                <div class="border-t border-b border-gray-200 py-6 mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="text-xl font-semibold text-gray-800">Review by ${sanitizeHTML(review.reviewer_name)}</h2>
                        <span class="text-sm text-gray-500">${sanitizeHTML(review.review_term)}</span>
                    </div>
                    ${display_stars_js(getNumericData(review, 'individual_rating'))}
                    
                    <div class="grid grid-cols-2 gap-x-6 gap-y-4 mt-4 text-sm">
                        <div>
                            <label class="block text-gray-500 mb-1">Difficulty</label>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-yellow-400 h-2.5 rounded-full" style="width: ${ (getNumericData(review, 'difficulty_value') / 5 * 100).toFixed(0) }%"></div>
                            </div>
                            <p class="text-xs text-gray-500 text-right mt-1">${sanitizeHTML(review.difficulty)}</p>
                        </div>
                        <div>
                            <label class="block text-gray-500 mb-1">Workload</label>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-yellow-400 h-2.5 rounded-full" style="width: ${ (getNumericData(review, 'workload_value') / 5 * 100).toFixed(0) }%"></div>
                            </div>
                            <p class="text-xs text-gray-500 text-right mt-1">${sanitizeHTML(review.workload)}</p>
                        </div>
                        <div>
                            <span class="text-gray-500">Would take again:</span>
                            <span class="font-semibold ${getBoolData(review, 'would_take_again') ? 'text-green-600' : 'text-red-600'}">
                                ${getBoolData(review, 'would_take_again') ? 'Yes' : 'No'}
                            </span>
                        </div>
                        <div>
                            <span class="text-gray-500">Attendance:</span>
                            <span class="font-semibold text-gray-700">
                                ${getBoolData(review, 'attendance_required') ? 'Required' : 'Not Required'}
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="prose max-w-none text-gray-700 leading-relaxed mb-6">
                    ${reviewTextHTML}
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-green-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-green-700 mb-2">Pros</h4>
                        <ul class="list-disc list-inside text-sm text-green-600 space-y-1">${prosHTML}</ul>
                    </div>
                    <div class="bg-red-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-red-700 mb-2">Cons</h4>
                        <ul class="list-disc list-inside text-sm text-red-600 space-y-1">${consHTML}</ul>
                    </div>
                </div>

                <div class="bg-blue-50 p-4 rounded-lg mb-6">
                    <h4 class="font-semibold text-blue-700 mb-2">Advice for Future Students</h4>
                    <p class="text-sm text-blue-600">${sanitizeHTML(review.advice)}</p>
                </div>

                <div class="text-sm text-gray-600 mb-8 text-center">
                    <span>Was this review helpful?</span>
                    <button id="vote-review-yes" class="ml-2 text-indigo-600 hover:underline">Yes (<span id="helpful-yes-count">${review.helpful_yes_count}</span>)</button>
                    <button id="vote-review-no" class="ml-2 text-red-600 hover:underline">No (<span id="helpful-no-count">${review.helpful_no_count}</span>)</button>
                </div>
                
                <div class="border-t border-gray-200 pt-8 mb-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Course Statistics</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-700 mb-2 text-sm">Rating Distribution</h4>
                            ${ratingDistributionHTML}
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg flex flex-col items-center justify-center">
                            <h4 class="font-semibold text-gray-700 mb-2 text-sm">Would Take Again</h4>
                            <div class="relative w-24 h-24">
                                <svg class="w-full h-full" viewBox="0 0 36 36">
                                    <path class="text-gray-200" stroke-width="3" fill="none" stroke="currentColor" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path class="text-green-500" stroke-width="3" fill="none" stroke-dasharray="${getNumericData(stats, 'would_take_again_percentage')}, 100" stroke-linecap="round" stroke="currentColor" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center text-xl font-bold text-green-600">
                                    ${getNumericData(stats, 'would_take_again_percentage')}%
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg flex flex-col items-center justify-center">
                            <h4 class="font-semibold text-gray-700 mb-2 text-sm">Difficulty Level</h4>
                            <div class="text-3xl font-bold text-yellow-500">${getNumericData(stats, 'difficulty_level_value').toFixed(1)}</div>
                            <div class="text-xs text-gray-500">out of 5</div>
                            <div class="text-sm text-gray-600 mt-1">${sanitizeHTML(stats.difficulty_level_text)}</div>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-8 mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-semibold text-gray-800">Other Reviews (<span id="other-reviews-count">${otherReviews.length}</span>)</h3>
                        <a href="course_reviews.php?course_code=${sanitizeHTML(review.course_code)}" class="text-sm text-indigo-600 hover:underline">View All</a>
                    </div>
                    <div class="space-y-4" id="other-reviews-container">
                        ${otherReviewsHTML}
                    </div>
                </div>
                
                <div class="border-t border-gray-200 pt-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Comments (<span id="page-comments-count">${pageComments.length}</span>)</h3>
                    <div class="space-y-6 mb-8" id="comments-container">
                        ${commentsHTML}
                    </div>
                    <div id="add-comment-section">
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Add a Comment</h4>
                        <form id="add-comment-form">
                            <input type="hidden" name="review_id" value="${review.review_id}">
                            <div class="flex items-start mb-3">
                                <div class="w-10 h-10 bg-gray-300 text-gray-500 flex items-center justify-center rounded-full text-lg mr-3 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z" clip-rule="evenodd" /></svg>
                                </div>
                                <textarea name="comment_text" id="comment_text_input" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Write your comment or question..."></textarea>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-300">Post Comment</button>
                            </div>
                        </form>
                         <p id="comment-form-message" class="text-sm mt-2"></p>
                    </div>
                </div>
            </article>
        `;
        addEventListeners(); 
        setInitialVoteButtonStates(review.current_user_vote, review.helpful_yes_count, review.helpful_no_count);
    }
    
    function setInitialVoteButtonStates(currentUserVote, yesCount, noCount) {
        const voteYesBtn = document.getElementById('vote-review-yes');
        const voteNoBtn = document.getElementById('vote-review-no');
        const yesCountSpan = document.getElementById('helpful-yes-count');
        const noCountSpan = document.getElementById('helpful-no-count');

        if(yesCountSpan) yesCountSpan.textContent = yesCount;
        if(noCountSpan) noCountSpan.textContent = noCount;

        if (voteYesBtn && voteNoBtn) {
            // Reset styles
            voteYesBtn.classList.remove('text-green-600', 'font-semibold', 'border', 'border-green-600', 'px-2', 'py-1', 'rounded-md'); // Added rounded-md for consistency
            voteYesBtn.classList.add('text-indigo-600');
            voteNoBtn.classList.remove('text-red-700', 'font-semibold', 'border', 'border-red-700', 'px-2', 'py-1', 'rounded-md');
            voteNoBtn.classList.add('text-red-600');


            if (currentUserVote === 'yes') {
                voteYesBtn.classList.add('text-green-600', 'font-semibold', 'border', 'border-green-600', 'px-2', 'py-1', 'rounded-md');
                voteYesBtn.classList.remove('text-indigo-600');
            } else if (currentUserVote === 'no') {
                voteNoBtn.classList.add('text-red-700', 'font-semibold', 'border', 'border-red-700', 'px-2', 'py-1', 'rounded-md');
                voteNoBtn.classList.remove('text-red-600'); 
            }
        }
    }

    function addEventListeners() {
        const voteYesBtn = document.getElementById('vote-review-yes');
        const voteNoBtn = document.getElementById('vote-review-no'); 
        
        if (voteYesBtn) {
            voteYesBtn.addEventListener('click', () => handleVoteReview(reviewIdFromPHP, 'yes'));
        }
        if (voteNoBtn) { 
            voteNoBtn.addEventListener('click', () => handleVoteReview(reviewIdFromPHP, 'no'));
        }

        const commentForm = document.getElementById('add-comment-form');
        if (commentForm) {
            commentForm.addEventListener('submit', handleAddComment);
        }
        
        const commentsContainer = document.getElementById('comments-container');
        if (commentsContainer) {
            commentsContainer.addEventListener('click', function(event) {
                const button = event.target.closest('.vote-comment-btn');
                if (button) {
                    const commentId = button.dataset.commentId;
                    handleVoteReviewComment(commentId);
                }
            });
        }
    }

    async function handleVoteReview(reviewId, voteType) {
        if (!isUserAuthenticated) {
            alert("Please login to vote.");
            window.location.href = 'login.php';
            return;
        }
        try {
            const response = await fetch('./api/v1/vote_on_review.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ review_id: reviewId, vote_type: voteType }) 
            });
            const result = await response.json();
            if (result.status === 'success') {
                setInitialVoteButtonStates(result.current_user_vote_status, result.new_helpful_count, result.new_unhelpful_count);
            } else {
                 alert(`Error: ${result.error || 'Could not process vote.'}`);
            }
        } catch (error) {
            console.error('Error voting on review:', error);
            alert('An error occurred while voting.');
        }
    }

    async function handleAddComment(event) {
        event.preventDefault();
        if (!isUserAuthenticated) {
            alert("Please login to comment.");
             window.location.href = 'login.php';
            return;
        }
        const form = event.target;
        const reviewId = form.review_id.value;
        const commentText = form.comment_text.value.trim();
        const messageEl = document.getElementById('comment-form-message');

        if (!commentText) {
            messageEl.textContent = 'Comment text cannot be empty.';
            messageEl.className = 'text-sm mt-2 text-red-600';
            return;
        }
        messageEl.textContent = 'Posting...';
        messageEl.className = 'text-sm mt-2 text-gray-600';

        try {
            const response = await fetch('./api/v1/add_review_comment.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ review_id: reviewId, comment_text: commentText })
            });
            const result = await response.json();
            if (result.status === 'success' && result.comment) {
                messageEl.textContent = 'Comment posted successfully!';
                messageEl.className = 'text-sm mt-2 text-green-600';
                form.reset();
                
                const newCommentData = result.comment;
                const commentsContainer = document.getElementById('comments-container');
                const noCommentsMsg = document.getElementById('no-comments-message');
                if(noCommentsMsg) noCommentsMsg.remove();

                const avatarColors = ['bg-blue-400', 'bg-green-400', 'bg-red-400', 'bg-yellow-400', 'bg-purple-400', 'bg-pink-400'];
                const userColorIndex = newCommentData.user_id ? newCommentData.user_id % avatarColors.length : Math.floor(Math.random() * avatarColors.length);
                const avatarBg = newCommentData.avatar_bg || avatarColors[userColorIndex];

                const commentHTML = `
                <div class="comment-item" data-comment-id="${newCommentData.comment_id}">
                    <div class="flex items-start">
                        <div class="w-10 h-10 ${avatarBg} text-white flex items-center justify-center rounded-full text-lg font-bold mr-3 flex-shrink-0">
                            ${sanitizeHTML(newCommentData.commenter_initials)}
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg flex-grow">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-semibold text-gray-800 text-sm">${sanitizeHTML(newCommentData.commenter_name)}</span>
                                <span class="text-xs text-gray-500">Just now</span>
                            </div>
                            <p class="text-gray-700 text-sm">${sanitizeHTML(newCommentData.comment_text)}</p>
                             <div class="mt-2 text-xs">
                                <button class="text-indigo-600 hover:underline vote-comment-btn" data-comment-id="${newCommentData.comment_id}">Helpful (<span class="comment-helpful-count">${newCommentData.helpful_count || 0}</span>)</button>
                            </div>
                        </div>
                    </div>
                </div>`;
                commentsContainer.insertAdjacentHTML('beforeend', commentHTML);
                document.getElementById('page-comments-count').textContent = parseInt(document.getElementById('page-comments-count').textContent) + 1;
            } else {
                throw new Error(result.error || 'Failed to post comment.');
            }
        } catch (error) {
            console.error('Error adding comment:', error);
            messageEl.textContent = `Error: ${error.message}`;
            messageEl.className = 'text-sm mt-2 text-red-600';
        }
    }
    
    async function handleVoteReviewComment(commentId) {
        if (!isUserAuthenticated) {
            alert("Please login to vote on comments.");
            window.location.href = 'login.php';
            return;
        }
        try {
            const response = await fetch('./api/v1/vote_review_comment.php', { 
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ comment_id: commentId })
            });
            const result = await response.json();
            if (result.status === 'success') {
                const commentDiv = document.querySelector(`.comment-item[data-comment-id="${commentId}"]`);
                if (commentDiv) {
                    const countSpan = commentDiv.querySelector('.comment-helpful-count');
                    if (countSpan) countSpan.textContent = result.new_helpful_count;
                    const voteButton = commentDiv.querySelector('.vote-comment-btn');
                    if (voteButton) {
                        // Reset styles
                        voteButton.classList.remove('text-green-600', 'font-semibold', 'text-indigo-600');
                        
                        if (result.current_user_comment_vote_status === 'voted') { // API needs to return this
                             voteButton.classList.add('text-green-600', 'font-semibold');
                        } else { 
                            voteButton.classList.add('text-indigo-600');
                        }
                    }
                }
            } else {
                alert(`Error: ${result.error || 'Could not process vote.'}`);
            }
        } catch (error) {
            console.error('Error voting on review comment:', error);
            alert('An error occurred while voting on the comment.');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        if (reviewIdFromPHP > 0) {
            fetchReviewData(reviewIdFromPHP);
        } else {
            document.getElementById('review-detail-content-wrapper').innerHTML = '<p class="text-red-500 text-center py-10">Invalid or missing Review ID.</p>';
        }
    });
</script>

</body>
</html>
