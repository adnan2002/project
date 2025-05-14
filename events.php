<?php
// Include header first, which will start the session
include 'header.php'; 

// Now check the session status
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
                            <a href="events.php" class="flex items-center text-indigo-600 bg-indigo-100 p-3 rounded-lg font-semibold transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12v-.008ZM12 18h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75v-.008ZM9.75 18h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5v-.008ZM7.5 18h.008v.008H7.5v-.008ZM14.25 15h.008v.008H14.25v-.008ZM14.25 18h.008v.008H14.25v-.008ZM16.5 15h.008v.008H16.5v-.008ZM16.5 18h.008v.008H16.5v-.008Z" />
                                </svg>
                                Events Calendar
                            </a>
                        </li>
                        <li>
                            <a href="./study_groups.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>
                                Study Group Finder
                            </a>
                        </li>
                         <li>
                            <a href="./course_reviews.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300">
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
                            <a href="#" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300">
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
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 sm:mb-0">Events Calendar</h1>
                    
                    
                        
                            
                            <button 
                            onclick="handleCreateEvent()"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-5 rounded-lg shadow-md transition duration-300 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Create Event
                            </button>
                           
                             
                            
                            

                        
                    
                </div>

                <div class="mb-8 p-6 bg-white rounded-xl shadow-lg">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        <div class="md:col-span-1">
                            <label for="search-events" class="block text-sm font-medium text-gray-700 mb-1">Search events...</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </div>
                                <input type="search" id="search-events" class="w-full p-2 pl-10 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Event name, keyword...">
                            </div>
                        </div>
                        <div>
                            <label for="event-category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select id="event-category" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                <option selected>All Categories</option>
                                <option>Academic</option>
                                <option>Workshop</option>
                                <option>Social</option>
                                <option>Sports</option>
                                <option>Arts & Culture</option>
                            </select>
                        </div>
                        <div>
                            <label for="event-timing" class="block text-sm font-medium text-gray-700 mb-1">Timing</label>
                            <select id="event-timing" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                <option selected>Upcoming</option>
                                <option>Past Events</option>
                                <option>Today</option>
                                <option>This Week</option>
                                <option>This Month</option>
                            </select>
                        </div>
                    </div>
                </div>

                 <div class="space-y-6">
                    <?php
                    // Placeholder event data - In a real application, this would come from a database
                    $events = [
                        [
                            'date_month' => 'APR', 'date_day' => '12', 'day_of_week' => 'Friday',
                            'category' => 'Academic', 'category_color' => 'bg-blue-500',
                            'title' => 'Spring Research Symposium', 'time' => '4:00 PM - 8:00 PM',
                            'description' => 'Join us for the annual Spring Research Symposium where students present their research projects from various disciplines.',
                            'location' => 'Student Center, Grand Hall', 'attendees' => '120 attendees', 'bg_color' => 'bg-blue-50'
                        ],
                        [
                            'date_month' => 'APR', 'date_day' => '15', 'day_of_week' => 'Monday',
                            'category' => 'Workshop', 'category_color' => 'bg-green-500',
                            'title' => 'Resume Building Workshop', 'time' => '2:00 PM - 4:00 PM',
                            'description' => 'Learn how to create a standout resume that will catch employers\' attention. Bring your laptop and current resume.',
                            'location' => 'Career Center, Room 105', 'attendees' => '45 attendees', 'bg_color' => 'bg-green-50'
                        ],
                         [
                            'date_month' => 'APR', 'date_day' => '18', 'day_of_week' => 'Thursday',
                            'category' => 'Social', 'category_color' => 'bg-purple-500',
                            'title' => 'International Food Festival', 'time' => '5:30 PM - 9:00 PM',
                            'description' => 'Celebrate cultural diversity with dishes from around the world. Tickets: $5 for students, $10 for non-students.',
                            'location' => 'Campus Quad', 'attendees' => '300+ attendees', 'bg_color' => 'bg-purple-50'
                        ],
                        [
                            'date_month' => 'APR', 'date_day' => '20', 'day_of_week' => 'Saturday',
                            'category' => 'Sports', 'category_color' => 'bg-red-500',
                            'title' => 'Spring Intramural Tournament', 'time' => '10:00 AM - 6:00 PM',
                            'description' => 'Join various sports tournaments including basketball, soccer, and volleyball. Register your team by April 15.',
                            'location' => 'University Recreation Center', 'attendees' => '200 participants', 'bg_color' => 'bg-red-50'
                        ],
                    ];

                    foreach ($events as $event): ?>
                        <div class="event-card <?php echo htmlspecialchars($event['bg_color']); ?> p-6 rounded-xl shadow-lg flex flex-col sm:flex-row gap-6 hover:shadow-xl transition-shadow duration-300">
                            <div class="flex-shrink-0 text-center sm:text-left mb-4 sm:mb-0">
                                <div class="text-indigo-600 font-bold text-sm"><?php echo htmlspecialchars($event['date_month']); ?></div>
                                <div class="text-3xl font-bold text-gray-800"><?php echo htmlspecialchars($event['date_day']); ?></div>
                                <div class="text-gray-600 text-sm"><?php echo htmlspecialchars($event['day_of_week']); ?></div>
                            </div>
                            <div class="border-l-2 border-gray-200 pl-6 flex-grow">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full <?php echo htmlspecialchars($event['category_color']); ?> text-white">
                                            <?php echo htmlspecialchars($event['category']); ?>
                                        </span>
                                        <h3 class="text-xl font-semibold text-gray-800 mt-1"><?php echo htmlspecialchars($event['title']); ?></h3>
                                    </div>
                                    <span class="text-sm text-gray-600 font-medium whitespace-nowrap"><?php echo htmlspecialchars($event['time']); ?></span>
                                </div>
                                <p class="text-gray-700 text-sm mb-3"><?php echo htmlspecialchars($event['description']); ?></p>
                                <div class="text-xs text-gray-500">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 inline-block mr-1 align-text-bottom">
                                           <path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 0 0 .281-.145l.002-.001L10 18.41l.002.001.282.144a5.74 5.74 0 0 0 .28.145l.018.008.006.003c.001 0 .002.001.003.001.198.086.307.066.307.066s.11-.02.308.066l.002.001.006.003.018.008a5.741 5.741 0 0 0 .281-.145l.002-.001L10 18.41l.002.001.282.144a5.74 5.74 0 0 0 .28.145l.018.008.006.003.003.001ZM10 4c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4Zm0 6c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2Z" clip-rule="evenodd" />
                                           <path d="m10.002 1.043.002-.001a3.34 3.34 0 0 1 .716.098 1.25 1.25 0 0 1 .614.367c.205.22.34.498.396.79.077.404.087.914.02 1.485-.05.435-.122.93-.215 1.459a24.591 24.591 0 0 1-.216 1.459c-.093.529-.164 1.024-.215 1.459-.066.571-.056 1.081.02 1.485.056.292.19.57.396.79.223.24.48.399.767.498a3.34 3.34 0 0 1 .716.098l.002-.001c3.081.446 5.498 2.07 5.498 4.012 0 1.139-.705 2.166-1.833 2.825-.17.098-.352.183-.543.255l-.006.002a6.977 6.977 0 0 1-.217.063l.002.001c.199-.086.308-.066.308-.066s.11.02.308.066l.003.001.006.003a5.738 5.738 0 0 1 .28.145l.002.001c.234.133.426.287.568.457.16.19.288.413.372.653.09.256.135.529.135.808 0 .445-.098.866-.28 1.242a3.331 3.331 0 0 1-.815 1.103 3.332 3.332 0 0 1-1.242.815c-.376.182-.797.28-1.242.28-.279 0-.552-.045-.808-.135a3.336 3.336 0 0 1-.653-.372A3.332 3.332 0 0 1 10 18.411a3.332 3.332 0 0 1-.457-.568 3.336 3.336 0 0 1-.653-.372c-.256-.09-.529-.135-.808-.135-.445 0-.866.098-1.242.28a3.331 3.331 0 0 1-1.103.815 3.332 3.332 0 0 1-.815 1.242c-.182.376-.28.797-.28 1.242 0 .279.045.552.135.808.084.24.212.463.372.653.142.17.334.324.568.457l.002.001a5.738 5.738 0 0 1 .28.145l.006.003.003.001s.11-.02.308.066l.002.001a6.977 6.977 0 0 1-.217-.063l.006-.002c-.19-.072-.372-.157-.543-.255C2.705 17.123 2 16.096 2 14.957c0-1.942 2.417-3.566 5.498-4.012l.002.001a3.34 3.34 0 0 1 .716-.098 1.25 1.25 0 0 1 .614-.367c.205-.22.34-.498.396-.79.077-.404.087-.914.02-1.485-.05-.435-.122-.93-.215-1.459a24.591 24.591 0 0 1-.216-1.459c-.093-.529-.164-1.024-.215-1.459-.066-.571-.056-1.081.02-1.485.056-.292.19-.57.396-.79.223-.24.48-.399.767-.498A3.34 3.34 0 0 1 10 1.043Z" />
                                        </svg>
                                        <?php echo htmlspecialchars($event['location']); ?>
                                    </span>
                                    <span class="mx-2">&bull;</span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 inline-block mr-1 align-text-bottom">
                                            <path d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.23 1.23 0 0 0 .41 1.412A9.96 9.96 0 0 0 10 18c2.21 0 4.21-.74 5.754-1.97.197-.145.346-.36.41-.592A1.23 1.23 0 0 0 16.535 14H3.465Z" />
                                            <path d="M12.56 5.1h-.668a.75.75 0 0 1 0-1.5h.668A.75.75 0 0 1 12.56 5.1ZM15.332 5.1h-.668a.75.75 0 0 1 0-1.5h.668a.75.75 0 0 1 0 1.5Z" />
                                            <path d="M3.465 12.007a1.23 1.23 0 0 0 .41 1.412A9.96 9.96 0 0 0 10 15.6c2.21 0 4.21-.74 5.754-1.97.197-.145.346-.36.41-.592A1.23 1.23 0 0 0 16.535 11.5H3.465Z" />
                                        </svg>
                                        <?php echo htmlspecialchars($event['attendees']); ?>
                                    </span>
                                </div>
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
                    <a href="#" class="px-4 py-2 rounded-md hover:bg-gray-200 text-gray-700">6</a>
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

  <script defer>
    function handleCreateEvent() {
      const isAuth = <?php echo $is_auth ? 'true' : 'false'; ?>;
      if (isAuth) {
        window.location.href = 'create_event.php';
      } else {
        window.location.href = 'login.php';
      }
    }
  </script>



<?php include 'footer.php'; ?>