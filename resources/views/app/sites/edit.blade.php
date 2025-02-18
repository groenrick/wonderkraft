{{-- resources/views/app/sites/edit.blade.php --}}
@extends('app.layouts.app')

@section('main')
    <!-- Main Content -->
    <main class="ml-64 pt-16 min-h-screen">
        <div class="p-8">
            <form action="{{ route('app.sites.update', $site) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-800">Edit Site</h1>
                        <p class="mt-1 text-gray-600">Modify your website settings</p>
                    </div>
                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Save Changes
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
                                    value="{{ old('name', $site->name) }}"
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
                                >{{ old('description', $site->description) }}</textarea>
                            </div>
                        </div>

                        <!-- Domain Settings -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h3 class="text-lg font-medium text-gray-800 mb-4">Domain Settings</h3>

                            <!-- Primary Domain -->
                            <div class="mb-6">
                                <label for="primary_domain_id" class="block text-sm font-medium text-gray-700 mb-2">Primary Domain</label>
                                <select
                                    id="primary_domain_id"
                                    name="primary_domain_id"
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                >
                                    @foreach($site->domains as $domain)
                                        <option value="{{ $domain->id }}" {{ $site->primary_domain_id == $domain->id ? 'selected' : '' }}>
                                            {{ $domain->full_domain }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Domains List -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Domains</label>
                                <div class="space-y-3">
                                    @foreach($site->domains as $domain)
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                            <span class="text-sm text-gray-600">{{ $domain->full_domain }}</span>
                                            @if(!$domain->is_primary)
                                                <form action="{{ route('app.domains.destroy', $domain) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <a href="{{ route('app.domains.create', ['site' => $site->id]) }}" class="inline-flex items-center mt-3 text-sm text-blue-600 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Add Domain
                                </a>
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
                                    <option value="default" {{ $site->theme == 'default' ? 'selected' : '' }}>Default Theme</option>
                                    <option value="modern" {{ $site->theme == 'modern' ? 'selected' : '' }}>Modern</option>
                                    <option value="minimal" {{ $site->theme == 'minimal' ? 'selected' : '' }}>Minimal</option>
                                </select>
                            </div>

                            <!-- Time Zone -->
                            <div>
                                <label for="timezone" class="block text-sm font-medium text-gray-700 mb-2">Time Zone</label>
                                <select id="timezone" name="timezone" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="UTC" {{ $site->timezone == 'UTC' ? 'selected' : '' }}>UTC</option>
                                    <option value="America/New_York" {{ $site->timezone == 'America/New_York' ? 'selected' : '' }}>Eastern Time</option>
                                    <option value="America/Chicago" {{ $site->timezone == 'America/Chicago' ? 'selected' : '' }}>Central Time</option>
                                    <option value="America/Denver" {{ $site->timezone == 'America/Denver' ? 'selected' : '' }}>Mountain Time</option>
                                    <option value="America/Los_Angeles" {{ $site->timezone == 'America/Los_Angeles' ? 'selected' : '' }}>Pacific Time</option>
                                </select>
                            </div>
                        </div>

                        <!-- Danger Zone -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h3 class="text-lg font-medium text-red-600 mb-4">Danger Zone</h3>
                            <form action="{{ route('app.sites.destroy', $site) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this site? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200">
                                    Delete Site
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
