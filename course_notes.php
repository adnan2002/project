<?php include 'header.php';
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
                            <a href="course_reviews.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.822.672l-4.684-2.79a.563.563 0 0 0-.652 0l-4.684 2.79a.562.562 0 0 1-.822-.672l1.285-5.385a.562.562 0 0 0-.182-.557l-4.204-3.602a.563.563 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                </svg>
                                Course Reviews
                            </a>
                        </li>
                         <li>
                            <a href="course_notes.php" class="flex items-center text-indigo-600 bg-indigo-100 p-3 rounded-lg font-semibold transition duration-300">
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
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 sm:mb-0">Course Notes</h1>
                    
                  
                    <button onclick="handleUploadNotes()" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-5 rounded-lg shadow-md transition duration-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Upload Notes
                    </button>

                </div>

                <div class="mb-8 p-6 bg-white rounded-xl shadow-lg">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        <div class="md:col-span-1">
                            <label for="search-notes" class="block text-sm font-medium text-gray-700 mb-1">Search notes by course, topic, or uploader...</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </div>
                                <input type="search" id="search-notes" class="w-full p-2 pl-10 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g., MATH 201 or Alex Chen">
                            </div>
                        </div>
                        <div>
                            <label for="notes-department" class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                            <select id="notes-department" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                <option selected>All Departments</option>
                                <option>Mathematics</option>
                                <option>Computer Science</option>
                                <option>Biology</option>
                                <option>Chemistry</option>
                                <option>Physics</option>
                                <option>History</option>
                                <option>Psychology</option>
                            </select>
                        </div>
                        <div>
                            <label for="notes-sort" class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                            <select id="notes-sort" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                <option selected>Most Recent</option>
                                <option>Most Downloads</option>
                                <option>Highest Rated (if applicable)</option>
                                <option>Alphabetical (A-Z)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php
                    // Placeholder course notes data
                    $course_notes = [
                        [
                            'subject' => 'Mathematics',
                            'subject_color' => 'bg-yellow-400', // Matching image
                            'title' => 'Calculus II Complete Notes',
                            'description' => 'Comprehensive notes covering derivatives, integrals, series, and applications. Includes practice problems and solutions.',
                            'course_info' => 'MATH 201 • Spring 2024',
                            'file_type' => 'PDF',
                            'pages' => 42,
                            'uploader' => 'Alex Chen',
                            'downloads' => 238,
                            'bg_color' => 'bg-yellow-50'
                        ],
                        [
                            'subject' => 'Computer Science',
                            'subject_color' => 'bg-blue-500',
                            'title' => 'Data Structures & Algorithms',
                            'description' => 'Detailed notes on arrays, linked lists, trees, graphs, sorting algorithms, and time complexity analysis.',
                            'course_info' => 'CS 202 • Fall 2023',
                            'file_type' => 'PDF',
                            'pages' => 56,
                            'uploader' => 'Maria Johnson',
                            'downloads' => 412,
                            'bg_color' => 'bg-blue-50'
                        ],
                        [
                            'subject' => 'Biology',
                            'subject_color' => 'bg-green-500',
                            'title' => 'Molecular Biology Study Guide',
                            'description' => 'Comprehensive study guide covering DNA replication, transcription, translation, and gene regulation. Perfect for exam prep.',
                            'course_info' => 'BIO 301 • Spring 2024',
                            'file_type' => 'PDF',
                            'pages' => 35,
                            'uploader' => 'Taylor Smith',
                            'downloads' => 189,
                            'bg_color' => 'bg-green-50'
                        ],
                        [
                            'subject' => 'Psychology',
                            'subject_color' => 'bg-purple-500',
                            'title' => 'Cognitive Psychology Notes',
                            'description' => 'Detailed notes on memory, perception, attention, language, and problem-solving. Includes key theories and research studies.',
                            'course_info' => 'PSYC 202 • Fall 2023',
                            'file_type' => 'PDF',
                            'pages' => 28,
                            'uploader' => 'Jamie Rodriguez',
                            'downloads' => 156,
                            'bg_color' => 'bg-purple-50'
                        ],
                        [
                            'subject' => 'Chemistry',
                            'subject_color' => 'bg-red-500',
                            'title' => 'Organic Chemistry Reaction Guide',
                            'description' => 'Comprehensive guide to organic chemistry reactions, mechanisms, and synthesis strategies. Includes practice problems.',
                            'course_info' => 'CHEM 301 • Spring 2023',
                            'file_type' => 'PDF',
                            'pages' => 64,
                            'uploader' => 'Sam Patel',
                            'downloads' => 325,
                            'bg_color' => 'bg-red-50'
                        ],
                        [
                            'subject' => 'History',
                            'subject_color' => 'bg-teal-500', // Using teal as per image
                            'title' => 'World History: 1500-Present',
                            'description' => 'Detailed chronological notes covering major historical events, figures, and movements from 1500 to the present day.',
                            'course_info' => 'HIST 202 • Fall 2023',
                            'file_type' => 'PDF',
                            'pages' => 48,
                            'uploader' => 'Jordan Lee',
                            'downloads' => 178,
                            'bg_color' => 'bg-teal-50'
                        ],
                    ];

                    foreach ($course_notes as $note): ?>
                        <div class="course-note-card <?php echo htmlspecialchars($note['bg_color']); ?> p-6 rounded-xl shadow-lg flex flex-col hover:shadow-xl transition-shadow duration-300">
                            <div class="mb-3">
                                <span class="text-xs font-semibold inline-block py-1 px-3 uppercase rounded-full <?php echo htmlspecialchars($note['subject_color']); ?> text-white">
                                    <?php echo htmlspecialchars($note['subject']); ?>
                                </span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2"><?php echo htmlspecialchars($note['title']); ?></h3>
                            <p class="text-gray-600 text-sm mb-3 flex-grow"><?php echo htmlspecialchars($note['description']); ?></p>
                            <p class="text-xs text-gray-500 mb-3"><?php echo htmlspecialchars($note['course_info']); ?></p>
                            
                            <div class="flex justify-between items-center text-xs text-gray-500 mb-3">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1 text-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                    <?php echo htmlspecialchars($note['file_type']); ?> &bull; <?php echo htmlspecialchars($note['pages']); ?> pages
                                </span>
                            </div>

                            <div class="text-xs text-gray-500">Uploaded by <?php echo htmlspecialchars($note['uploader']); ?></div>
                            <div class="mt-auto pt-3 flex justify-between items-center text-sm">
                                <a href="#" class="text-indigo-600 hover:text-indigo-800 font-semibold">Download</a>
                                <span class="text-gray-600 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                    </svg>
                                    <?php echo htmlspecialchars($note['downloads']); ?> downloads
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-12 flex justify-center items-center space-x-2">
                    <a href="#" class="p-2 rounded-md hover:bg-gray-200 text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </a>
                    <a href="#" class="px-4 py-2 rounded-md bg-indigo-600 text-white font-medium">1</a>
                    <a href="#" class="px-4 py-2 rounded-md hover:bg-gray-200 text-gray-700">2</a>
                    <a href="#" class="px-4 py-2 rounded-md hover:bg-gray-200 text-gray-700">3</a>
                    <span class="px-4 py-2 text-gray-700">...</span>
                    <a href="#" class="px-4 py-2 rounded-md hover:bg-gray-200 text-gray-700">9</a>
                    <a href="#" class="p-2 rounded-md hover:bg-gray-200 text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include 'footer.php'; ?>

     <script defer>
    function handleUploadNotes() {
      const isAuth = <?php echo $is_auth ? 'true' : 'false'; ?>;
      if (isAuth) {
        window.location.href = 'upload_notes.php';
      } else {
        window.location.href = 'login.php';
      }
    }
  </script>
</body>
</html>
