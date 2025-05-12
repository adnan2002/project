<?php // event_detail.php - Event Detail Page ?>
<?php
// In a real application, you would get the event ID from the URL, e.g., $_GET['id']
// and then fetch the specific event data from a database.
// For this static example, we'll hardcode the details for one event.

$event = [
    'id' => 1, // Example ID
    'image_placeholder' => 'https://placehold.co/1200x400/E0E7FF/4F46E5?text=Event+Image',
    'image_alt' => 'Spring Research Symposium Banner',
    'category' => 'Academic',
    'category_color' => 'bg-blue-500',
    'title' => 'Spring Research Symposium',
    'date' => 'Friday, April 12, 2024',
    'time' => '4:00 PM - 8:00 PM',
    'location_line1' => 'Student Center, Grand Hall',
    'location_line2' => '2nd Floor, North Wing',
    'attendees_going' => 120,
    'attendees_interested' => 45,
    'about' => 'Join us for the annual Spring Research Symposium where students from all disciplines present their research projects and findings. This is a great opportunity to learn about cutting-edge research happening on campus and network with faculty and fellow students.<br><br>The symposium will feature poster presentations, oral presentations, and a keynote address from Dr. Emily Chen, renowned researcher in sustainable energy technologies.',
    'schedule' => [
        '4:00 PM - 5:00 PM: Registration and Poster Setup',
        '5:00 PM - 6:00 PM: Keynote Address (Grand Hall)',
        '6:00 PM - 7:30 PM: Poster Sessions and Oral Presentations',
        '7:30 PM - 8:00 PM: Awards Ceremony'
    ],
    'refreshments' => 'Light refreshments will be provided. This event is open to all students, faculty, and staff.',
    'organizer_initials' => 'UR',
    'organizer_name' => 'University Research Office',
    'organizer_email' => 'research@university.edu',
    'organizer_phone' => '(123) 456-7890',
    'comments' => [
        [
            'initials' => 'JD',
            'name' => 'John Doe',
            'avatar_bg' => 'bg-green-500',
            'time_ago' => '2 days ago',
            'text' => 'Will there be any representatives from the Biology department? I\'m interested in presenting my research on plant genetics.',
            'helpful_count' => 3,
            'reply' => [
                'initials' => 'UR',
                'name' => 'University Research Office',
                'avatar_bg' => 'bg-blue-500',
                'time_ago' => '1 day ago',
                'text' => 'Yes, Dr. Martinez from the Biology department will be there. Please email us at research@university.edu for more information about presenting.'
            ]
        ],
        [
            'initials' => 'SJ',
            'name' => 'Sarah Johnson',
            'avatar_bg' => 'bg-purple-500',
            'time_ago' => '1 day ago',
            'text' => 'Looking forward to this event! The keynote speaker\'s work on sustainable energy is fascinating.',
            'helpful_count' => 1,
            'reply' => null
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
                        <li><a href="events.php" class="flex items-center text-indigo-600 bg-indigo-100 p-3 rounded-lg font-semibold transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12v-.008ZM12 18h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75v-.008ZM9.75 18h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5v-.008ZM7.5 18h.008v.008H7.5v-.008ZM14.25 15h.008v.008H14.25v-.008ZM14.25 18h.008v.008H14.25v-.008ZM16.5 15h.008v.008H16.5v-.008ZM16.5 18h.008v.008H16.5v-.008Z" /></svg>Events Calendar</a></li>
                        <li><a href="study_groups.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" /></svg>Study Group Finder</a></li>
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
                    <a href="events.php" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 transition duration-300 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        Back to Events
                    </a>
                </div>

                <article class="bg-white p-6 md:p-8 rounded-xl shadow-xl">
                    <div class="mb-6 bg-gray-200 rounded-lg h-64 md:h-80 flex items-center justify-center">
                        <img src="<?php echo htmlspecialchars($event['image_placeholder']); ?>" alt="<?php echo htmlspecialchars($event['image_alt']); ?>" class="w-full h-full object-cover rounded-lg">
                    </div>

                    <div class="mb-4 text-right">
                        <span class="text-xs font-semibold inline-block py-1 px-3 uppercase rounded-full <?php echo htmlspecialchars($event['category_color']); ?> text-white">
                            <?php echo htmlspecialchars($event['category']); ?>
                        </span>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6"><?php echo htmlspecialchars($event['title']); ?></h1>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 text-sm text-gray-700">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 text-indigo-500 flex-shrink-0"><path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5h10.5a.75.75 0 000-1.5H4.75a.75.75 0 000 1.5z" clip-rule="evenodd" /></svg>
                            <div><strong>Date:</strong><br><?php echo htmlspecialchars($event['date']); ?></div>
                        </div>
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 text-indigo-500 flex-shrink-0"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" /></svg>
                            <div><strong>Time:</strong><br><?php echo htmlspecialchars($event['time']); ?></div>
                        </div>
                        <div class="flex items-start">
                             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 text-indigo-500 flex-shrink-0"><path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.145l.002-.001L10 18.41l.002.001.282.144a5.74 5.74 0 00.28.145l.018.008.006.003.003.001.002.001c.198.086.307.066.307.066s.11-.02.308.066l.002.001.006.003.018.008a5.741 5.741 0 00.281-.145l.002-.001L10 18.41l.002.001.282.144a5.74 5.74 0 00.28.145l.018.008.006.003.003.001ZM10 4a4 4 0 100 8 4 4 0 000-8zm0 6a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                            <div><strong>Location:</strong><br><?php echo htmlspecialchars($event['location_line1']); ?><br><?php echo htmlspecialchars($event['location_line2']); ?></div>
                        </div>
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 text-indigo-500 flex-shrink-0"><path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.96 9.96 0 0010 18c2.21 0 4.21-.74 5.754-1.97.197-.145.346-.36.41-.592A1.23 1.23 0 0016.535 14H3.465z" /></svg>
                            <div><strong>Attendees:</strong><br><?php echo htmlspecialchars($event['attendees_going']); ?> going &bull; <?php echo htmlspecialchars($event['attendees_interested']); ?> interested</div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-3">About this Event</h2>
                        <div class="prose max-w-none text-gray-700 leading-relaxed">
                            <?php echo $event['about']; // HTML is allowed here for line breaks ?>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Schedule:</h3>
                        <ul class="list-disc list-inside text-gray-700 space-y-1">
                            <?php foreach ($event['schedule'] as $item): ?>
                                <li><?php echo htmlspecialchars($item); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <p class="text-gray-700 mb-8 text-sm"><?php echo htmlspecialchars($event['refreshments']); ?></p>

                    <div class="bg-indigo-50 p-6 rounded-lg mb-8">
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Organizer</h3>
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-indigo-500 text-white flex items-center justify-center rounded-full text-xl font-bold mr-4">
                                <?php echo htmlspecialchars($event['organizer_initials']); ?>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800"><?php echo htmlspecialchars($event['organizer_name']); ?></p>
                                <p class="text-sm text-gray-600"><a href="mailto:<?php echo htmlspecialchars($event['organizer_email']); ?>" class="hover:underline"><?php echo htmlspecialchars($event['organizer_email']); ?></a></p>
                                <p class="text-sm text-gray-600"><?php echo htmlspecialchars($event['organizer_phone']); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 mb-10">
                        <button class="w-full sm:w-auto flex-grow bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2"><path fill-rule="evenodd" d="M5.5 2A.5.5 0 005 2.5v15a.5.5 0 00.75.433l4.5-2.25a.5.5 0 01.5 0l4.5 2.25A.5.5 0 0015 17.5v-15a.5.5 0 00-.5-.5H5.5zM14 6a1 1 0 10-2 0 1 1 0 002 0zm-2 5a1 1 0 11-2 0 1 1 0 012 0zM9 6a1 1 0 10-2 0 1 1 0 002 0z" clip-rule="evenodd" /></svg>
                            Register for Event
                        </button>
                        <button class="w-full sm:w-auto bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 px-6 rounded-lg shadow-sm transition duration-300 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2"><path d="M13 4.5a2.5 2.5 0 11.702 4.342L6.056 12.54A2.5 2.5 0 015.5 13V8.382l7.5-3.882zM5.5 2a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM14.5 10a2.5 2.5 0 100 5 2.5 2.5 0 000-5z" /></svg>
                            Share
                        </button>
                    </div>

                    <div>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Comments (<?php echo count($event['comments']); ?>)</h3>
                        <div class="space-y-6 mb-8">
                            <?php foreach($event['comments'] as $comment): ?>
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
                                        <div class="mt-2 text-xs">
                                            <button class="text-indigo-600 hover:underline mr-3">Helpful (<?php echo htmlspecialchars($comment['helpful_count']); ?>)</button>
                                            <button class="text-gray-500 hover:underline">Reply</button>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($comment['reply']): ?>
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
                                    <textarea name="comment_text" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Write your comment..."></textarea>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-300">Post Comment</button>
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
    // Any specific JS for the event detail page can go here
</script>
</body>
</html>
