{{-- resources/views/corporate/partials/header.blade.php --}}
<header class="fixed w-full bg-white shadow-sm z-50">
    <nav class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <a href="/" class="text-xl font-bold text-gray-800">WonderKraft</a>

                <div class="hidden md:flex items-center space-x-8 ml-12">
                    <!-- Features Dropdown -->
                    <div class="relative" id="featuresDropdown">
                        <button class="text-gray-600 hover:text-gray-900 inline-flex items-center">
                            Features
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden" id="featuresMenu">
                            <a href="#visual-builder" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Visual Builder</a>
                            <a href="#cms" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Content Management</a>
                            <a href="#seo" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">SEO Tools</a>
                        </div>
                    </div>
                    <a href="#pricing" class="text-gray-600 hover:text-gray-900">Pricing</a>
                    <a href="{{ route('corporate.blog') }}" class="text-gray-600 hover:text-gray-900">Blog</a>
                </div>
            </div>

            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Sign In</a>
                <a href="{{ route('app.register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Start Free Trial
                </a>
            </div>

            <div class="md:hidden">
                <button type="button" class="text-gray-600 hover:text-gray-900 p-2" onclick="toggleMobileMenu()">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div class="md:hidden hidden" id="mobileMenu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <div class="relative">
                    <button
                        class="w-full text-left px-3 py-2 text-gray-600 hover:text-gray-900 flex items-center justify-between"
                        onclick="toggleMobileSubmenu()"
                    >
                        <span>Features</span>
                        <svg class="w-4 h-4 ml-1 transform transition-transform duration-200" id="featuresArrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="hidden pl-4 py-2" id="mobileSubmenu">
                        <a href="#visual-builder" class="block px-3 py-2 text-gray-600 hover:text-gray-900">Visual Builder</a>
                        <a href="#cms" class="block px-3 py-2 text-gray-600 hover:text-gray-900">Content Management</a>
                        <a href="#seo" class="block px-3 py-2 text-gray-600 hover:text-gray-900">SEO Tools</a>
                    </div>
                </div>
                <a href="#pricing" class="block px-3 py-2 text-gray-600 hover:text-gray-900">Pricing</a>
                <a href="{{ route('corporate.blog') }}" class="block px-3 py-2 text-gray-600 hover:text-gray-900">Blog</a>
                <div class="border-t border-gray-200 my-2"></div>
                <a href="{{ route('login') }}" class="block px-3 py-2 text-gray-600 hover:text-gray-900">Sign In</a>
                <a href="{{ route('app.register') }}" class="block px-3 py-2 text-blue-600 hover:text-blue-700">Start Free Trial</a>
            </div>
        </div>
    </nav>
</header>

<script>
    // Mobile menu toggle
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('hidden');
    }

    // Mobile submenu toggle
    function toggleMobileSubmenu() {
        const submenu = document.getElementById('mobileSubmenu');
        const arrow = document.getElementById('featuresArrow');
        submenu.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
    }

    // Desktop Features dropdown
    const featuresDropdown = document.getElementById('featuresDropdown');
    const featuresMenu = document.getElementById('featuresMenu');
    let timeoutId;

    featuresDropdown.addEventListener('mouseenter', () => {
        clearTimeout(timeoutId);
        featuresMenu.classList.remove('hidden');
    });

    featuresDropdown.addEventListener('mouseleave', () => {
        timeoutId = setTimeout(() => {
            featuresMenu.classList.add('hidden');
        }, 100);
    });

    featuresMenu.addEventListener('mouseenter', () => {
        clearTimeout(timeoutId);
    });

    featuresMenu.addEventListener('mouseleave', () => {
        featuresMenu.classList.add('hidden');
    });
</script>
