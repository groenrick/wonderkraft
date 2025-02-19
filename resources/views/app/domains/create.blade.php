{{-- resources/views/app/domains/create.blade.php --}}
@extends('app.layouts.app')

@section('main')
    <!-- Main Content -->
    <main class="ml-64 pt-16 min-h-screen">
        <div class="p-8">
            <form action="{{ route('app.domains.store') }}" method="POST">
                @csrf

                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-800">Add Domain</h1>
                        <p class="mt-1 text-gray-600">Add a new domain to {{ $site->name }}</p>
                    </div>
                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Add Domain
                        </button>
                    </div>
                </div>

                <!-- Show validation errors if any -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="max-w-2xl">
                    <!-- Domain Settings -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <!-- Subdomain -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Subdomain</label>
                            <div class="flex items-center">
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="w-full px-4 py-2 border rounded-l-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                                    placeholder="mysite"
                                    required
                                >
                                <span class="px-4 py-2 bg-gray-100 border border-l-0 rounded-r-lg text-gray-600">.wonderkraft.online</span>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">This will be your default subdomain</p>
                        </div>

                        <!-- Custom Domain -->
                        <div>
                            <label for="custom_domain" class="block text-sm font-medium text-gray-700 mb-2">Custom Domain (Optional)</label>
                            <input
                                type="text"
                                id="custom_domain"
                                name="custom_domain"
                                value="{{ old('custom_domain') }}"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('custom_domain') border-red-500 @enderror"
                                placeholder="www.example.com"
                            >
                            <p class="mt-2 text-sm text-gray-500">Add your own domain name</p>
                        </div>
                    </div>

                    <!-- DNS Instructions -->
                    <div class="mt-6 bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">DNS Setup Instructions</h3>

                        <div class="space-y-4">
                            <p class="text-sm text-gray-600">To use a custom domain, add these DNS records to your domain provider:</p>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">For root domain (example.com):</h4>
                                <div class="grid grid-cols-3 gap-4 text-sm">
                                    <div class="font-medium text-gray-600">Type</div>
                                    <div class="font-medium text-gray-600">Name</div>
                                    <div class="font-medium text-gray-600">Value</div>
                                    <div>A</div>
                                    <div>@</div>
                                    <div>YOUR_SERVER_IP</div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">For www subdomain:</h4>
                                <div class="grid grid-cols-3 gap-4 text-sm">
                                    <div class="font-medium text-gray-600">Type</div>
                                    <div class="font-medium text-gray-600">Name</div>
                                    <div class="font-medium text-gray-600">Value</div>
                                    <div>CNAME</div>
                                    <div>www</div>
                                    <div>YOUR_DOMAIN</div>
                                </div>
                            </div>

                            <p class="text-sm text-gray-500">DNS changes can take up to 48 hours to propagate globally.</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
