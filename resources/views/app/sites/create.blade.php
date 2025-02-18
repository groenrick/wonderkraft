{{-- resources/views/app/sites/create.blade.php --}}
@extends('app.layouts.app')

@section('main')
    <!-- Main Content -->
    <main class="ml-64 pt-16 min-h-screen">
        <div class="p-8">
            <form action="{{ route('app.sites.store') }}" method="POST">
                @csrf

                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-800">Create New Site</h1>
                        <p class="mt-1 text-gray-600">Add a new website to your account</p>
                    </div>
                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Create Site
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

                <div class="grid grid-cols-3 gap-6">
                    <!-- Main Settings Column -->
                    <div class="col-span-2 space-y-6">
                        <!-- Basic Information -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <!-- Site Name -->
                            <div class="mb-6">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Site Name</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                                    placeholder="My Awesome Site"
                                    required
                                >
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <textarea
                                    id="description"
                                    name="description"
                                    class="w-full h-32 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                                    placeholder="Brief description of your site..."
                                >{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <!-- Domain Settings -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h3 class="text-lg font-medium text-gray-800 mb-4">Domain Settings</h3>

                            <!-- Subdomain -->
                            <div class="mb-6">
                                <label for="subdomain" class="block text-sm font-medium text-gray-700 mb-2">Subdomain</label>
                                <div class="flex items-center">
                                    <input
                                        type="text"
                                        id="subdomain"
                                        name="subdomain"
                                        value="{{ old('subdomain') }}"
                                        class="w-full px-4 py-2 border rounded-l-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('subdomain') border-red-500 @enderror"
                                        placeholder="mysite"
                                        required
                                    >
                                    <span class="px-4 py-2 bg-gray-100 border border-l-0 rounded-r-lg text-gray-600">.sitebuilder.test</span>
                                </div>
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
                                    placeholder="www.mysite.com"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Settings Sidebar -->
                    <div class="space-y-6">
                        <!-- Site Settings -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h3 class="text-lg font-medium text-gray-800 mb-4">Site Settings</h3>

                            <!-- Site Theme -->
                            <div class="mb-4">
                                <label for="theme" class="block text-sm font-medium text-gray-700 mb-2">Theme</label>
                                <select id="theme" name="theme" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="default" {{ old('theme') == 'default' ? 'selected' : '' }}>Default Theme</option>
                                    <option value="modern" {{ old('theme') == 'modern' ? 'selected' : '' }}>Modern</option>
                                    <option value="minimal" {{ old('theme') == 'minimal' ? 'selected' : '' }}>Minimal</option>
                                </select>
                            </div>

                            <!-- Time Zone -->
                            <div>
                                <label for="timezone" class="block text-sm font-medium text-gray-700 mb-2">Time Zone</label>
                                <select id="timezone" name="timezone" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="UTC" {{ old('timezone') == 'UTC' ? 'selected' : '' }}>UTC</option>
                                    <option value="America/New_York" {{ old('timezone') == 'America/New_York' ? 'selected' : '' }}>Eastern Time</option>
                                    <option value="America/Chicago" {{ old('timezone') == 'America/Chicago' ? 'selected' : '' }}>Central Time</option>
                                    <option value="America/Denver" {{ old('timezone') == 'America/Denver' ? 'selected' : '' }}>Mountain Time</option>
                                    <option value="America/Los_Angeles" {{ old('timezone') == 'America/Los_Angeles' ? 'selected' : '' }}>Pacific Time</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
