{{-- resources/views/corporate/home.blade.php --}}
@extends('corporate.layouts.main')

@section('title', 'Build Websites Faster - WonderKraft')

@section('content')
    {{-- Hero Section --}}
    <section class="pt-24 bg-gradient-to-br from-blue-900 to-indigo-900 text-white">
        <div class="container mx-auto px-4 py-24">
            <div class="max-w-4xl mx-auto text-center">
                <span class="inline-block px-4 py-2 rounded-full bg-blue-500 bg-opacity-20 text-blue-200 text-sm mb-6">
                    Launch your website in minutes
                </span>
                <h1 class="text-5xl font-bold mb-6">The Modern Website Builder for Growing Businesses</h1>
                <p class="text-xl text-blue-100 mb-8">Create, manage, and scale your website with our intuitive CMS platform. No coding required.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('corporate.pricing') }}" class="bg-white text-blue-900 px-8 py-4 rounded-lg font-medium hover:bg-blue-50">
                        Start Free Trial
                    </a>
                    <a href="#how-it-works" class="border border-white hover:bg-white hover:text-blue-900 px-8 py-4 rounded-lg font-medium">
                        See How It Works
                    </a>
                </div>
                <div class="mt-12 text-blue-200 text-sm">
                    ✓ No credit card required &nbsp;&nbsp; ✓ 14-day free trial &nbsp;&nbsp; ✓ Cancel anytime
                </div>
            </div>
        </div>
    </section>

{{--    --}}{{-- Social Proof --}}
{{--    <section class="py-12 bg-gray-50">--}}
{{--        <div class="container mx-auto px-4">--}}
{{--            <p class="text-center text-gray-600 mb-8">Trusted by 10,000+ businesses worldwide</p>--}}
{{--            <div class="flex flex-wrap justify-center items-center gap-12 opacity-50">--}}
{{--                @foreach(['Company 1', 'Company 2', 'Company 3', 'Company 4', 'Company 5'] as $company)--}}
{{--                    <span class="text-xl font-semibold text-gray-400">{{ $company }}</span>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    {{-- Features Grid --}}
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">Everything You Need to Succeed Online</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Our platform provides all the tools you need to build and manage your website effectively.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach([
                    [
                        'title' => 'Visual Page Builder',
                        'description' => 'Drag-and-drop interface for creating beautiful pages without code',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" /></svg>'
                    ],
                    [
                        'title' => 'Content Management',
                        'description' => 'Organize and update your content with our powerful CMS tools',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>'
                    ],
                    [
                        'title' => 'SEO Tools',
                        'description' => 'Built-in SEO features to help your website rank better',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>'
                    ],
                ] as $feature)
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mb-4">
                            {!! $feature['icon'] !!}
                        </div>
                        <h3 class="text-xl font-semibold mb-2">{{ $feature['title'] }}</h3>
                        <p class="text-gray-600">{{ $feature['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- How It Works --}}
    <section id="how-it-works" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">How It Works</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Get your website up and running in three simple steps
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                @foreach([
                    [
                        'step' => '1',
                        'title' => 'Choose Your Template',
                        'description' => 'Select from our collection of professional templates'
                    ],
                    [
                        'step' => '2',
                        'title' => 'Customize Your Site',
                        'description' => 'Add your content and customize the design to match your brand'
                    ],
                    [
                        'step' => '3',
                        'title' => 'Launch & Grow',
                        'description' => 'Publish your site and start attracting visitors'
                    ]
                ] as $step)
                    <div class="text-center">
                        <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4">
                            {{ $step['step'] }}
                        </div>
                        <h3 class="text-xl font-semibold mb-2">{{ $step['title'] }}</h3>
                        <p class="text-gray-600">{{ $step['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Pricing Section --}}
    <section id="pricing" class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">Simple, Transparent Pricing</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Choose the plan that's right for your business
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                @foreach([
    [
        'name' => 'Hobby',
        'price' => '9',
        'description' => 'Perfect for side projects',
        'features' => [
            '1 Website',
            '10 Pages',
            'Basic Analytics',
            'GitHub Discussions Support',
            'Join Developer Community'
        ]
    ],
    [
        'name' => 'Creator',
        'price' => '29',
        'description' => 'For indie creators & startups',
        'features' => [
            '3 Websites',
            'Unlimited Pages',
            'Advanced Analytics',
            'GitHub Issues Support',
            'API Access',
            'Custom Themes'
        ],
        'popular' => true
    ],
    [
        'name' => 'Studio',
        'price' => '79',
        'description' => 'For small web studios',
        'features' => [
            '10 Websites',
            'Unlimited Pages',
            'White Label Option',
            'Database Export',
            'Staging Environments',
            'Early Access Features'
        ]
    ]
] as $plan)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-8 {{ isset($plan['popular']) ? 'ring-2 ring-blue-600' : '' }}">
                        @if(isset($plan['popular']))
                            <span class="inline-block px-3 py-1 rounded-full bg-blue-100 text-blue-600 text-sm mb-4">Most Popular</span>
                        @endif
                        <h3 class="text-2xl font-bold mb-2">{{ $plan['name'] }}</h3>
                        <p class="text-gray-600 mb-4">{{ $plan['description'] }}</p>
                        <div class="mb-6">
                            <span class="text-4xl font-bold">${{ $plan['price'] }}</span>
                            <span class="text-gray-600">/month</span>
                        </div>
                        <ul class="space-y-3 mb-8">
                            @foreach($plan['features'] as $feature)
                                <li class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('corporate.pricing') }}"
                           class="block w-full text-center py-3 rounded-lg {{ isset($plan['popular']) ? 'bg-blue-600 text-white hover:bg-blue-700' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}">
                            Get Started
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-20 bg-blue-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Ready to Get Started?</h2>
            <p class="text-xl mb-8 text-blue-100">Join thousands of businesses already using our platform</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('corporate.pricing') }}"
                   class="bg-white text-blue-600 px-8 py-4 rounded-lg font-medium hover:bg-blue-50">
                    Start Free Trial
                </a>
                <a href="{{ route('corporate.contact') }}"
                   class="border border-white hover:bg-white hover:text-blue-600 px-8 py-4 rounded-lg font-medium">
                    Contact Sales
                </a>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">Frequently Asked Questions</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Got questions? We've got answers.
                </p>
            </div>

            <div class="max-w-3xl mx-auto space-y-6">
                @foreach([
                    [
                        'question' => 'How long is the free trial?',
                        'answer' => 'Our free trial lasts for 14 days, giving you full access to all features. No credit card required.'
                    ],
                    [
                        'question' => 'Can I switch plans later?',
                        'answer' => 'Yes, you can upgrade or downgrade your plan at any time. Changes will be reflected in your next billing cycle.'
                    ],
                    [
                        'question' => 'Do I need technical knowledge?',
                        'answer' => 'No technical knowledge is required. Our platform is designed to be user-friendly and intuitive.'
                    ],
                    [
                        'question' => 'What kind of support do you offer?',
                        'answer' => 'We offer email and chat support for all plans. Professional and Enterprise plans include priority support.'
                    ]
                ] as $faq)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold mb-2">{{ $faq['question'] }}</h3>
                        <p class="text-gray-600">{{ $faq['answer'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .gradient-mask {
            background: linear-gradient(to right, #1E40AF, #3730A3);
        }
        .feature-card:hover {
            transform: translateY(-5px);
            transition: transform 0.2s ease-in-out;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === "#") return;

                    const target = document.querySelector(targetId);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Show/hide FAQ answers
            const faqItems = document.querySelectorAll('.faq-item');
            faqItems.forEach(item => {
                item.querySelector('.faq-question').addEventListener('click', () => {
                    item.querySelector('.faq-answer').classList.toggle('hidden');
                });
            });
        });
    </script>
@endpush
