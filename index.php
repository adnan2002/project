
<?php

include 'header.php'; ?>

<main>
    <section id="hero" class="bg-indigo-700 text-white py-20 md:py-32">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Welcome to Campus Hub</h1>
            <p class="text-lg md:text-xl mb-8">Your one-stop platform for all campus resources and activities</p>
            <div class="space-x-4">
                <a href="#modules" class="bg-white text-indigo-700 font-semibold py-3 px-6 rounded-lg shadow-md hover:bg-indigo-100 transition duration-300">Explore Modules</a>
                <a href="#about" class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300">Learn More</a>
            </div>
        </div>
    </section>

    <section id="modules" class="py-16 md:py-24 bg-slate-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-12 md:mb-16">Campus Modules</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-blue-100 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col">
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-blue-600 mr-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12v-.008ZM12 18h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75v-.008ZM9.75 18h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5v-.008ZM7.5 18h.008v.008H7.5v-.008ZM14.25 15h.008v.008H14.25v-.008ZM14.25 18h.008v.008H14.25v-.008ZM16.5 15h.008v.008H16.5v-.008ZM16.5 18h.008v.008H16.5v-.008Z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-800">Events Calendar</h3>
                    </div>
                    <p class="text-gray-600 mb-4 text-sm flex-grow">Stay updated with all campus events and activities. Never miss an important event again.</p>
                    <a href="./events.php" class="text-blue-600 font-semibold hover:text-blue-800 transition duration-300 self-start">Explore events &rarr;</a>
                </div>

                <div class="bg-purple-100 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col">
                    <div class="flex items-center mb-4">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-purple-600 mr-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-800">Study Group Finder</h3>
                    </div>
                    <p class="text-gray-600 mb-4 text-sm flex-grow">Find or create study groups for your courses. Collaborate with peers and excel in your studies.</p>
                    <a href="./study_groups.php" class="text-purple-600 font-semibold hover:text-purple-800 transition duration-300 self-start">Find study groups &rarr;</a>
                </div>

                <div class="bg-green-100 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col">
                     <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-green-600 mr-3">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.822.672l-4.684-2.79a.563.563 0 0 0-.652 0l-4.684 2.79a.562.562 0 0 1-.822-.672l1.285-5.385a.562.562 0 0 0-.182-.557l-4.204-3.602a.563.563 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-800">Course Reviews</h3>
                    </div>
                    <p class="text-gray-600 mb-4 text-sm flex-grow">Read and write reviews for courses. Make informed decisions about your academic journey.</p>
                    <a href="./course_reviews.php" class="text-green-600 font-semibold hover:text-green-800 transition duration-300 self-start">View reviews &rarr;</a>
                </div>

                <div class="bg-yellow-100 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col">
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-yellow-600 mr-3">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-800">Course Notes</h3>
                    </div>
                    <p class="text-gray-600 mb-4 text-sm flex-grow">Share and access course notes. Enhance your learning with comprehensive study materials.</p>
                    <a href="./course_notes.php" class="text-yellow-600 font-semibold hover:text-yellow-800 transition duration-300 self-start">Access notes &rarr;</a>
                </div>
                
                <div class="bg-red-100 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col">
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-red-600 mr-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25H5.625a2.25 2.25 0 0 1-2.25-2.25V7.5c0-.621.504-1.125 1.125-1.125H9M7.5 11.25h.008v.008H7.5v-.008Zm0 3h.008v.008H7.5v-.008Zm0 3h.008v.008H7.5v-.008Z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-800">Campus News</h3>
                    </div>
                    <p class="text-gray-600 mb-4 text-sm flex-grow">Stay informed with the latest campus news and announcements from administration and student groups.</p>
                    <a href="./campus_news.php" class="text-red-600 font-semibold hover:text-red-800 transition duration-300 self-start">Read news &rarr;</a>
                </div>

                <div class="bg-fuchsia-100 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col">
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-fuchsia-600 mr-3">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 1.516M6.528 9.918A9 9 0 0 1 12.75 3.031m0 0a9 9 0 0 1 6.222 6.887M12.75 3.031a9 9 0 0 1-6.222 6.887m6.222-6.887L18.5 7.5M12.75 3.03V5.25m0 0A2.25 2.25 0 0 1 15 7.5v.208c0 .621.448 1.17.956 1.397l.703.422a2.25 2.25 0 0 1 .956 1.397V13.5A2.25 2.25 0 0 1 15 15.75v.208c0 .621-.448 1.17-.956 1.397l-.703.422a2.25 2.25 0 0 1-.956 1.397V21m-4.5 0V19.208c0-.621.448-1.17.956-1.397l.703-.422a2.25 2.25 0 0 1 .956-1.397V13.5A2.25 2.25 0 0 1 10.5 11.25v-.208c0-.621-.448-1.17-.956-1.397L8.84 9.23a2.25 2.25 0 0 1-.956-1.397V5.25A2.25 2.25 0 0 1 10.5 3m-3.75 0h7.5" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-800">Club Activities</h3>
                    </div>
                    <p class="text-gray-600 mb-4 text-sm flex-grow">Discover and join clubs and organizations on campus. Engage in activities that match your interests.</p>
                    <a href="./club_activities.php" class="text-fuchsia-600 font-semibold hover:text-fuchsia-800 transition duration-300 self-start">Explore clubs &rarr;</a>
                </div>

                 <div class="bg-cyan-100 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col sm:col-span-1 lg:col-span-1"> <div class="flex items-center mb-4">
                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-cyan-600 mr-3">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-800">Student Marketplace</h3>
                    </div>
                    <p class="text-gray-600 mb-4 text-sm flex-grow">Buy, sell, or exchange items with fellow students. Find textbooks, furniture, electronics, and more.</p>
                    <a href="student_marketplace.php" class="text-cyan-600 font-semibold hover:text-cyan-800 transition duration-300 self-start">Browse marketplace &rarr;</a>
                </div>
            </div>
        </div>
    </section>
    
    <section id="about" class="py-16 md:py-24 bg-white hidden">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-12">About Campus Hub</h2>
            <p class="text-gray-600 text-lg text-center max-w-3xl mx-auto">
                Campus Hub is dedicated to providing a centralized platform for students to access essential campus resources,
                connect with peers, and stay informed about everything happening on campus. Our goal is to make your
                university life more organized, engaging, and successful.
            </p>
        </div>
    </section>

</main>

<?php include 'footer.php'; ?>

<script>
    // Smooth scroll for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                // If the target is the #about section, toggle its visibility
                if (targetId === '#about') {
                    targetElement.classList.toggle('hidden');
                }
                
                // Scroll to the element
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
</script>

</body>
</html>

