<div class="relative py-32 px-6 sm:py-40 sm:px-12 lg:px-16">
    @if(!empty($data['background_image']))
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" src="{{ asset($data['background_image']) }}" alt="">
            <div class="absolute inset-0 bg-black/50"></div>
        </div>
    @endif

    <div class="relative max-w-3xl mx-auto text-center">
        <h2 class="text-4xl font-extrabold tracking-tight {{ !empty($data['background_image']) ? 'text-white' : 'text-gray-900' }} sm:text-5xl">
            {{ $data['title'] ?? '' }}
        </h2>
        @if(!empty($data['subtitle']))
            <p class="mt-6 text-xl {{ !empty($data['background_image']) ? 'text-gray-200' : 'text-gray-500' }}">
                {{ $data['subtitle'] }}
            </p>
        @endif
    </div>
</div>
