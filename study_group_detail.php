<?php // study_group_detail.php - Study Group Detail Page ?>
<?php
// In a real application, you would get the group ID from the URL, e.g., $_GET['id']
// and then fetch the specific group data from a database.
// For this static example, we'll hardcode the details for one group.

$group = [
    'id' => 1, // Example ID
    'subject' => 'Mathematics',
    'subject_color' => 'bg-blue-500', // Consistent with study_groups.php
    'title' => 'Calculus II Study Group',
    'course_code' => 'MATH 201',
    'creator' => 'John Smith',
    'about' => 'Join us to master derivatives, integrals, and series. This study group is perfect for students currently enrolled in MATH 201 (Calculus II). We focus on solving practice problems, explaining difficult concepts, and preparing for exams together.<br><br>All skill levels are welcome! We believe in collaborative learning and helping each other succeed. Bring your textbooks, questions, and a positive attitude.',
    'spots_filled' => 8,
    'total_spots' => 15,
    'members' => [
        ['initials' => 'JS', 'name' => 'John Smith (Leader)', 'avatar_bg' => 'bg-indigo-500'],
        ['initials' => 'SJ', 'name' => 'Sarah Johnson', 'avatar_bg' => 'bg-pink-500'],
        ['initials' => 'MC', 'name' => 'Michael Chen', 'avatar_bg' => 'bg-green-500'],
        ['initials' => 'AR', 'name' => 'Aisha Rodriguez', 'avatar_bg' => 'bg-yellow-500'],
        ['initials' => 'TP', 'name' => 'Tyler Patel', 'avatar_bg' => 'bg-purple-500'],
        // Add more members if needed to reach 8
        ['initials' => 'LW', 'name' => 'Laura Williams', 'avatar_bg' => 'bg-teal-500'],
        ['initials' => 'DB', 'name' => 'David Brown', 'avatar_bg' => 'bg-orange-500'],
        ['initials' => 'EM', 'name' => 'Emily Miller', 'avatar_bg' => 'bg-red-500'],
    ],
    'meeting_location' => 'Library, Room 204 (2nd Floor, North Wing)',
    'meeting_day' => 'Every Monday',
    'meeting_time' => '3:00 PM - 5:00 PM',
    'resources' => [
        ['name' => 'Calculus II Syllabus', 'url' => '#'], // Replace # with actual URLs
        ['name' => 'Practice Problems (Week 5)', 'url' => '#'],
        ['name' => 'Midterm Study Guide', 'url' => '#'],
    ],
    'comments' => [
        [
            'name' => 'Sarah Johnson',
            'avatar_initials' => 'SJ',
            'avatar_bg' => 'bg-pink-500',
            'time_ago' => '2 days ago',
            'text' => 'Last week\'s session was really helpful! I finally understand Taylor series. Looking forward to Monday!',
        ],
        [
            'name' => 'Michael Chen',
            'avatar_initials' => 'MC',
            'avatar_bg' => 'bg-green-500',
            'time_ago' => '3 days ago',
            'text' => 'Can we spend some time on partial fractions this week? I\'m struggling with those integration problems.',
        ]
    ]
];

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
                        <li><a href="study_groups.php" class="flex items-center text-indigo-600 bg-indigo-100 p-3 rounded-lg font-semibold transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" /></svg>Study Group Finder</a></li>
                        <li><a href="course_reviews.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.822.672l-4.684-2.79a.563.563 0 0 0-.652 0l-4.684 2.79a.562.562 0 0 1-.822-.672l1.285-5.385a.562.562 0 0 0-.182-.557l-4.204-3.602a.563.563 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" /></svg>Course Reviews</a></li>
                        <li><a href="course_notes.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>Course Notes</a></li>
                        <li><a href="campus_news.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25H5.625a2.25 2.25 0 0 1-2.25-2.25V7.5c0-.621.504-1.125 1.125-1.125H9M7.5 11.25h.008v.008H7.5v-.008Zm0 3h.008v.008H7.5v-.008Zm0 3h.008v.008H7.5v-.008Z" /></svg>Campus News</a></li>
                        <li><a href="club_activities.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 1.516M6.528 9.918A9 9 0 0 1 12.75 3.031m0 0a9 9 0 0 1 6.222 6.887M12.75 3.031a9 9 0 0 1-6.222 6.887m6.222-6.887L18.5 7.5M12.75 3.03V5.25m0 0A2.25 2.25 0 0 1 15 7.5v.208c0 .621.448 1.17.956 1.397l.703.422a2.25 2.25 0 0 1 .956 1.397V13.5A2.25 2.25 0 0 1 15 15.75v.208c0 .621-.448 1.17-.956 1.397l-.703.422a2.25 2.25 0 0 1-.956 1.397V21m-4.5 0V19.208c0-.621.448-1.17.956-1.397l.703-.422a2.25 2.25 0 0 1 .956-1.397V13.5A2.25 2.25 0 0 1 10.5 11.25v-.208c0-.621-.448-1.17-.956-1.397L8.84 9.23a2.25 2.25 0 0 1-.956-1.397V5.25A2.25 2.25 0 0 1 10.5 3m-3.75 0h7.5" /></svg>Club Activities</a></li>
                        <li><a href="#" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>Student Marketplace</a></li>
                    </ul>
                </nav>
            </aside>

            <div class="w-full md:w-3/4 lg:w-4/5">
                <div class="mb-6">
                    <a href="study_groups.php" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 transition duration-300 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        Back to Study Groups
                    </a>
                </div>

                <div class="bg-white p-6 md:p-8 rounded-xl shadow-xl">
                    <div class="flex flex-col sm:flex-row justify-between items-start mb-6 pb-6 border-b border-gray-200">
                        <div>
                            <span class="text-xs font-semibold inline-block py-1 px-3 uppercase rounded-full <?php echo htmlspecialchars($group['subject_color']); ?> text-white mb-2">
                                <?php echo htmlspecialchars($group['subject']); ?>
                            </span>
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mt-1"><?php echo htmlspecialchars($group['title']); ?></h1>
                            <p class="text-sm text-gray-500 mt-1"><?php echo htmlspecialchars($group['course_code']); ?> &bull; Created by <?php echo htmlspecialchars($group['creator']); ?></p>
                        </div>
                        <div class="flex space-x-2 mt-4 sm:mt-0">
                            <button class="p-2 text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                            </button>
                            <button class="p-2 text-gray-500 hover:text-red-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12.56 0c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2 space-y-8">
                            <div>
                                <h2 class="text-2xl font-semibold text-gray-800 mb-3">About this group</h2>
                                <div class="prose max-w-none text-gray-700 leading-relaxed">
                                    <?php echo $group['about']; // HTML is allowed for line breaks ?>
                                </div>
                            </div>
                            <div>
                                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Meeting Information</h2>
                                <div class="space-y-3 text-gray-700">
                                    <div class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-3 text-indigo-500 flex-shrink-0 mt-1"><path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.145l.002-.001L10 18.41l.002.001.282.144a5.74 5.74 0 00.28.145l.018.008.006.003.003.001.002.001c.198.086.307.066.307.066s.11-.02.308.066l.002.001.006.003.018.008a5.741 5.741 0 00.281-.145l.002-.001L10 18.41l.002.001.282.144a5.74 5.74 0 00.28.145l.018.008.006.003.003.001ZM10 4a4 4 0 100 8 4 4 0 000-8zm0 6a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                                        <div><strong>Location:</strong> <?php echo htmlspecialchars($group['meeting_location']); ?></div>
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-3 text-indigo-500 flex-shrink-0"><path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5h10.5a.75.75 0 000-1.5H4.75a.75.75 0 000 1.5z" clip-rule="evenodd" /></svg>
                                        <div><strong>Day:</strong> <?php echo htmlspecialchars($group['meeting_day']); ?></div>
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-3 text-indigo-500 flex-shrink-0"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" /></svg>
                                        <div><strong>Time:</strong> <?php echo htmlspecialchars($group['meeting_time']); ?></div>
                                    </div>
                                </div>
                            </div>
                             <div class="pt-8 border-t border-gray-200">
                                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Comments</h3>
                                <div class="space-y-6 mb-6">
                                    <?php foreach($group['comments'] as $comment): ?>
                                    <div class="flex items-start">
                                        <div class="w-10 h-10 <?php echo htmlspecialchars($comment['avatar_bg']); ?> text-white flex items-center justify-center rounded-full text-lg font-bold mr-3 flex-shrink-0">
                                            <?php echo htmlspecialchars($comment['avatar_initials']); ?>
                                        </div>
                                        <div class="bg-gray-100 p-4 rounded-lg flex-grow">
                                            <div class="flex justify-between items-center mb-1">
                                                <span class="font-semibold text-gray-800 text-sm"><?php echo htmlspecialchars($comment['name']); ?></span>
                                                <span class="text-xs text-gray-500"><?php echo htmlspecialchars($comment['time_ago']); ?></span>
                                            </div>
                                            <p class="text-gray-700 text-sm"><?php echo htmlspecialchars($comment['text']); ?></p>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <div>
                                    <h4 class="text-md font-semibold text-gray-800 mb-2">Add a comment...</h4>
                                    <form action="#" method="POST">
                                        <textarea name="comment_text" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 mb-3" placeholder="Write your comment..."></textarea>
                                        <div class="text-right">
                                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-5 rounded-lg shadow-md transition duration-300">Post Comment</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="lg:col-span-1 space-y-8">
                            <div>
                                <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg shadow-md transition duration-300 flex items-center justify-center text-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2"><path d="M11 5a3 3 0 11-6 0 3 3 0 016 0zM2 12.5a.5.5 0 01.5-.5h15a.5.5 0 010 1H10v1.5a.5.5 0 01-.5.5H2.5a.5.5 0 01-.5-.5V12.5zM10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" /></svg>
                                    Join Group
                                </button>
                                <p class="text-sm text-gray-600 text-center mt-2"><?php echo htmlspecialchars($group['spots_filled']); ?> out of <?php echo htmlspecialchars($group['total_spots']); ?> spots filled</p>
                            </div>

                            <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                                <h3 class="text-xl font-semibold text-gray-800 mb-4">Members (<?php echo count($group['members']); ?>)</h3>
                                <ul class="space-y-3">
                                    <?php foreach(array_slice($group['members'], 0, 5) as $member): // Show first 5 members ?>
                                    <li class="flex items-center">
                                        <div class="w-8 h-8 <?php echo htmlspecialchars($member['avatar_bg']); ?> text-white flex items-center justify-center rounded-full text-sm font-bold mr-3">
                                            <?php echo htmlspecialchars($member['initials']); ?>
                                        </div>
                                        <span class="text-gray-700 text-sm"><?php echo htmlspecialchars($member['name']); ?></span>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php if(count($group['members']) > 5): ?>
                                <a href="#" class="text-sm text-indigo-600 hover:underline mt-3 inline-block">View all members</a>
                                <?php endif; ?>
                            </div>

                            <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                                <h3 class="text-xl font-semibold text-gray-800 mb-4">Resources</h3>
                                <ul class="space-y-2">
                                    <?php foreach($group['resources'] as $resource): ?>
                                    <li>
                                        <a href="<?php echo htmlspecialchars($resource['url']); ?>" class="flex items-center text-indigo-600 hover:text-indigo-800 hover:underline transition-colors text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 mr-2 flex-shrink-0"><path fill-rule="evenodd" d="M4.25 5.5a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H4.25zm0 4a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H4.25zm0 4a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H4.25z" clip-rule="evenodd" /></svg>
                                            <?php echo htmlspecialchars($resource['name']); ?>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include 'footer.php'; ?>

<script>
    // Any specific JS for the study group detail page can go here
</script>
</body>
</html>
