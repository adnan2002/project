<?php // marketplace_item_detail.php - Marketplace Item Detail Page ?>
<?php
// In a real application, you would get item ID from $_GET
// and fetch data from a database. For this example, we use static data.
$item_detail = [
    'id' => 1, // Example item ID
    'main_image_url' => 'https://placehold.co/800x600/E2E8F0/4A5568?text=MacBook+Pro+13',
    'gallery_images' => [
        'https://placehold.co/100x75/E2E8F0/4A5568?text=Side+View',
        'https://placehold.co/100x75/E2E8F0/4A5568?text=Keyboard',
        'https://placehold.co/100x75/E2E8F0/4A5568?text=Screen+On',
        'https://placehold.co/100x75/E2E8F0/4A5568?text=With+Box',
    ],
    'title' => 'MacBook Pro 13" (2021) - M1 Chip',
    'category' => 'Electronics',
    'condition' => 'Like New',
    'price' => 899,
    'original_price' => 1299,
    'listed_date' => 'May 2, 2025', // Using current year for example
    'location_on_campus' => true,
    'description' => 'Selling my MacBook Pro 13" with M1 chip. Purchased in 2021 and used lightly for school work. In excellent condition with no scratches or dents. Comes with original charger and box. Battery health at 92%.',
    'features' => [ // Switched to features as per image, specs are part of description
        'Apple M1 Chip with 8-core CPU and 8-core GPU',
        '8GB unified memory',
        '256GB SSD storage',
        '13.3-inch Retina display with True Tone',
        'Backlit Magic Keyboard',
        'Touch Bar and Touch ID',
        'Two Thunderbolt / USB 4 ports',
        'Force Touch trackpad',
        'Wi-Fi 6 and Bluetooth 5.0',
        'FaceTime HD camera',
        'Stereo speakers with high dynamic range',
        'Currently running macOS Sonoma'
    ],
    'reason_for_selling' => 'Upgrading to the new M3 model for my design work.',
    'seller' => [
        'avatar_url' => 'https://placehold.co/80x80/CBD5E0/4A5568?text=MT',
        'name' => 'Michael Thompson',
        'details' => 'Senior, Computer Science',
        'rating' => 4.8,
        'reviews_count' => 17,
        'member_since' => 'September 2022',
        'response_rate' => '98%',
        'response_time' => 'Usually within 2 hours'
    ],
    'similar_items' => [
        ['id' => 2, 'image' => 'https://placehold.co/80x60/E2E8F0/4A5568?text=iPad', 'title' => 'iPad Pro 11" (2022)', 'price' => 649, 'condition' => 'Good'],
        ['id' => 3, 'image' => 'https://placehold.co/80x60/E2E8F0/4A5568?text=AirPods', 'title' => 'AirPods Pro (2nd Gen)', 'price' => 179, 'condition' => 'Like New'],
        ['id' => 4, 'image' => 'https://placehold.co/80x60/E2E8F0/4A5568?text=Keyboard', 'title' => 'Apple Magic Keyboard', 'price' => 89, 'condition' => 'Good'],
    ]
];

include 'header.php';
?>

<div class="flex flex-col min-h-screen">
    <main class="flex-grow container mx-auto px-4 py-8 md:py-12">
        <div class="mb-6">
            <a href="student_marketplace.php" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 transition duration-300 group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back to Marketplace
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white p-6 md:p-8 rounded-xl shadow-xl">
                <div class="mb-6">
                    <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden mb-3 shadow">
                        <img id="mainProductImage" src="<?php echo htmlspecialchars($item_detail['main_image_url']); ?>" alt="<?php echo htmlspecialchars($item_detail['title']); ?>" class="w-full h-full object-contain bg-gray-100">
                    </div>
                    <div class="grid grid-cols-4 gap-2">
                        <?php foreach($item_detail['gallery_images'] as $img_src): ?>
                        <div class="aspect-w-1 aspect-h-1 rounded overflow-hidden cursor-pointer border-2 border-transparent hover:border-indigo-500 transition-all" onclick="document.getElementById('mainProductImage').src='<?php echo htmlspecialchars(str_replace('100x75', '800x600', $img_src)); //簡易拡大 ?>'">
                            <img src="<?php echo htmlspecialchars($img_src); ?>" alt="Thumbnail" class="w-full h-full object-cover bg-gray-100">
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start mb-2">
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-1 sm:mb-0"><?php echo htmlspecialchars($item_detail['title']); ?></h1>
                        <div class="text-right">
                            <p class="text-3xl font-bold text-teal-600">$<?php echo htmlspecialchars($item_detail['price']); ?></p>
                            <?php if(isset($item_detail['original_price'])): ?>
                            <p class="text-sm text-gray-500 line-through">$<?php echo htmlspecialchars($item_detail['original_price']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-gray-500 mb-3">
                        <span class="inline-block bg-gray-100 text-gray-700 px-2 py-0.5 rounded-full"><?php echo htmlspecialchars($item_detail['category']); ?></span>
                        <span class="inline-block bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full"><?php echo htmlspecialchars($item_detail['condition']); ?></span>
                    </div>
                    <div class="text-xs text-gray-500">
                        Listed on <?php echo htmlspecialchars($item_detail['listed_date']); ?>
                        <?php if($item_detail['location_on_campus']): ?>
                            <span class="mx-1">&bull;</span> <span class="text-green-600 font-medium">On Campus</span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <button id="tab-description" onclick="showTab('description')" class="tab-button border-indigo-500 text-indigo-600 whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm">Description</button>
                            <button id="tab-features" onclick="showTab('features')" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm">Features</button>
                        </nav>
                    </div>
                    <div id="content-description" class="tab-content py-5 prose max-w-none text-gray-700 leading-relaxed">
                        <p><?php echo nl2br(htmlspecialchars($item_detail['description'])); ?></p>
                        <?php if(!empty($item_detail['reason_for_selling'])): ?>
                        <h4 class="font-semibold mt-4">Reason for selling:</h4>
                        <p><?php echo htmlspecialchars($item_detail['reason_for_selling']); ?></p>
                        <?php endif; ?>
                    </div>
                    <div id="content-features" class="tab-content py-5 prose max-w-none text-gray-700 leading-relaxed hidden">
                        <h4 class="font-semibold mb-2">Key Features:</h4>
                        <ul class="list-disc list-inside space-y-1">
                            <?php foreach($item_detail['features'] as $feature): ?>
                                <li><?php echo htmlspecialchars($feature); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800">Campus Marketplace Safety Tips</h3>
                            <div class="mt-2 text-sm text-blue-700">
                                <ul class="list-disc space-y-1 pl-5">
                                    <li>Meet in a public place on campus for exchanges.</li>
                                    <li>Inspect items thoroughly before purchasing.</li>
                                    <li>Use secure payment methods.</li>
                                    <li>Report suspicious listings to campus security.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <img src="<?php echo htmlspecialchars($item_detail['seller']['avatar_url']); ?>" alt="<?php echo htmlspecialchars($item_detail['seller']['name']); ?>" class="w-16 h-16 rounded-full mr-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800"><?php echo htmlspecialchars($item_detail['seller']['name']); ?></h3>
                            <p class="text-xs text-gray-500"><?php echo htmlspecialchars($item_detail['seller']['details']); ?></p>
                            <div class="flex items-center mt-1">
                                <?php for($i=0; $i<5; $i++): ?>
                                    <svg class="w-3 h-3 <?php echo ($i < floor($item_detail['seller']['rating'])) ? 'text-yellow-400' : 'text-gray-300'; ?>" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <?php endfor; ?>
                                <span class="text-xs text-gray-500 ml-1"><?php echo htmlspecialchars($item_detail['seller']['rating']); ?> (<?php echo htmlspecialchars($item_detail['seller']['reviews_count']); ?> reviews)</span>
                            </div>
                        </div>
                    </div>
                    <ul class="text-xs text-gray-600 space-y-1 mb-4">
                        <li>Member since: <?php echo htmlspecialchars($item_detail['seller']['member_since']); ?></li>
                        <li>Response rate: <span class="font-medium text-green-600"><?php echo htmlspecialchars($item_detail['seller']['response_rate']); ?></span></li>
                        <li>Response time: <?php echo htmlspecialchars($item_detail['seller']['response_time']); ?></li>
                    </ul>
                    <button class="w-full bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2.5 px-4 rounded-lg shadow-md transition duration-300 mb-2">Contact Seller</button>
                    <button class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2.5 px-4 rounded-lg border border-gray-300 transition duration-300">Make an Offer</button>
                    <div class="flex justify-between items-center mt-4 text-sm">
                        <button class="text-gray-500 hover:text-indigo-600 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" /></svg>
                            Save
                        </button>
                        <button class="text-gray-500 hover:text-indigo-600 flex items-center">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5Zm0 0v-.106c0-.414.336-.75.75-.75h6.536a.75.75 0 0 1 .75.75v.106c0 .414-.336.75-.75.75h-6.536a.75.75 0 0 1-.75-.75ZM12 15.75a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5Zm0 0v-.106c0-.414.336-.75.75-.75h1.536a.75.75 0 0 1 .75.75v.106c0 .414-.336.75-.75.75h-1.536a.75.75 0 0 1-.75-.75Zm-3.75 2.25a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5Z" /></svg>
                            Share
                        </button>
                    </div>
                     <a href="#" class="block text-center text-xs text-red-500 hover:underline mt-4">Report this listing</a>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-lg font-semibold text-gray-800">Similar Items</h3>
                        <a href="student_marketplace.php?category=<?php echo urlencode($item_detail['category']); ?>" class="text-xs text-indigo-600 hover:underline">View more &gt;</a>
                    </div>
                    <ul class="space-y-3">
                        <?php foreach($item_detail['similar_items'] as $s_item): ?>
                        <li>
                            <a href="marketplace_item_detail.php?id=<?php echo $s_item['id']; ?>" class="flex items-center group">
                                <img src="<?php echo htmlspecialchars($s_item['image']); ?>" alt="<?php echo htmlspecialchars($s_item['title']); ?>" class="w-16 h-12 object-cover rounded mr-3">
                                <div class="flex-grow">
                                    <p class="text-sm font-medium text-gray-700 group-hover:text-indigo-600 transition-colors"><?php echo htmlspecialchars($s_item['title']); ?></p>
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm font-semibold text-teal-600">$<?php echo htmlspecialchars($s_item['price']); ?></p>
                                        <span class="text-xs bg-blue-100 text-blue-700 px-1.5 py-0.5 rounded-full"><?php echo htmlspecialchars($s_item['condition']); ?></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include 'footer.php'; ?>

<script>
    function showTab(tabName) {
        // Hide all tab content
        document.getElementById('content-description').classList.add('hidden');
        document.getElementById('content-features').classList.add('hidden');
        // Deactivate all tab buttons
        document.getElementById('tab-description').classList.remove('border-indigo-500', 'text-indigo-600');
        document.getElementById('tab-description').classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
        document.getElementById('tab-features').classList.remove('border-indigo-500', 'text-indigo-600');
        document.getElementById('tab-features').classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');

        // Show selected tab content and activate button
        document.getElementById('content-' + tabName).classList.remove('hidden');
        document.getElementById('tab-' + tabName).classList.add('border-indigo-500', 'text-indigo-600');
        document.getElementById('tab-' + tabName).classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
    }
</script>
</body>
</html>
