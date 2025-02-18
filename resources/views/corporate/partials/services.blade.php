{{-- resources/views/corporate/partials/services.blade.php --}}
<section id="services" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold mb-4">Our Services</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Comprehensive solutions tailored to your business needs
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            @foreach($services as $service)
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-xl font-semibold mb-2">{{ $service['title'] }}</h3>
                    <p class="text-gray-600">{{ $service['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
