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
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12v-.008ZM12 18h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75v-.008ZM9.75 18h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5v-.008ZM7.5 18h.008v.008H7.5v-.008ZM14.25 15h.008v.008H14.25v-.008ZM14.25 18h.008v.008H14.25v-.008ZM16.5 15h.008v.008H16.5v-.008ZM16.5 18h.008v.008H16.5v-.008Z" /></svg>
                                Events Calendar
                            </a>
                        </li>
                        <li>
                            <a href="study_groups.php" class="flex items-center text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-3 rounded-lg transition duration-300">
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
                            <a href="student_marketplace.php" class="flex items-center text-indigo-600 bg-indigo-100 p-3 rounded-lg font-semibold transition duration-300">
                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                                Student Marketplace
                            </a>
                        </li>
                    </ul>
                </nav>
            </aside>

            <div class="w-full md:w-3/4 lg:w-4/5">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 sm:mb-0">Student Marketplace</h1>
                    
                   
                    <button onclick="handleListItem()" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-5 rounded-lg shadow-md transition duration-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        List Item
                    </button>
                   
                </div>

                <div class="mb-8 p-6 bg-white rounded-xl shadow-lg">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        <div class="md:col-span-1">
                            <label for="search-items" class="block text-sm font-medium text-gray-700 mb-1">Search items by name, category, or description...</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </div>
                                <input type="search" id="search-items" class="w-full p-2 pl-10 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g., Textbook or TI-84">
                            </div>
                        </div>
                        <div>
                            <label for="item-category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select id="item-category" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                <option selected>All Categories</option>
                                <option>Textbooks</option>
                                <option>Electronics</option>
                                <option>Furniture</option>
                                <option>Clothing</option>
                                <option>Services</option>
                                <option>Event Tickets</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div>
                            <label for="item-sort" class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                            <select id="item-sort" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                <option selected>Most Recent</option>
                                <option>Price: Low to High</option>
                                <option>Price: High to Low</option>
                                <option>Oldest</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php
                    // Placeholder marketplace item data
                    $items = [
                        [
                            'image_url' => 'https://placehold.co/400x300/E0E7FF/4338CA?text=Calculus+Textbook',
                            'image_alt' => 'Calculus Textbook',
                            'category' => 'Textbooks',
                            'category_color' => 'bg-sky-500',
                            'name' => 'Calculus: Early Transcendentals',
                            'price' => 65,
                            'description' => '9th Edition, excellent condition with minimal highlighting. Used for MATH 201.',
                            'condition' => 'Like New',
                            'posted_date' => '2 days ago'
                        ],
                        [
                            'image_url' => 'https://placehold.co/400x300/FEF3C7/D97706?text=Desk+Lamp',
                            'image_alt' => 'Desk Lamp',
                            'category' => 'Furniture',
                            'category_color' => 'bg-amber-500',
                            'name' => 'Adjustable Desk Lamp with USB Port',
                            'price' => 25,
                            'description' => 'LED desk lamp with adjustable brightness, color temperature, and built-in USB charging port.',
                            'condition' => 'Good Condition',
                            'posted_date' => '1 week ago'
                        ],
                        [
                            'image_url' => 'https://placehold.co/400x300/D1FAE5/047857?text=TI-84+Calculator',
                            'image_alt' => 'Graphing Calculator',
                            'category' => 'Electronics',
                            'category_color' => 'bg-emerald-500',
                            'name' => 'TI-84 Plus Graphing Calculator',
                            'price' => 70,
                            'description' => 'Texas Instruments TI-84 Plus graphing calculator. Works perfectly, includes batteries and case.',
                            'condition' => 'Excellent Condition',
                            'posted_date' => '3 days ago'
                        ],
                        [
                            'image_url' => 'https://placehold.co/400x300/FCE7F3/DB2777?text=Concert+Tickets',
                            'image_alt' => 'Concert Tickets',
                            'category' => 'Event Tickets',
                            'category_color' => 'bg-pink-500',
                            'name' => 'Spring Concert Tickets (2)',
                            'price' => 40,
                            'description' => 'Two tickets for the upcoming Spring Fest concert. Section A, Row 10.',
                            'condition' => 'N/A',
                            'posted_date' => '1 day ago'
                        ],
                         [
                            'image_url' => 'https://placehold.co/400x300/E0E7FF/4338CA?text=Biology+Textbook+Bundle',
                            'image_alt' => 'Biology Textbook Bundle',
                            'category' => 'Textbooks',
                            'category_color' => 'bg-sky-500',
                            'name' => 'Biology Textbook Bundle',
                            'price' => 90,
                            'description' => 'Includes textbook, lab manual, and solution guide for BIO 101 & 102. Great value!',
                            'condition' => 'Very Good',
                            'posted_date' => '5 days ago'
                        ],
                        [
                            'image_url' => 'https://placehold.co/400x300/F3E8FF/7E22CE?text=Tutoring+Services',
                            'image_alt' => 'Tutoring Services Flyer',
                            'category' => 'Services',
                            'category_color' => 'bg-purple-500',
                            'name' => 'Computer Science Tutoring',
                            'price' => '25/hr',
                            'description' => 'Experienced CS major offering tutoring for introductory programming courses (Python, Java).',
                            'condition' => 'N/A',
                            'posted_date' => '4 days ago'
                        ],
                         [
                            'image_url' => 'https://placehold.co/400x300/FEF9C3/CA8A04?text=Mini+Fridge',
                            'image_alt' => 'Mini Fridge',
                            'category' => 'Furniture',
                            'category_color' => 'bg-yellow-500',
                            'name' => 'Mini Fridge for Dorm Room',
                            'price' => 50,
                            'description' => 'Compact mini fridge, perfect for dorms. Clean and works great. Energy efficient model.',
                            'condition' => 'Good Condition',
                            'posted_date' => '10 days ago'
                        ],
                        [
                            'image_url' => 'https://placehold.co/400x300/CFFAFE/0891B2?text=Noise+Cancelling+Headphones',
                            'image_alt' => 'Noise Cancelling Headphones',
                            'category' => 'Electronics',
                            'category_color' => 'bg-cyan-500',
                            'name' => 'Noise-Cancelling Headphones',
                            'price' => 80,
                            'description' => 'Barely used noise-cancelling over-ear headphones. Great for studying. Comes with case and cables.',
                            'condition' => 'Like New',
                            'posted_date' => '6 days ago'
                        ],
                    ];

                    foreach ($items as $item): ?>
                        <div class="marketplace-item-card bg-white rounded-xl shadow-lg overflow-hidden flex flex-col hover:shadow-2xl transition-shadow duration-300">
                            <div class="relative">
                                <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['image_alt']); ?>" class="w-full h-48 object-cover">
                                <span class="absolute top-2 left-2 text-xs font-semibold inline-block py-1 px-3 uppercase rounded-full <?php echo htmlspecialchars($item['category_color']); ?> text-white">
                                    <?php echo htmlspecialchars($item['category']); ?>
                                </span>
                                <span class="absolute top-2 right-2 bg-black bg-opacity-50 text-white text-lg font-bold py-1 px-3 rounded-md">
                                    $<?php echo htmlspecialchars($item['price']); ?><?php if(is_string($item['price']) && str_contains($item['price'], '/hr')) echo ''; else if (is_numeric($item['price'])) ''; ?>
                                </span>
                            </div>
                            <div class="p-4 flex flex-col flex-grow">
                                <h3 class="text-lg font-semibold text-gray-800 mb-1"><?php echo htmlspecialchars($item['name']); ?></h3>
                                <p class="text-gray-600 text-sm mb-3 flex-grow leading-relaxed line-clamp-3"><?php echo htmlspecialchars($item['description']); ?></p>
                                
                                <div class="text-xs text-gray-500 space-y-1 mt-auto">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 mr-1.5 text-gray-400"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>
                                        Condition: <?php echo htmlspecialchars($item['condition']); ?>
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 mr-1.5 text-gray-400"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" /></svg>
                                        Posted <?php echo htmlspecialchars($item['posted_date']); ?>
                                    </div>
                                </div>
                                <a href="#" class="mt-4 block bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 text-center">View Item</a>
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
                    <a href="#" class="px-4 py-2 rounded-md hover:bg-gray-200 text-gray-700">8</a>
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
    function handleListItem() {
      const isAuth = <?php echo $is_auth ? 'true' : 'false'; ?>;
      if (isAuth) {
        window.location.href = 'list_item.php';
      } else {
        window.location.href = 'login.php';
      }
    }
  </script>

</body>
</html>
