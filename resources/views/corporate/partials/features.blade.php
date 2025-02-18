{{-- resources/views/corporate/partials/features.blade.php --}}
<section id="about" class="py-20">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold mb-4">Why Choose Us</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Discover how our solutions can help your business thrive in today's competitive landscape.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach($features as $feature)
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="w-12 h-12 text-blue-600 mb-4">
                        {!! $feature['icon'] !!}
                    </div>
                    <h3 class="text-xl font-semibold mb-2">{{ $feature['title'] }}</h3>
                    <p class="text-gray-600">{{ $feature['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
