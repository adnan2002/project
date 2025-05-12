<?php // course_review_detail.php - Course Review Detail Page ?>
<?php
// In a real application, you would get review ID or course ID from $_GET
// and fetch data from a database. For this example, we use static data.
$review_detail = [
    'id' => 1, // Example review ID
    'course_title' => 'Introduction to Computer Science',
    'course_code' => 'CS 101',
    'professor_name' => 'Prof. Jane Smith',
    'overall_rating' => 4.8, // Course overall rating
    'total_reviews_count' => 28,
    'reviewer_name' => 'Thomas L.',
    'review_term' => 'Spring 2023',
    'individual_rating' => 5.0, // Rating given by this specific reviewer
    'difficulty' => 'Moderate',
    'difficulty_value' => 3, // 1-5 for progress bar, 3 for Moderate
    'workload' => 'Average',
    'workload_value' => 3, // 1-5 for progress bar, 3 for Average
    'would_take_again' => true,
    'attendance_required' => true,
    'review_text_p1' => 'Great intro course! Prof. Smith makes complex concepts easy to understand and the assignments were challenging but fair. The lectures were engaging and she always took time to answer questions thoroughly.',
    'review_text_p2' => 'The course covers all the fundamentals of computer science and programming. We started with basic algorithms and worked our way up to more complex data structures. The progression was logical and well-paced.',
    'review_text_p3' => 'The weekly lab sessions were particularly helpful for getting hands-on experience with the concepts covered in lectures. Teaching assistants were knowledgeable and supportive.',
    'pros' => [
        'Clear explanations of complex topics',
        'Engaging lectures with real-world examples',
        'Helpful feedback on assignments',
        'Well-structured course materials'
    ],
    'cons' => [
        'Midterm was more difficult than expected',
        'Some assignments had tight deadlines'
    ],
    'advice' => 'Start the programming assignments early, as they can take longer than expected. Form study groups for the more challenging topics. Take advantage of the professor\'s office hours - she\'s very helpful one-on-one.',
    'helpful_yes_count' => 12,
    'helpful_no_count' => 2,
    'course_stats' => [
        'rating_distribution' => [
            '5' => 75, '4' => 20, '3' => 5, '2' => 0, '1' => 0,
        ],
        'would_take_again_percentage' => 94,
        'difficulty_level_value' => 3.2,
        'difficulty_level_text' => 'Moderate',
    ],
    'other_reviews' => [
        ['id' => 2, 'reviewer_name' => 'Alex W.', 'review_term' => 'Fall 2023', 'rating' => 4.0, 'snippet' => 'Professor Smith is an excellent teacher who clearly explains programming concepts. The assignments were practical and helped reinforce what we learned in class...'],
        ['id' => 3, 'reviewer_name' => 'Maria J.', 'review_term' => 'Spring 2023', 'rating' => 5.0, 'snippet' => 'This course was the perfect introduction to computer science. The professor made the material accessible for beginners while still challenging those with prior experience...'],
    ],
    'page_comments' => [
        [
            'initials' => 'RJ', 'name' => 'Ryan Johnson', 'avatar_bg' => 'bg-blue-400', 'time_ago' => '3 days ago',
            'text' => 'I\'m taking this course next semester. Did you find the textbook helpful or is it possible to get by with just the lecture notes?',
            'reply' => [
                'initials' => 'TL', 'name' => 'Thomas L.', 'avatar_bg' => 'bg-teal-400', 'time_ago' => '2 days ago',
                'text' => '@Ryan The textbook was helpful for reference, but Prof. Smith\'s lecture notes are comprehensive. I\'d recommend getting the book if you can, but you could definitely pass with just the notes and attending lectures.'
            ]
        ]
    ]
];

function display_stars($rating, $color = 'text-yellow-400') {
    $output = '<div class="flex items-center">';
    for ($i = 1; $i <= 5; $i++) {
        $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 ' . ($i <= round($rating) ? $color : 'text-gray-300') . '">';
        $output .= '<path fill-rule="evenodd" d="M10.868 2.884c.321-.772 1.415-.772 1.736 0l1.681 4.06c.064.155.195.278.358.325l4.422.644c.828.121 1.164 1.132.533 1.72l-3.209 3.126a.427.427 0 00-.122.38l.758 4.398c.139.813-.71.1.443-.386l-3.952-2.078a.427.427 0 00-.401 0l-3.952 2.078c-.63.33-.982-.033-.843-.843l.758-4.398a.427.427 0 00-.122-.38L2.613 9.753c-.63-.613-.295-1.599.533-1.72l4.422-.644a.427.427 0 00.358-.325l1.681-4.06z" clip-rule="evenodd" /></svg>';
    }
    $output .= '<span class="ml-1 text-sm text-gray-600">(' . number_format($rating, 1) . ')</span></div>';
    return $output;
}

include 'header.php';
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
                        <li><a href="#" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>Student Marketplace</a></li>
                    </ul>
                </nav>
            </aside>

            <div class="w-full md:w-3/4 lg:w-4/5">
                <div class="mb-6">
                    <a href="course_reviews.php" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 transition duration-300 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        Back to Course Reviews
                    </a>
                </div>

                <article class="bg-white p-6 md:p-8 rounded-xl shadow-xl">
                    <div class="flex flex-col sm:flex-row justify-between items-start mb-4">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-800"><?php echo htmlspecialchars($review_detail['course_title']); ?></h1>
                            <p class="text-sm text-gray-500"><?php echo htmlspecialchars($review_detail['course_code']); ?> &bull; <?php echo htmlspecialchars($review_detail['professor_name']); ?></p>
                        </div>
                        <div class="mt-2 sm:mt-0 flex items-center bg-green-100 text-green-700 font-bold text-sm px-3 py-1.5 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 mr-1"><path fill-rule="evenodd" d="M10.868 2.884c.321-.772 1.415-.772 1.736 0l1.681 4.06c.064.155.195.278.358.325l4.422.644c.828.121 1.164 1.132.533 1.72l-3.209 3.126a.427.427 0 00-.122.38l.758 4.398c.139.813-.71.1.443-.386l-3.952-2.078a.427.427 0 00-.401 0l-3.952 2.078c-.63.33-.982-.033-.843-.843l.758-4.398a.427.427 0 00-.122-.38L2.613 9.753c-.63-.613-.295-1.599.533-1.72l4.422-.644a.427.427 0 00.358-.325l1.681-4.06z" clip-rule="evenodd" /></svg>
                            <?php echo htmlspecialchars(number_format($review_detail['overall_rating'], 1)); ?> / 5
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mb-6">Based on <?php echo htmlspecialchars($review_detail['total_reviews_count']); ?> reviews</p>

                    <div class="border-t border-b border-gray-200 py-6 mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <h2 class="text-xl font-semibold text-gray-800">Review by <?php echo htmlspecialchars($review_detail['reviewer_name']); ?></h2>
                            <span class="text-sm text-gray-500"><?php echo htmlspecialchars($review_detail['review_term']); ?></span>
                        </div>
                        <?php echo display_stars($review_detail['individual_rating']); ?>
                        
                        <div class="grid grid-cols-2 gap-x-6 gap-y-4 mt-4 text-sm">
                            <div>
                                <label class="block text-gray-500 mb-1">Difficulty</label>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-yellow-400 h-2.5 rounded-full" style="width: <?php echo ($review_detail['difficulty_value'] / 5 * 100); ?>%"></div>
                                </div>
                                <p class="text-xs text-gray-500 text-right mt-1"><?php echo htmlspecialchars($review_detail['difficulty']); ?></p>
                            </div>
                            <div>
                                <label class="block text-gray-500 mb-1">Workload</label>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-yellow-400 h-2.5 rounded-full" style="width: <?php echo ($review_detail['workload_value'] / 5 * 100); ?>%"></div>
                                </div>
                                <p class="text-xs text-gray-500 text-right mt-1"><?php echo htmlspecialchars($review_detail['workload']); ?></p>
                            </div>
                            <div>
                                <span class="text-gray-500">Would take again:</span>
                                <span class="font-semibold <?php echo $review_detail['would_take_again'] ? 'text-green-600' : 'text-red-600'; ?>">
                                    <?php echo $review_detail['would_take_again'] ? 'Yes' : 'No'; ?>
                                </span>
                            </div>
                             <div>
                                <span class="text-gray-500">Attendance:</span>
                                <span class="font-semibold text-gray-700">
                                    <?php echo $review_detail['attendance_required'] ? 'Required' : 'Not Required'; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="prose max-w-none text-gray-700 leading-relaxed mb-6">
                        <p><?php echo htmlspecialchars($review_detail['review_text_p1']); ?></p>
                        <p><?php echo htmlspecialchars($review_detail['review_text_p2']); ?></p>
                        <p><?php echo htmlspecialchars($review_detail['review_text_p3']); ?></p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-green-700 mb-2">Pros</h4>
                            <ul class="list-disc list-inside text-sm text-green-600 space-y-1">
                                <?php foreach($review_detail['pros'] as $pro): ?>
                                    <li><?php echo htmlspecialchars($pro); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="bg-red-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-red-700 mb-2">Cons</h4>
                            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                                <?php foreach($review_detail['cons'] as $con): ?>
                                    <li><?php echo htmlspecialchars($con); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="bg-blue-50 p-4 rounded-lg mb-6">
                        <h4 class="font-semibold text-blue-700 mb-2">Advice for Future Students</h4>
                        <p class="text-sm text-blue-600"><?php echo htmlspecialchars($review_detail['advice']); ?></p>
                    </div>

                    <div class="text-sm text-gray-600 mb-8 text-center">
                        <span>Was this review helpful?</span>
                        <button class="ml-2 text-indigo-600 hover:underline">Yes (<?php echo htmlspecialchars($review_detail['helpful_yes_count']); ?>)</button>
                        <button class="ml-2 text-red-600 hover:underline">No (<?php echo htmlspecialchars($review_detail['helpful_no_count']); ?>)</button>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-8 mb-8">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Course Statistics</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-semibold text-gray-700 mb-2 text-sm">Rating Distribution</h4>
                                <?php foreach($review_detail['course_stats']['rating_distribution'] as $star => $percent): ?>
                                <div class="flex items-center mb-1">
                                    <span class="text-xs w-6 text-gray-500"><?php echo $star; ?>★</span>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 ml-1">
                                        <div class="bg-yellow-400 h-2.5 rounded-full" style="width: <?php echo $percent; ?>%"></div>
                                    </div>
                                    <span class="text-xs w-8 text-right text-gray-500 ml-1"><?php echo $percent; ?>%</span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg flex flex-col items-center justify-center">
                                <h4 class="font-semibold text-gray-700 mb-2 text-sm">Would Take Again</h4>
                                <div class="relative w-24 h-24">
                                     <svg class="w-full h-full" viewBox="0 0 36 36">
                                        <path class="text-gray-200" stroke-width="3" fill="none" stroke="currentColor" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                        <path class="text-green-500" stroke-width="3" fill="none" stroke-dasharray="<?php echo $review_detail['course_stats']['would_take_again_percentage']; ?>, 100" stroke-linecap="round" stroke="currentColor" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center text-xl font-bold text-green-600">
                                        <?php echo $review_detail['course_stats']['would_take_again_percentage']; ?>%
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg flex flex-col items-center justify-center">
                                <h4 class="font-semibold text-gray-700 mb-2 text-sm">Difficulty Level</h4>
                                <div class="text-3xl font-bold text-yellow-500"><?php echo number_format($review_detail['course_stats']['difficulty_level_value'], 1); ?></div>
                                <div class="text-xs text-gray-500">out of 5</div>
                                <div class="text-sm text-gray-600 mt-1"><?php echo htmlspecialchars($review_detail['course_stats']['difficulty_level_text']); ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-8 mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-2xl font-semibold text-gray-800">Other Reviews (<?php echo count($review_detail['other_reviews']); ?>)</h3>
                            <a href="course_reviews.php?course_id=<?php echo $review_detail['course_code']; /* Link to all reviews for this course */?>" class="text-sm text-indigo-600 hover:underline">View All</a>
                        </div>
                        <div class="space-y-4">
                            <?php foreach(array_slice($review_detail['other_reviews'],0,2) as $other_review): ?>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="font-semibold text-gray-700 text-sm"><?php echo htmlspecialchars($other_review['reviewer_name']); ?> &bull; <span class="text-xs text-gray-500"><?php echo htmlspecialchars($other_review['review_term']); ?></span></span>
                                    <?php echo display_stars($other_review['rating'], 'text-yellow-400 text-xs'); ?>
                                </div>
                                <p class="text-sm text-gray-600 line-clamp-2"><?php echo htmlspecialchars($other_review['snippet']); ?></p>
                                <a href="course_review_detail.php?review_id=<?php echo $other_review['id']; ?>" class="text-xs text-indigo-600 hover:underline mt-1 inline-block">Read more</a>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-8">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Comments (<?php echo count($review_detail['page_comments']); ?>)</h3>
                        <div class="space-y-6 mb-8">
                            <?php foreach($review_detail['page_comments'] as $comment): ?>
                            <div class="comment-item">
                                <div class="flex items-start">
                                    <div class="w-10 h-10 <?php echo htmlspecialchars($comment['avatar_bg']); ?> text-white flex items-center justify-center rounded-full text-lg font-bold mr-3 flex-shrink-0">
                                        <?php echo htmlspecialchars($comment['initials']); ?>
                                    </div>
                                    <div class="bg-gray-100 p-4 rounded-lg flex-grow">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="font-semibold text-gray-800 text-sm"><?php echo htmlspecialchars($comment['name']); ?></span>
                                            <span class="text-xs text-gray-500"><?php echo htmlspecialchars($comment['time_ago']); ?></span>
                                        </div>
                                        <p class="text-gray-700 text-sm"><?php echo htmlspecialchars($comment['text']); ?></p>
                                    </div>
                                </div>
                                <?php if (isset($comment['reply']) && $comment['reply']): ?>
                                <div class="ml-8 mt-3 flex items-start">
                                     <div class="w-10 h-10 <?php echo htmlspecialchars($comment['reply']['avatar_bg']); ?> text-white flex items-center justify-center rounded-full text-lg font-bold mr-3 flex-shrink-0">
                                        <?php echo htmlspecialchars($comment['reply']['initials']); ?>
                                    </div>
                                    <div class="bg-gray-200 p-3 rounded-lg flex-grow">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="font-semibold text-gray-800 text-sm"><?php echo htmlspecialchars($comment['reply']['name']); ?></span>
                                            <span class="text-xs text-gray-500"><?php echo htmlspecialchars($comment['reply']['time_ago']); ?></span>
                                        </div>
                                        <p class="text-gray-700 text-sm"><?php echo htmlspecialchars($comment['reply']['text']); ?></p>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div>
                            <h4 class="text-lg font-semibold text-gray-800 mb-2">Add a Comment</h4>
                            <form action="#" method="POST">
                                <div class="flex items-start mb-3">
                                    <div class="w-10 h-10 bg-gray-300 text-gray-500 flex items-center justify-center rounded-full text-lg mr-3 flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z" clip-rule="evenodd" /></svg>
                                    </div>
                                    <textarea name="comment_text" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Write your comment or question..."></textarea>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-300">Post Comment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </main>
</div>

<?php include 'footer.php'; ?>

<script>
    // Any specific JS for the course review detail page can go here
</script>
</body>
</html>
