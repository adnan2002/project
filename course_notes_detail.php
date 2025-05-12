<?php // course_note_detail.php - Course Note Detail Page ?>
<?php
// In a real application, you would get note ID from $_GET
// and fetch data from a database. For this example, we use static data.
$note_detail = [
    'id' => 1, // Example note ID
    'subject' => 'Mathematics',
    'subject_color' => 'bg-yellow-400', // From course_notes.php
    'title' => 'Calculus II Complete Notes',
    'course_code' => 'MATH 201',
    'term' => 'Spring 2024',
    'file_type' => 'PDF Document',
    'pages' => 42,
    'size_mb' => 4.2,
    'preview_image_url' => 'https://placehold.co/600x800/E2E8F0/4A5568?text=PDF+Preview',
    'preview_filename' => 'Calculus_II_Complete_Notes.pdf',
    'about_notes' => 'Comprehensive notes covering all topics from the Calculus II (MATH 201) course. These notes include detailed explanations, step-by-step examples, and practice problems with solutions.',
    'topics_covered' => [
        'Techniques of Integration',
        'Applications of Integration',
        'Parametric Equations and Polar Coordinates',
        'Infinite Sequences and Series',
        'Power Series and Taylor Series',
        'Differential Equations'
    ],
    'additional_info' => 'These notes were meticulously compiled throughout the semester and include all material covered in lectures, as well as supplementary explanations and examples from the textbook and office hours.',
    'tags' => ['calculus', 'integration', 'series', 'taylor series', 'practice problems'],
    'stats' => [
        'downloads' => 238,
        'views' => 1456,
        'average_rating' => 4.8, // Out of 5
        'uploaded_date' => 'Mar 15, 2024'
    ],
    'uploader' => [
        'initials' => 'AC',
        'avatar_bg' => 'bg-yellow-500',
        'name' => 'Alex Chen',
        'details' => 'Math Major • Class of 2025',
        'profile_url' => '#'
    ],
    'similar_notes' => [
        ['id' => 2, 'title' => 'Data Structures & Algorithms', 'course_code' => 'CS 202', 'pages' => 56, 'downloads' => 412, 'icon_path' => 'M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z'],
        ['id' => 3, 'title' => 'Organic Chemistry Reaction Guide', 'course_code' => 'CHEM 301', 'pages' => 64, 'downloads' => 325, 'icon_path' => 'M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z'],
        ['id' => 4, 'title' => 'Calculus I Study Guide', 'course_code' => 'MATH 101', 'pages' => 38, 'downloads' => 276, 'icon_path' => 'M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z'],
    ],
    'reviews_comments' => [
        [
            'type' => 'review', // can be 'review' or 'comment'
            'initials' => 'JD', 'name' => 'James Davis', 'avatar_bg' => 'bg-blue-500', 'time_ago' => '2 weeks ago',
            'rating' => 5,
            'text' => 'These notes saved me during finals! The examples are super clear and the practice problems really helped me understand the material. Definitely worth downloading.',
            'helpful_count' => 8,
        ],
        [
            'type' => 'review',
            'initials' => 'LM', 'name' => 'Lisa Martinez', 'avatar_bg' => 'bg-pink-500', 'time_ago' => '3 weeks ago',
            'rating' => 4,
            'text' => 'Very comprehensive notes that cover all the course material. The Taylor series section was particularly helpful. Only complaint is that some of the examples could be more detailed.',
            'helpful_count' => 5,
        ]
    ]
];

function display_note_stars($rating, $color = 'text-yellow-400') {
    $output = '<div class="flex items-center">';
    for ($i = 1; $i <= 5; $i++) {
        $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 ' . ($i <= round($rating) ? $color : 'text-gray-300') . '">'; // Smaller stars
        $output .= '<path fill-rule="evenodd" d="M10.868 2.884c.321-.772 1.415-.772 1.736 0l1.681 4.06c.064.155.195.278.358.325l4.422.644c.828.121 1.164 1.132.533 1.72l-3.209 3.126a.427.427 0 00-.122.38l.758 4.398c.139.813-.71.1.443-.386l-3.952-2.078a.427.427 0 00-.401 0l-3.952 2.078c-.63.33-.982-.033-.843-.843l.758-4.398a.427.427 0 00-.122-.38L2.613 9.753c-.63-.613-.295-1.599.533-1.72l4.422-.644a.427.427 0 00.358-.325l1.681-4.06z" clip-rule="evenodd" /></svg>';
    }
    $output .= '</div>';
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
                        <li><a href="course_reviews.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.822.672l-4.684-2.79a.563.563 0 0 0-.652 0l-4.684 2.79a.562.562 0 0 1-.822-.672l1.285-5.385a.562.562 0 0 0-.182-.557l-4.204-3.602a.563.563 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" /></svg>Course Reviews</a></li>
                        <li><a href="course_notes.php" class="flex items-center text-indigo-600 bg-indigo-100 p-3 rounded-lg font-semibold transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>Course Notes</a></li>
                        <li><a href="campus_news.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25H5.625a2.25 2.25 0 0 1-2.25-2.25V7.5c0-.621.504-1.125 1.125-1.125H9M7.5 11.25h.008v.008H7.5v-.008Zm0 3h.008v.008H7.5v-.008Zm0 3h.008v.008H7.5v-.008Z" /></svg>Campus News</a></li>
                        <li><a href="club_activities.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 1.516M6.528 9.918A9 9 0 0 1 12.75 3.031m0 0a9 9 0 0 1 6.222 6.887M12.75 3.031a9 9 0 0 1-6.222 6.887m6.222-6.887L18.5 7.5M12.75 3.03V5.25m0 0A2.25 2.25 0 0 1 15 7.5v.208c0 .621.448 1.17.956 1.397l.703.422a2.25 2.25 0 0 1 .956 1.397V13.5A2.25 2.25 0 0 1 15 15.75v.208c0 .621-.448 1.17-.956 1.397l-.703.422a2.25 2.25 0 0 1-.956 1.397V21m-4.5 0V19.208c0-.621.448-1.17.956-1.397l.703-.422a2.25 2.25 0 0 1 .956-1.397V13.5A2.25 2.25 0 0 1 10.5 11.25v-.208c0-.621-.448-1.17-.956-1.397L8.84 9.23a2.25 2.25 0 0 1-.956-1.397V5.25A2.25 2.25 0 0 1 10.5 3m-3.75 0h7.5" /></svg>Club Activities</a></li>
                        <li><a href="#" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>Student Marketplace</a></li>
                    </ul>
                </nav>
            </aside>

            <div class="w-full md:w-3/4 lg:w-4/5">
                <div class="mb-6">
                    <a href="course_notes.php" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 transition duration-300 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        Back to Course Notes
                    </a>
                </div>

                <article class="bg-white p-6 md:p-8 rounded-xl shadow-xl">
                    <div class="flex flex-col sm:flex-row justify-between items-start mb-4 pb-4 border-b border-gray-200">
                        <div>
                            <span class="text-xs font-semibold inline-block py-1 px-3 uppercase rounded-full <?php echo htmlspecialchars($note_detail['subject_color']); ?> text-white mb-2">
                                <?php echo htmlspecialchars($note_detail['subject']); ?>
                            </span>
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mt-1"><?php echo htmlspecialchars($note_detail['title']); ?></h1>
                            <p class="text-sm text-gray-500 mt-1"><?php echo htmlspecialchars($note_detail['course_code']); ?> &bull; <?php echo htmlspecialchars($note_detail['term']); ?></p>
                        </div>
                        <button class="p-2 text-gray-500 hover:text-indigo-600 transition-colors mt-3 sm:mt-0" title="Share Notes">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5Zm0 0v-.106c0-.414.336-.75.75-.75h6.536a.75.75 0 0 1 .75.75v.106c0 .414-.336.75-.75.75h-6.536a.75.75 0 0 1-.75-.75Z M12 15.75a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5Zm0 0v-.106c0-.414.336-.75.75-.75h1.536a.75.75 0 0 1 .75.75v.106c0 .414-.336.75-.75.75h-1.536a.75.75 0 0 1-.75-.75Zm-3.75 2.25a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5Z" /></svg>
                        </button>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
                        <div class="flex items-center text-sm text-gray-600 mb-3 sm:mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            <?php echo htmlspecialchars($note_detail['file_type']); ?> &bull; <?php echo htmlspecialchars($note_detail['pages']); ?> pages &bull; <?php echo htmlspecialchars($note_detail['size_mb']); ?> MB
                        </div>
                        <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-300 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                            Download Notes
                        </a>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2 space-y-8">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-2">About these Notes</h2>
                                <p class="text-gray-700 leading-relaxed text-sm"><?php echo htmlspecialchars($note_detail['about_notes']); ?></p>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Topics covered include:</h3>
                                <ul class="list-disc list-inside text-gray-700 space-y-1 text-sm">
                                    <?php foreach($note_detail['topics_covered'] as $topic): ?>
                                    <li><?php echo htmlspecialchars($topic); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <p class="text-gray-700 leading-relaxed text-sm"><?php echo htmlspecialchars($note_detail['additional_info']); ?></p>
                            
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-3">Preview</h3>
                                <div class="bg-gray-100 p-4 rounded-lg">
                                    <div class="flex justify-between items-center text-sm text-gray-600 mb-2">
                                        <span><?php echo htmlspecialchars($note_detail['preview_filename']); ?></span>
                                        <span>Page 1 of <?php echo htmlspecialchars($note_detail['pages']); ?></span>
                                    </div>
                                    <div class="bg-gray-200 h-96 rounded flex items-center justify-center overflow-hidden">
                                        <img src="<?php echo htmlspecialchars($note_detail['preview_image_url']); ?>" alt="Note Preview" class="max-h-full max-w-full object-contain">
                                    </div>
                                    <div class="text-center mt-3">
                                        <a href="#" class="text-indigo-600 hover:underline text-sm">View more pages</a>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Tags:</h3>
                                <div class="flex flex-wrap gap-2">
                                    <?php foreach($note_detail['tags'] as $tag): ?>
                                    <span class="bg-gray-200 text-gray-700 text-xs font-medium px-2.5 py-0.5 rounded-full"><?php echo htmlspecialchars($tag); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <div class="lg:col-span-1 space-y-8">
                            <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Statistics</h3>
                                <ul class="text-sm text-gray-600 space-y-2">
                                    <li class="flex justify-between"><span>Downloads:</span> <span class="font-medium text-gray-800"><?php echo htmlspecialchars($note_detail['stats']['downloads']); ?></span></li>
                                    <li class="flex justify-between"><span>Views:</span> <span class="font-medium text-gray-800"><?php echo htmlspecialchars($note_detail['stats']['views']); ?></span></li>
                                    <li class="flex justify-between items-center"><span>Average Rating:</span> <?php echo display_note_stars($note_detail['stats']['average_rating']); ?></li>
                                    <li class="flex justify-between"><span>Uploaded:</span> <span class="font-medium text-gray-800"><?php echo htmlspecialchars($note_detail['stats']['uploaded_date']); ?></span></li>
                                </ul>
                            </div>
                             <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Uploaded by</h3>
                                <div class="flex items-center">
                                    <div class="w-12 h-12 <?php echo htmlspecialchars($note_detail['uploader']['avatar_bg']); ?> text-white flex items-center justify-center rounded-full text-xl font-bold mr-3">
                                        <?php echo htmlspecialchars($note_detail['uploader']['initials']); ?>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800"><?php echo htmlspecialchars($note_detail['uploader']['name']); ?></p>
                                        <p class="text-xs text-gray-500"><?php echo htmlspecialchars($note_detail['uploader']['details']); ?></p>
                                        <a href="<?php echo htmlspecialchars($note_detail['uploader']['profile_url']); ?>" class="text-xs text-indigo-600 hover:underline">View Profile</a>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Similar Notes</h3>
                                <ul class="space-y-3">
                                    <?php foreach($note_detail['similar_notes'] as $similar_note): ?>
                                    <li>
                                        <a href="course_note_detail.php?note_id=<?php echo $similar_note['id']; ?>" class="group">
                                            <div class="flex items-start">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-red-400 flex-shrink-0 mt-0.5"><path stroke-linecap="round" stroke-linejoin="round" d="<?php echo $similar_note['icon_path']; ?>" /></svg>
                                                <div>
                                                    <p class="text-sm font-medium text-indigo-600 group-hover:underline"><?php echo htmlspecialchars($similar_note['title']); ?></p>
                                                    <p class="text-xs text-gray-500"><?php echo htmlspecialchars($similar_note['course_code']); ?> &bull; <?php echo htmlspecialchars($similar_note['pages']); ?> pages</p>
                                                    <p class="text-xs text-gray-500"><?php echo htmlspecialchars($similar_note['downloads']); ?> downloads</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <a href="course_notes.php?subject=<?php echo urlencode($note_detail['subject']); ?>" class="text-sm text-indigo-600 hover:underline mt-3 inline-block">Browse More <?php echo htmlspecialchars($note_detail['subject']); ?> Notes</a>
                            </div>
                        </div>
                    </div>

                     <div class="border-t border-gray-200 pt-8 mt-10">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Reviews & Comments (<?php echo count($note_detail['reviews_comments']); ?>)</h3>
                        <div class="space-y-6 mb-8">
                            <?php foreach($note_detail['reviews_comments'] as $comment): ?>
                            <div class="comment-item">
                                <div class="flex items-start">
                                    <div class="w-10 h-10 <?php echo htmlspecialchars($comment['avatar_bg']); ?> text-white flex items-center justify-center rounded-full text-lg font-bold mr-3 flex-shrink-0">
                                        <?php echo htmlspecialchars($comment['initials']); ?>
                                    </div>
                                    <div class="bg-gray-100 p-4 rounded-lg flex-grow">
                                        <div class="flex justify-between items-center mb-1">
                                            <div class="flex items-center">
                                                <span class="font-semibold text-gray-800 text-sm mr-2"><?php echo htmlspecialchars($comment['name']); ?></span>
                                                <?php if($comment['type'] === 'review' && isset($comment['rating'])): ?>
                                                    <?php echo display_note_stars($comment['rating']); ?>
                                                <?php endif; ?>
                                            </div>
                                            <span class="text-xs text-gray-500"><?php echo htmlspecialchars($comment['time_ago']); ?></span>
                                        </div>
                                        <p class="text-gray-700 text-sm"><?php echo htmlspecialchars($comment['text']); ?></p>
                                        <div class="mt-2 text-xs">
                                            <?php if(isset($comment['helpful_count'])): ?>
                                            <button class="text-indigo-600 hover:underline mr-3">Helpful (<?php echo htmlspecialchars($comment['helpful_count']); ?>)</button>
                                            <?php endif; ?>
                                            <button class="text-gray-500 hover:underline">Reply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div>
                            <h4 class="text-lg font-semibold text-gray-800 mb-2">Add a Review or Comment</h4>
                            <form action="#" method="POST">
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Rating (optional)</label>
                                    <div class="flex space-x-1">
                                        <?php for($i=5; $i>=1; $i--): ?>
                                        <input type="radio" id="rating-<?php echo $i; ?>" name="rating" value="<?php echo $i; ?>" class="hidden peer">
                                        <label for="rating-<?php echo $i; ?>" class="text-gray-300 peer-hover:text-yellow-400 hover:text-yellow-400 peer-checked:text-yellow-400 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M10.868 2.884c.321-.772 1.415-.772 1.736 0l1.681 4.06c.064.155.195.278.358.325l4.422.644c.828.121 1.164 1.132.533 1.72l-3.209 3.126a.427.427 0 00-.122.38l.758 4.398c.139.813-.71.1.443-.386l-3.952-2.078a.427.427 0 00-.401 0l-3.952 2.078c-.63.33-.982-.033-.843-.843l.758-4.398a.427.427 0 00-.122-.38L2.613 9.753c-.63-.613-.295-1.599.533-1.72l4.422-.644a.427.427 0 00.358-.325l1.681-4.06z" clip-rule="evenodd" /></svg>
                                        </label>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <div class="flex items-start mb-3">
                                     <div class="w-10 h-10 bg-gray-300 text-gray-500 flex items-center justify-center rounded-full text-lg mr-3 flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z" clip-rule="evenodd" /></svg>
                                    </div>
                                    <textarea name="comment_text" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Write your review or comment..."></textarea>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-300">Post Review</button>
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
    // Any specific JS for the course note detail page can go here
</script>
</body>
</html>
