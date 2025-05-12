<?php // club_detail.php - Club Detail Page ?>
<?php
// In a real application, you would get club ID from $_GET
// and fetch data from a database. For this example, we use static data for "Photography Club".
$club_detail = [
    'id' => 1, // Example club ID
    'banner_image_url' => 'https://placehold.co/1200x300/C4B5FD/4338CA?text=Photography+Club+Banner',
    'banner_image_alt' => 'Photography Club Banner',
    'icon_placeholder_bg' => 'bg-gray-300', // Placeholder for club icon
    'name' => 'Photography Club',
    'category' => 'Arts & Media',
    'category_color' => 'bg-amber-500', // From club_activities.php example
    'members_count' => 87,
    'meeting_schedule' => 'Every Tuesday, 5:00 PM - 7:00 PM',
    'location' => 'Arts Building, Room 302',
    'join_club_text' => "We're currently accepting new members! Join us to explore the world of photography together.",
    'about_us_p1' => "The Photography Club was founded in 2018 by a group of passionate students who wanted to create a space for photography enthusiasts to learn, share, and grow together. Since then, we've organized numerous exhibitions, workshops, and photo walks around campus and the city.",
    'about_us_p2' => "Our club welcomes photographers of all skill levels, from complete beginners to seasoned professionals. We provide access to equipment, darkroom facilities, and editing software for our members.",
    'contact_president' => 'Emma Rodriguez',
    'contact_email' => 'photo.club@campus.edu',
    'contact_instagram' => '@campus_photo_club',
    'officers' => [
        ['avatar' => 'https://placehold.co/100x100/E0E7FF/4F46E5?text=ER', 'name' => 'Emma Rodriguez', 'title' => 'President', 'year' => 'Senior'],
        ['avatar' => 'https://placehold.co/100x100/DBEAFE/1D4ED8?text=JK', 'name' => 'Jason Kim', 'title' => 'Vice President', 'year' => 'Junior'],
        ['avatar' => 'https://placehold.co/100x100/FCE7F3/DB2777?text=MP', 'name' => 'Maya Patel', 'title' => 'Treasurer', 'year' => 'Sophomore'],
        ['avatar' => 'https://placehold.co/100x100/FEF3C7/D97706?text=TJ', 'name' => 'Tyler Johnson', 'title' => 'Events Coordinator', 'year' => 'Junior'],
    ],
    'testimonials' => [
        ['avatar' => 'https://placehold.co/80x80/E0E7FF/4F46E5?text=AC', 'name' => 'Alex Chen', 'year' => 'Junior', 'quote' => "Joining the Photography Club was one of the best decisions I made in college. I've learned so much and made amazing friends who share my passion."],
        ['avatar' => 'https://placehold.co/80x80/DBEAFE/1D4ED8?text=SW', 'name' => 'Sophia Williams', 'year' => 'Senior', 'quote' => "The club provided me with opportunities to showcase my work and connect with professional photographers in the industry."],
    ],
    'similar_clubs' => [
        ['id' => 2, 'initials' => 'F', 'name' => 'Film Society', 'category' => 'Arts & Media', 'avatar_bg' => 'bg-purple-200 text-purple-700'],
        ['id' => 3, 'initials' => 'D', 'name' => 'Digital Media Club', 'category' => 'Arts & Media', 'avatar_bg' => 'bg-pink-200 text-pink-700'],
        ['id' => 4, 'initials' => 'V', 'name' => 'Visual Arts Association', 'category' => 'Arts & Media', 'avatar_bg' => 'bg-indigo-200 text-indigo-700'],
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
                        <li><a href="study_groups.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" /></svg>Study Group Finder</a></li>
                        <li><a href="course_reviews.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.822.672l-4.684-2.79a.563.563 0 0 0-.652 0l-4.684 2.79a.562.562 0 0 1-.822-.672l1.285-5.385a.562.562 0 0 0-.182-.557l-4.204-3.602a.563.563 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" /></svg>Course Reviews</a></li>
                        <li><a href="course_notes.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>Course Notes</a></li>
                        <li><a href="campus_news.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25H5.625a2.25 2.25 0 0 1-2.25-2.25V7.5c0-.621.504-1.125 1.125-1.125H9M7.5 11.25h.008v.008H7.5v-.008Zm0 3h.008v.008H7.5v-.008Zm0 3h.008v.008H7.5v-.008Z" /></svg>Campus News</a></li>
                        <li><a href="club_activities.php" class="flex items-center text-indigo-600 bg-indigo-100 p-3 rounded-lg font-semibold transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 1.516M6.528 9.918A9 9 0 0 1 12.75 3.031m0 0a9 9 0 0 1 6.222 6.887M12.75 3.031a9 9 0 0 1-6.222 6.887m6.222-6.887L18.5 7.5M12.75 3.03V5.25m0 0A2.25 2.25 0 0 1 15 7.5v.208c0 .621.448 1.17.956 1.397l.703.422a2.25 2.25 0 0 1 .956 1.397V13.5A2.25 2.25 0 0 1 15 15.75v.208c0 .621-.448 1.17-.956 1.397l-.703.422a2.25 2.25 0 0 1-.956 1.397V21m-4.5 0V19.208c0-.621.448-1.17.956-1.397l.703-.422a2.25 2.25 0 0 1 .956-1.397V13.5A2.25 2.25 0 0 1 10.5 11.25v-.208c0-.621-.448-1.17-.956-1.397L8.84 9.23a2.25 2.25 0 0 1-.956-1.397V5.25A2.25 2.25 0 0 1 10.5 3m-3.75 0h7.5" /></svg>Club Activities</a></li>
                        <li><a href="#" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>Student Marketplace</a></li>
                    </ul>
                </nav>
            </aside>

            <div class="w-full md:w-3/4 lg:w-4/5">
                <div class="mb-6">
                    <a href="club_activities.php" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 transition duration-300 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        Back to Clubs
                    </a>
                </div>

                <div class="bg-white rounded-xl shadow-xl overflow-hidden">
                    <div class="h-48 md:h-64 bg-cover bg-center" style="background-image: url('<?php echo htmlspecialchars($club_detail['banner_image_url']); ?>');">
                        </div>

                    <div class="p-6 md:p-8">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center mb-6">
                            <div class="w-24 h-24 <?php echo htmlspecialchars($club_detail['icon_placeholder_bg']); ?> rounded-full flex items-center justify-center text-4xl text-white font-bold mr-6 mb-4 sm:mb-0 flex-shrink-0 shadow-md">
                                <?php echo strtoupper(substr($club_detail['name'], 0, 1)); ?>
                            </div>
                            <div>
                                <h1 class="text-3xl md:text-4xl font-bold text-gray-800"><?php echo htmlspecialchars($club_detail['name']); ?></h1>
                                <p class="text-indigo-600 font-semibold"><?php echo htmlspecialchars($club_detail['category']); ?></p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-b border-gray-200 py-4 mb-8 text-sm text-gray-700">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 text-gray-400"><path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.96 9.96 0 0010 18c2.21 0 4.21-.74 5.754-1.97.197-.145.346-.36.41-.592A1.23 1.23 0 0016.535 14H3.465z" /></svg>
                                <strong>Members:</strong>&nbsp;<?php echo htmlspecialchars($club_detail['members_count']); ?>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 text-gray-400"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" /></svg>
                                <strong>Meetings:</strong>&nbsp;<?php echo htmlspecialchars($club_detail['meeting_schedule']); ?>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 text-gray-400"><path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.145l.002-.001L10 18.41l.002.001.282.144a5.74 5.74 0 00.28.145l.018.008.006.003.003.001.002.001c.198.086.307.066.307.066s.11-.02.308.066l.002.001.006.003.018.008a5.741 5.741 0 00.281-.145l.002-.001L10 18.41l.002.001.282.144a5.74 5.74 0 00.28.145l.018.008.006.003.003.001ZM10 4a4 4 0 100 8 4 4 0 000-8zm0 6a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                                <strong>Location:</strong>&nbsp;<?php echo htmlspecialchars($club_detail['location']); ?>
                            </div>
                        </div>
                        
                        <div class="mb-8">
                            <div class="border-b border-gray-200">
                                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                    <a href="#" class="border-indigo-500 text-indigo-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" aria-current="page">About</a>
                                    <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Events</a>
                                    <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Gallery</a>
                                </nav>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <div class="lg:col-span-2 space-y-8">
                                <section id="about-us">
                                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">About Us</h2>
                                    <div class="prose max-w-none text-gray-700 leading-relaxed">
                                        <p><?php echo $club_detail['about_us_p1']; ?></p>
                                        <p><?php echo $club_detail['about_us_p2']; ?></p>
                                    </div>
                                </section>

                                <section id="club-officers">
                                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Club Officers</h2>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                                        <?php foreach($club_detail['officers'] as $officer): ?>
                                        <div class="text-center">
                                            <img src="<?php echo htmlspecialchars($officer['avatar']); ?>" alt="<?php echo htmlspecialchars($officer['name']); ?>" class="w-24 h-24 rounded-full mx-auto mb-2 shadow-md">
                                            <h4 class="font-semibold text-gray-800"><?php echo htmlspecialchars($officer['name']); ?></h4>
                                            <p class="text-sm text-indigo-600"><?php echo htmlspecialchars($officer['title']); ?></p>
                                            <p class="text-xs text-gray-500"><?php echo htmlspecialchars($officer['year']); ?></p>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </section>

                                <section id="member-testimonials">
                                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Member Testimonials</h2>
                                    <div class="space-y-6">
                                        <?php foreach($club_detail['testimonials'] as $testimonial): ?>
                                        <div class="bg-gray-50 p-4 rounded-lg flex items-start">
                                            <img src="<?php echo htmlspecialchars($testimonial['avatar']); ?>" alt="<?php echo htmlspecialchars($testimonial['name']); ?>" class="w-12 h-12 rounded-full mr-4 flex-shrink-0">
                                            <div>
                                                <p class="text-gray-700 italic">"<?php echo htmlspecialchars($testimonial['quote']); ?>"</p>
                                                <p class="text-sm font-semibold text-gray-600 mt-2">- <?php echo htmlspecialchars($testimonial['name']); ?>, <span class="font-normal"><?php echo htmlspecialchars($testimonial['year']); ?></span></p>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </section>
                            </div>

                            <div class="lg:col-span-1 space-y-8">
                                <div class="bg-indigo-50 p-6 rounded-lg shadow-sm">
                                    <h3 class="text-xl font-semibold text-indigo-800 mb-2">Join Our Club</h3>
                                    <p class="text-sm text-indigo-700 mb-4"><?php echo htmlspecialchars($club_detail['join_club_text']); ?></p>
                                    <button class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-2.5 px-4 rounded-lg shadow-md transition duration-300">Apply to Join</button>
                                </div>
                                <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Contact Information</h3>
                                    <p class="text-sm text-gray-700"><strong>President:</strong> <?php echo htmlspecialchars($club_detail['contact_president']); ?></p>
                                    <p class="text-sm text-gray-700"><strong>Email:</strong> <a href="mailto:<?php echo htmlspecialchars($club_detail['contact_email']); ?>" class="text-indigo-600 hover:underline"><?php echo htmlspecialchars($club_detail['contact_email']); ?></a></p>
                                    <p class="text-sm text-gray-700"><strong>Instagram:</strong> <a href="#" class="text-indigo-600 hover:underline"><?php echo htmlspecialchars($club_detail['contact_instagram']); ?></a></p>
                                    <div class="flex gap-2 mt-4">
                                        <button class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-semibold py-2 px-4 rounded-lg shadow-sm transition duration-300">Message</button>
                                        <button class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-semibold py-2 px-4 rounded-lg shadow-sm transition duration-300">Share</button>
                                    </div>
                                </div>
                                 <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Similar Clubs</h3>
                                    <ul class="space-y-3">
                                        <?php foreach($club_detail['similar_clubs'] as $s_club): ?>
                                        <li>
                                            <a href="club_detail.php?id=<?php echo $s_club['id']; ?>" class="flex items-center group">
                                                <div class="w-8 h-8 <?php echo htmlspecialchars($s_club['avatar_bg']); ?> rounded-full flex items-center justify-center text-sm font-bold mr-3">
                                                    <?php echo htmlspecialchars($s_club['initials']); ?>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-indigo-600 group-hover:underline"><?php echo htmlspecialchars($s_club['name']); ?></p>
                                                    <p class="text-xs text-gray-500"><?php echo htmlspecialchars($s_club['category']); ?></p>
                                                </div>
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
        </div>
    </main>
</div>

<?php include 'footer.php'; ?>

<script>
    // Any specific JS for the club detail page can go here
</script>
</body>
</html>
