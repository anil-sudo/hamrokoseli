<x-seller_layout title="Review" searchPlaceholder="Search orders, reviews...">
    <div class="space-y-10">
        <!-- Header -->
        <div>
            <h1 class="text-3xl font-bold text-(--text-color)">Customer Reviews</h1>
            <p class="text-sm text-(--text-color) mt-1">Monitor and respond to customer feedback to maintain your store
                rating.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

            <!-- Total Reviews -->
            <div
                class="card group border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 h-40">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium uppercase tracking-wider text-(--text-color)">
                        Total Reviews
                    </span>
                    <div
                        class="w-10 h-10 rounded-lg bg-(--primary-color)/10 flex items-center justify-center group-hover:scale-102 transition-transform duration-300">
                        <i data-lucide="message-square" class="text-(--primary-color)"></i>
                    </div>
                </div>

                <div class="mt-3">
                    <span class="text-3xl font-extrabold text-(--text-dark)">1,284</span>
                </div>

            </div>

            <!-- Average Rating -->
            <div
                class="card group border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 h-40">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium uppercase tracking-wider text-(--text-color)">
                        Average Rating
                    </span>
                    <div
                        class="w-10 h-10 bg-(--hover-color)/20 rounded-lg flex items-center justify-center group-hover:scale-102 transition-transform duration-300">
                        <i data-lucide="star" class="text-(--hover-color)"></i>
                    </div>
                </div>

                <div class="mt-3">
                    <span class="text-3xl font-extrabold text-(--text-dark)">4.82</span>
                    <span class="text-xl text-(--text-color)/70">/5</span>
                </div>

                <div class="flex items-center gap-1 mt-2">
                    <i data-lucide="star" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                    <i data-lucide="star-half" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                </div>
            </div>



            <!-- Response Rate -->
            <div
                class="card group border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 h-40">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium uppercase tracking-wider text-(--text-color)">
                        Response Rate
                    </span>
                    <div
                        class="w-10 h-10 rounded-lg bg-(--text-dark)/20 flex items-center justify-center group-hover:scale-102 transition-transform duration-300">
                        <i data-lucide="clock" class="text-(--text-dark)"></i>
                    </div>
                </div>

                <div class="mt-3">
                    <span class="text-3xl font-extrabold text-(--text-color)">98%</span>
                </div>

                <div class="w-full bg-[#FFFCF8] rounded-full h-2 mt-3">
                    <div class="bg-[#C65A3A] h-2 rounded-full w-[98%]"></div>
                </div>
            </div>

            <!-- Sentiment Analysis -->
            <div
                class="card group border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 h-40">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm font-medium uppercase tracking-wider text-(--text-color)">
                        Sentiment
                    </span>
                    <div
                        class="w-10 h-10 rounded-lg bg-(--secondary-color)/20 flex items-center justify-center group-hover:scale-102 transition-transform duration-300">
                        <i data-lucide="smile" class="text-[#C65A3A]"></i>
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        <span class="w-8 text-xs text-(--text-color)">Pos</span>
                        <div class="flex-1 bg-[#FFFCF8] rounded-full h-2">
                            <div class="bg-(--primary-color) h-2 rounded-full w-[85%]"></div>
                        </div>
                        <span class="text-xs font-medium text-(--primary-color)">85%</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="w-8 text-xs text-(--text-color)">Neu</span>
                        <div class="flex-1 bg-[#FFFCF8] rounded-full h-2">
                            <div class="bg-(--hover-color) h-2 rounded-full w-[10%]"></div>
                        </div>
                        <span class="text-xs font-medium text-(--hover-color)">10%</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="w-8 text-xs text-(--text-color)">Neg</span>
                        <div class="flex-1 bg-[#FFFCF8] rounded-full h-2">
                            <div class="bg-(--secondary-color) h-2 rounded-full w-[5%]"></div>
                        </div>
                        <span class="text-xs font-medium text-(--secondary-color)">5%</span>
                    </div>
                </div>
            </div>

        </div>
        <!-- Filter + Search -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div class="flex gap-1 bg-(--card-bg) p-1 rounded-2xl w-full md:w-fit overflow-x-auto whitespace-nowrap">
                <button onclick="filterReviews(this)"
                    class="filter-btn shrink-0 px-5 py-2 rounded-xl font-medium text-sm bg-[#1F3D2E] text-white">All</button>
                <button onclick="filterReviews(this)"
                    class="filter-btn shrink-0 px-5 py-2 rounded-xl font-medium text-sm">5
                    Stars <i data-lucide="star"
                        class="inline ml-1 mb-1 w-4 h-4 fill-current text-(--hover-color)"></i></button>
                <button onclick="filterReviews(this)"
                    class="filter-btn shrink-0 px-5 py-2 rounded-xl font-medium text-sm">4
                    Stars <i data-lucide="star"
                        class="inline ml-1 mb-1 w-4 h-4 fill-current text-(--hover-color)"></i></button>
                <button onclick="filterReviews(this)"
                    class="filter-btn shrink-0 px-5 py-2 rounded-xl font-medium text-sm">3
                    Stars <i data-lucide="star"
                        class="inline ml-1 mb-1 w-4 h-4 fill-current text-(--hover-color)"></i></button>
            </div>

            <div class="relative w-full md:w-80">
                <input type="text" id="searchInput" placeholder="Search by product or keyword..."
                    class="w-full pl-11 pr-4 py-3 bg-(--card-bg) border border-[#EDE4D4] rounded-2xl shadow-sm focus:outline-none focus:border-(--secondary-color)">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>

        <!-- Reviews List -->
        <div class="space-y-5" id="reviewsContainer">

            <!-- Review 1 -->
            <div
                class="review-card bg-[#FFF7EF] rounded-xl p-5 border border-[#efe3d5] hover:shadow-md transition-all duration-300">
                <div class="flex flex-wrap justify-between items-start gap-3">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-[#1F3D2E]/10 flex items-center justify-center text-(--text-color) font-bold">
                            SN</div>
                        <div>
                            <h3 class="font-bold text-[#2d2a24] text-lg">Sujit Nepal</h3>
                            <div class="flex flex-wrap gap-2 mt-0.5">
                                <span class="text-xs text-gray-500">
                                    <i data-lucide="calendar" class="inline w- h-3 mb-1"></i>June 12,
                                    2026</span>
                                <span class="text-xs bg-[#f0e7dd] px-2 py-0.5 rounded-full">
                                    <i data-lucide="tag" class="inline w-3 h-3 mr-1"></i>Hand-woven Pashmina
                                    Shawl</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-0.5">
                        <i data-lucide="star" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                    </div>
                </div>
                <p class="text-[#4a3f35] mt-3 text-[15px]">"The quality of the shawl is exceptional! Very warm and
                    beautifully made..."</p>
                <div class="flex items-center gap-4 mt-4 pt-3 border-t border-[#efe3d5] overflow-x-auto">
                    <button onclick="toggleReplyBox(this)"
                        class="reply-btn shrink-0 px-4 py-2 bg-[#C65A3A] text-white rounded-lg text-sm hover:bg-[#B94E31] flex items-center gap-1">
                        <i data-lucide="reply" class="inline w-4 h-4"></i>
                        <span class="inline-flex">Reply &nbsp; Now</span>
                    </button>
                    <button class="text-sm shrink-0 text-gray-500 hover:text-[#C65A3A] flex items-center gap-1">
                        <i data-lucide="share-2" class="inline w-4 h-4"></i>
                        <span>Share</span>
                    </button>
                    <button onclick="openReportModal()"
                        class="text-sm text-gray-500 shrink-0 hover:text-[#C65A3A] flex items-center gap-2">
                        <i data-lucide="flag" class="inline w-4 h-4"></i>
                        <span>Report</span>
                    </button>
                </div>

                <div id="reportModal" class="hidden fixed inset-0 bg-black/40 items-center justify-center p-4 z-50">
                    <div class="bg-[#FFFCF8] rounded-2xl p-5 w-full max-w-md">
                        <h3 class="text-2xl font-semibold mb-4">Report Review</h3>
                        <label class="block text-sm font-medium text-brand-dark mb-2">Select Reason</label>
                        <select
                            class="w-full px-3 py-2 mb-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl focus:outline-none focus:border-(--secondary-color) transition duration-200">
                            <option>Spam</option>
                            <option>Offensive Language</option>
                            <option>Fake Review</option>
                            <option>Harassment</option>
                            <option>Other</option>
                        </select>

                        <textarea
                            class="w-full rounded-lg border border-gray-200 bg-(--card-dark) px-3 sm:px-4 py-2 text-sm resize-none focus:outline-none focus:ring-1 focus:ring-[#C65A3A] focus:border-transparent transition"
                            rows="3" placeholder="Additional details..."></textarea>

                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mt-4">

                            <button
                                class="order-1 sm:order-2 w-full sm:w-auto px-5 py-2 text-sm bg-(--secondary-color) text-white rounded-lg hover:bg-[#B94E31] transition flex items-center justify-center gap-2">
                                <i data-lucide="send" class="h-4 w-4"></i>
                                <span> Submit &nbsp; Report</span>
                            </button>

                            <button onclick="closeReportModal()"
                                class="order-2 sm:order-1 w-full sm:w-auto px-4 py-2 text-sm border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-100 transition">
                                Cancel
                            </button>

                        </div>
                    </div>
                </div>

                <!-- Reply Box -->
                <div class="reply-box hidden mt-5">
                    <div class="bg-[#FFFCF8] border border-[#efe3d5] rounded-xl p-4 sm:p-5 shadow-sm">

                        <!-- Header -->
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 rounded-full bg-[#C65A3A]/10 flex items-center justify-center shink-0">
                                <i data-lucide="reply" class="text-[#C65A3A]"></i>
                            </div>
                            <span class="font-medium text-[#2d2a24] text-sm sm:text-base">
                                Reply to Customer
                            </span>
                        </div>

                        <!-- Textarea -->
                        <textarea
                            class="w-full rounded-xl border border-gray-200 bg-(--card-dark) px-3 sm:px-4 py-3 text-sm resize-none focus:outline-none focus:ring-1 focus:ring-[#C65A3A] focus:border-transparent transition"
                            rows="4" placeholder="Write your response to the customer..."></textarea>

                        <!-- Footer -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mt-4">

                            <p class="text-xs text-gray-500 text-center sm:text-left">
                                Be polite and helpful in your response.
                            </p>

                            <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 w-full sm:w-auto">

                                <button
                                    class="order-1 sm:order-2 w-full sm:w-auto px-5 py-2 text-sm bg-(--secondary-color) text-white rounded-lg
                           hover:bg-[#B94E31] transition flex items-center justify-center gap-2">
                                    <i data-lucide="send" class="h-4 w-4"></i>
                                    <span> Send &nbsp; Reply</span>
                                </button>

                                <button onclick="toggleReplyBox(this)"
                                    class="order-2 sm:order-1 w-full sm:w-auto px-4 py-2 text-sm border border-gray-300 rounded-lg
                           text-gray-600 hover:bg-gray-100 transition">
                                    Cancel
                                </button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Review 2 -->
            <div
                class="review-card bg-[#FFF7EF] rounded-xl p-5 border border-[#efe3d5] hover:shadow-md transition-all duration-300">
                <div class="flex flex-wrap justify-between items-start gap-3">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-[#C65A3A]/10 flex items-center justify-center text-[#C65A3A] font-bold">
                            AD</div>
                        <div>
                            <h3 class="font-bold text-[#2d2a24] text-lg">Anita Dahal</h3>
                            <div class="flex flex-wrap gap-2 mt-0.5">
                                <span class="text-xs text-gray-500"> <i data-lucide="calendar"
                                        class="inline w- h-3 mb-1"></i>June
                                    10, 2024</span>
                                <span class="text-xs bg-[#f0e7dd] px-2 py-0.5 rounded-full">
                                    <i data-lucide="tag" class="inline w-3 h-3 mr-1"></i></i>Dhaka Topi - Traditional
                                    Collection</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-0.5">
                        <i data-lucide="star" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                    </div>
                </div>
                <p class="text-[#4a3f35] mt-3 text-[15px]">"The pattern is very pretty, but the size was a bit larger
                    than expected..."</p>


                <div class="flex items-center gap-4 mt-4 pt-3 border-t border-[#efe3d5] overflow-x-auto">
                     <button onclick="toggleReplyBox(this)"
                        class="reply-btn shrink-0 px-4 py-2 bg-[#C65A3A] text-white rounded-lg text-sm hover:bg-[#B94E31] flex items-center gap-1">
                        <i data-lucide="reply" class="inline w-4 h-4"></i>
                        <span class="inline-flex">Reply &nbsp; Now</span>
                    </button>
                    <button class="text-sm shrink-0 text-gray-500 hover:text-[#C65A3A] flex items-center gap-1">
                        <i data-lucide="share-2" class="inline w-4 h-4"></i>
                        <span>Share</span>
                    </button>
                    <button onclick="openReportModal()"
                        class="text-sm text-gray-500 shrink-0 hover:text-[#C65A3A] flex items-center gap-2">
                        <i data-lucide="flag" class="inline w-4 h-4"></i>
                        <span>Report</span>
                    </button>
                </div>

                <div id="reportModal" class="hidden fixed inset-0 bg-black/40 items-center justify-center p-4 z-50">
                    <div class="bg-[#FFFCF8] rounded-2xl p-5 w-full max-w-md">
                        <h3 class="text-2xl font-semibold mb-4">Report Review</h3>
                        <label class="block text-sm font-medium text-brand-dark mb-2">Select Reason</label>
                        <select
                            class="w-full px-3 py-2 mb-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl focus:outline-none focus:border-(--secondary-color) transition duration-200">
                            <option>Spam</option>
                            <option>Offensive Language</option>
                            <option>Fake Review</option>
                            <option>Harassment</option>
                            <option>Other</option>
                        </select>

                        <textarea
                            class="w-full rounded-lg border border-gray-200 bg-(--card-dark) px-3 sm:px-4 py-2 text-sm resize-none focus:outline-none focus:ring-1 focus:ring-[#C65A3A] focus:border-transparent transition"
                            rows="3" placeholder="Additional details..."></textarea>

                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mt-4">

                            <button
                                class="order-1 sm:order-2 w-full sm:w-auto px-5 py-2 text-sm bg-(--secondary-color) text-white rounded-lg hover:bg-[#B94E31] transition flex items-center justify-center gap-2">
                                <i data-lucide="send" class="h-4 w-4"></i>
                                <span> Submit &nbsp; Report</span>
                            </button>

                            <button onclick="closeReportModal()"
                                class="order-2 sm:order-1 w-full sm:w-auto px-4 py-2 text-sm border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-100 transition">
                                Cancel
                            </button>

                        </div>
                    </div>
                </div>

                <!-- Reply Box -->
                <div class="reply-box hidden mt-5">
                    <div class="bg-[#FFFCF8] border border-[#efe3d5] rounded-xl p-4 sm:p-5 shadow-sm">

                        <!-- Header -->
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 rounded-full bg-[#C65A3A]/10 flex items-center justify-center shink-0">
                                <i data-lucide="reply" class="text-[#C65A3A]"></i>
                            </div>
                            <span class="font-medium text-[#2d2a24] text-sm sm:text-base">
                                Reply to Customer
                            </span>
                        </div>

                        <!-- Textarea -->
                        <textarea
                            class="w-full rounded-xl border border-gray-200 bg-(--card-dark) px-3 sm:px-4 py-3 text-sm resize-none focus:outline-none focus:ring-1 focus:ring-[#C65A3A] focus:border-transparent transition"
                            rows="4" placeholder="Write your response to the customer..."></textarea>

                        <!-- Footer -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mt-4">

                            <p class="text-xs text-gray-500 text-center sm:text-left">
                                Be polite and helpful in your response.
                            </p>

                            <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 w-full sm:w-auto">

                                <button
                                    class="order-1 sm:order-2 w-full sm:w-auto px-5 py-2 text-sm bg-(--secondary-color) text-white rounded-lg
                           hover:bg-[#B94E31] transition flex items-center justify-center gap-2">
                                    <i data-lucide="send" class="h-4 w-4"></i>
                                    <span> Send &nbsp; Reply</span>
                                </button>
                                <button onclick="toggleReplyBox(this)"
                                    class="order-2 sm:order-1 w-full sm:w-auto px-4 py-2 text-sm border border-gray-300 rounded-lg
                           text-gray-600 hover:bg-gray-100 transition">
                                    Cancel
                                </button>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Review 3 -->
            <div
                class="review-card bg-[#FFF7EF] rounded-xl p-5 border border-[#efe3d5] hover:shadow-md transition-all duration-300">
                <div class="flex flex-wrap justify-between items-start gap-3">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-amber-700/10 flex items-center justify-center text-amber-800 font-bold">
                            RK</div>
                        <div>
                            <h3 class="font-bold text-[#2d2a24] text-lg">RK</h3>
                            <div class="flex flex-wrap gap-2 mt-0.5">
                                <span class="text-xs text-gray-500"> <i data-lucide="calendar"
                                        class="inline w- h-3 mb-1"></i>June
                                    08, 2024</span>
                                <span class="text-xs bg-[#f0e7dd] px-2 py-0.5 rounded-full">
                                    <i data-lucide="tag" class="inline w-3 h-3 mr-1"></i></i>Hand-carved Wooden
                                    Mask</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-0.5">
                        <i data-lucide="star" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                    </div>
                </div>
                <p class="text-[#4a3f35] mt-3 text-[15px]">"Very disappointed with the shipping time. It took 3
                    weeks..."</p>


                <div class="flex items-center gap-4 mt-4 pt-3 border-t border-[#efe3d5] overflow-x-auto">
                    <button onclick="toggleReplyBox(this)"
                        class="reply-btn shrink-0 px-4 py-2 bg-[#C65A3A] text-white rounded-lg text-sm hover:bg-[#B94E31] flex items-center gap-1">
                        <i data-lucide="reply" class="inline w-4 h-4"></i>
                        <span class="inline-flex">Reply &nbsp; Now</span>
                    </button>
                    <button class="text-sm shrink-0 text-gray-500 hover:text-[#C65A3A] flex items-center gap-1">
                        <i data-lucide="share-2" class="inline w-4 h-4"></i>
                        <span>Share</span>
                    </button>
                    <button onclick="openReportModal()"
                        class="text-sm text-gray-500 shrink-0 hover:text-[#C65A3A] flex items-center gap-2">
                        <i data-lucide="flag" class="inline w-4 h-4"></i>
                        <span>Report</span>
                    </button>
                </div>

                <div id="reportModal" class="hidden fixed inset-0 bg-black/40 items-center justify-center p-4 z-50">
                    <div class="bg-[#FFFCF8] rounded-2xl p-5 w-full max-w-md">
                        <h3 class="text-2xl font-semibold mb-4">Report Review</h3>
                        <label class="block text-sm font-medium text-brand-dark mb-2">Select Reason</label>
                        <select
                            class="w-full px-3 py-2 mb-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl focus:outline-none focus:border-(--secondary-color) transition duration-200">
                            <option>Spam</option>
                            <option>Offensive Language</option>
                            <option>Fake Review</option>
                            <option>Harassment</option>
                            <option>Other</option>
                        </select>

                        <textarea
                            class="w-full rounded-lg border border-gray-200 bg-(--card-dark) px-3 sm:px-4 py-2 text-sm resize-none focus:outline-none focus:ring-1 focus:ring-[#C65A3A] focus:border-transparent transition"
                            rows="3" placeholder="Additional details..."></textarea>

                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mt-4">

                            <button
                                class="order-1 sm:order-2 w-full sm:w-auto px-5 py-2 text-sm bg-(--secondary-color) text-white rounded-lg hover:bg-[#B94E31] transition flex items-center justify-center gap-2">
                                <i data-lucide="send" class="h-4 w-4"></i>
                                <span> Submit &nbsp; Report</span>
                            </button>

                            <button onclick="closeReportModal()"
                                class="order-2 sm:order-1 w-full sm:w-auto px-4 py-2 text-sm border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-100 transition">
                                Cancel
                            </button>

                        </div>
                    </div>
                </div>

                <!-- Reply Box -->
                <div class="reply-box hidden mt-5">
                    <div class="bg-[#FFFCF8] border border-[#efe3d5] rounded-xl p-4 sm:p-5 shadow-sm">

                        <!-- Header -->
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 rounded-full bg-[#C65A3A]/10 flex items-center justify-center shink-0">
                                <i data-lucide="reply" class="text-[#C65A3A]"></i>
                            </div>
                            <span class="font-medium text-[#2d2a24] text-sm sm:text-base">
                                Reply to Customer
                            </span>
                        </div>

                        <!-- Textarea -->
                        <textarea
                            class="w-full rounded-xl border border-gray-200 bg-(--card-dark) px-3 sm:px-4 py-3 text-sm resize-none focus:outline-none focus:ring-1 focus:ring-[#C65A3A] focus:border-transparent transition"
                            rows="4" placeholder="Write your response to the customer..."></textarea>

                        <!-- Footer -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mt-4">

                            <p class="text-xs text-gray-500 text-center sm:text-left">
                                Be polite and helpful in your response.
                            </p>

                            <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 w-full sm:w-auto">

                                <button
                                    class="order-1 sm:order-2 w-full sm:w-auto px-5 py-2 text-sm bg-(--secondary-color) text-white rounded-lg
                           hover:bg-[#B94E31] transition flex items-center justify-center gap-2">
                                    <i data-lucide="send" class="h-4 w-4"></i>
                                    <span> Send &nbsp; Reply</span>
                                </button>
                                <button onclick="toggleReplyBox(this)"
                                    class="order-2 sm:order-1 w-full sm:w-auto px-4 py-2 text-sm border border-gray-300 rounded-lg
                           text-gray-600 hover:bg-gray-100 transition">
                                    Cancel
                                </button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-10">
            <nav class="flex items-center gap-2">
                <button
                    class="px-3 py-1 rounded-md border border-[#e0d3c4] bg-white text-[#3A2A1F] text-sm hover:bg-[#1F3D2E] hover:text-white">Previous</button>
                <button class="px-3 py-1 rounded-md bg-[#1F3D2E] text-white text-sm">1</button>
                <button
                    class="px-3 py-1 rounded-md border border-[#e0d3c4] bg-white text-[#3A2A1F] text-sm hover:bg-[#1F3D2E] hover:text-white">2</button>
                <button
                    class="px-3 py-1 rounded-md border border-[#e0d3c4] bg-white text-[#3A2A1F] text-sm hover:bg-[#1F3D2E] hover:text-white">3</button>
                <button
                    class="px-3 py-1 rounded-md border border-[#e0d3c4] bg-white text-[#3A2A1F] text-sm hover:bg-[#1F3D2E] hover:text-white">Next</button>
            </nav>
        </div>
    </div>
    <style>
        .reply-box {
            transition: all 0.3s ease;
        }
    </style>

    <script>
        // Toggle Reply Box
        function toggleReplyBox(btn) {
            const reviewCard = btn.closest('.review-card');
            const replyBox = reviewCard.querySelector('.reply-box');

            replyBox.classList.toggle('hidden');

            const replyBtn = reviewCard.querySelector('.reply-btn');
            if (!replyBox.classList.contains('hidden')) {
                replyBtn.innerHTML = `<i data-lucide="x" class="inline w-4 h-4"></i> Close &nbsp; Reply`;
                lucide.createIcons();
            } else {
                replyBtn.innerHTML = `<i data-lucide="reply" class="inline w-4 h-4"></i> <span>Reply &nbsp; Now</span>`;
                lucide.createIcons();
            }
        }

        // Filter Buttons
        function filterReviews(btn) {
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('bg-[#1F3D2E]', 'text-white');
            });
            btn.classList.add('bg-[#1F3D2E]', 'text-white');
        }

        function openReportModal() {
            const modal = document.getElementById('reportModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeReportModal() {
            const modal = document.getElementById('reportModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</x-seller_layout>
