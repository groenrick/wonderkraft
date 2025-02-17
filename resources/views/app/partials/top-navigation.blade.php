<style>
    .notification-popup {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        width: 320px;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        z-index: 50;
        margin-top: 0.5rem;
    }

    .notification-popup.show {
        display: block;
    }

    .notification-item {
        padding: 1rem;
        border-bottom: 1px solid #e5e7eb;
        cursor: pointer;
    }

    .notification-item:last-child {
        border-bottom: none;
    }

    .notification-item:hover {
        background-color: #f3f4f6;
    }
</style>

<nav class="fixed top-0 left-0 right-0 bg-white border-b z-30">
    <div class="px-4 mx-auto">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center gap-4">
                <button class="p-2 text-gray-600 rounded-lg hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span class="text-xl font-semibold text-gray-800">Admin Dashboard</span>
            </div>

            <div class="flex items-center gap-6">
                <!-- Search -->
                <div class="relative hidden md:block">
                    <input
                        type="text"
                        placeholder="Search..."
                        class="w-80 pl-10 pr-4 py-2 bg-gray-50 border rounded-lg focus:outline-none focus:border-blue-500"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <!-- Notifications -->
                <div class="relative">
                    <button id="notificationButton" class="relative p-2 text-gray-600 rounded-lg hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    <!-- Notification Popup -->
                    <div id="notificationPopup" class="notification-popup">
                        <div class="py-2 px-4 bg-gray-50 border-b">
                            <h3 class="font-semibold text-gray-900">Notifications</h3>
                        </div>
                        <div class="notification-item">
                            <p class="text-sm text-gray-800">New user registration</p>
                            <span class="text-xs text-gray-500">2 minutes ago</span>
                        </div>
                        <div class="notification-item">
                            <p class="text-sm text-gray-800">Server update completed</p>
                            <span class="text-xs text-gray-500">1 hour ago</span>
                        </div>
                        <div class="notification-item">
                            <p class="text-sm text-gray-800">Database backup successful</p>
                            <span class="text-xs text-gray-500">3 hours ago</span>
                        </div>
                    </div>
                </div>

                <!-- Profile -->
                <div class="flex items-center gap-3">
                    <img src="/api/placeholder/32/32" alt="Profile" class="w-8 h-8 rounded-full">
                    <span class="hidden md:inline text-sm font-medium">John Doe</span>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const notificationButton = document.getElementById('notificationButton');
        const notificationPopup = document.getElementById('notificationPopup');
        let isPopupOpen = false;

        // Toggle popup when clicking the notification button
        notificationButton.addEventListener('click', function(e) {
            e.stopPropagation();
            isPopupOpen = !isPopupOpen;
            notificationPopup.classList.toggle('show');
        });

        // Close popup when clicking outside
        document.addEventListener('click', function(e) {
            if (isPopupOpen && !notificationPopup.contains(e.target)) {
                notificationPopup.classList.remove('show');
                isPopupOpen = false;
            }
        });
    });
</script>
