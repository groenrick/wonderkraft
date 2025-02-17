@extends('app.layouts.app')

@section('main')
    <main class="ml-64 pt-16 min-h-screen">
        <div class="p-8">
            <form action="{{ route('app.pages.update', $page) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-800">Edit Page</h1>
                        <p class="mt-1 text-gray-600">Update your page content</p>
                    </div>
                    <div class="flex gap-3">
                        @if($page->status === 'published')
                            <button type="submit" name="status" value="published" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Save Changes
                            </button>
                            <button type="submit" name="status" value="draft" class="px-4 py-2 text-gray-700 bg-white border rounded-lg hover:bg-gray-50">
                                Save as Draft
                            </button>
                        @else
                            <button type="submit" name="status" value="draft" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Save Changes
                            </button>
                            <button type="submit" name="status" value="published" class="px-4 py-2 text-gray-700 bg-white border rounded-lg hover:bg-gray-50">
                                Save and Publish
                            </button>
                        @endif
                    </div>
                </div>

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
                    <!-- Main Editor Column -->
                    <div class="col-span-2 space-y-6">
                        <!-- Title Input -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Page Title</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title', $page->title) }}"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required
                            >
                        </div>

                        <!-- Content Blocks -->
                        <div id="content-blocks" class="space-y-4">
                            @foreach($page->content ?? [] as $index => $block)
                                <div class="content-block bg-white rounded-lg shadow-sm p-6" data-block-index="{{ $index }}">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-lg font-medium text-gray-800">{{ $block['type'] }}</h3>
                                        <button type="button" class="text-red-600 hover:text-red-700" onclick="removeBlock({{ $index }})">
                                            Remove Block
                                        </button>
                                    </div>

                                    <input type="hidden" name="content[{{ $index }}][type]" value="{{ $block['type'] }}">

                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                            <input
                                                type="text"
                                                name="content[{{ $index }}][data][title]"
                                                value="{{ $block['data']['title'] }}"
                                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            >
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Paragraph</label>
                                            <textarea
                                                name="content[{{ $index }}][data][paragraph]"
                                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 h-32"
                                            >{{ $block['data']['paragraph'] }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Add Block Button -->
                        <button
                            type="button"
                            onclick="showBlockSelector()"
                            class="w-full py-4 border-2 border-dashed border-gray-300 rounded-lg text-gray-600 hover:border-gray-400 hover:text-gray-700"
                        >
                            Add Content Block
                        </button>
                    </div>

                    <!-- Settings Sidebar -->
                    <div class="space-y-6">
                        <!-- Page Settings -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h3 class="text-lg font-medium text-gray-800 mb-4">Page Settings</h3>

                            <!-- URL Slug -->
                            <div class="mb-4">
                                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">URL Slug</label>
                                <input
                                    type="text"
                                    id="slug"
                                    name="slug"
                                    value="{{ old('slug', $page->slug) }}"
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                >
                            </div>

                            <!-- Other settings... -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- Block Templates -->
    <template id="block-selector-template">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeBlockSelector()"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Select Block Type</h3>
                        <button onclick="addBlock('title-paragraph')" class="w-full text-left px-4 py-3 border rounded-lg hover:bg-gray-50">
                            <div class="flex gap-3">
                                <div class="flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-700">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M12 17.25h8.25" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-medium">Title & Paragraph</div>
                                    <div class="text-sm text-gray-500">Add a title with a paragraph of text</div>
                                </div>
                            </div>
                        </button>
                        <button onclick="addBlock('hero')" class="w-full text-left px-4 py-3 border rounded-lg hover:bg-gray-50">
                            <div class="flex gap-3">
                                <div class="flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-700">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-medium">Hero Section</div>
                                    <div class="text-sm text-gray-500">Add a hero section with title, subtitle and background image</div>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <template id="title-paragraph-block-template">
        <div class="content-block bg-white rounded-lg shadow-sm p-6" data-block-index="{index}">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-800">Title & Paragraph</h3>
                <button type="button" class="text-red-600 hover:text-red-700" onclick="removeBlock({index})">
                    Remove Block
                </button>
            </div>

            <input type="hidden" name="content[{index}][type]" value="App\ContentBlocks\TitleParagraphBlock">

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                    <input
                        type="text"
                        name="content[{index}][data][title]"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Paragraph</label>
                    <textarea
                        name="content[{index}][data][paragraph]"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 h-32"
                    ></textarea>
                </div>
            </div>
        </div>
    </template>

    <template id="hero-block-template">
        <div class="content-block bg-white rounded-lg shadow-sm p-6" data-block-index="{index}">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-800">Hero Section</h3>
                <button type="button" class="text-red-600 hover:text-red-700" onclick="removeBlock({index})">
                    Remove Block
                </button>
            </div>

            <input type="hidden" name="content[{index}][type]" value="App\ContentBlocks\HeroBlock">

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Hero Title</label>
                    <input
                        type="text"
                        name="content[{index}][data][title]"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                    <input
                        type="text"
                        name="content[{index}][data][subtitle]"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Background Image</label>
                    <input
                        type="file"
                        name="content[{index}][data][background_image]"
                        class="w-full"
                        accept="image/*"
                    >
                </div>
            </div>
        </div>
    </template>

    @push('scripts')
        @push('scripts')
            @push('scripts')
                <script>
                    const blockTypes = @json($blocks);
                    let blockIndex = {{ count($page->content ?? []) }};
                    let blockSelectorDiv = null;

                    function showBlockSelector() {
                        const template = document.getElementById('block-selector-template');
                        blockSelectorDiv = document.createElement('div');
                        blockSelectorDiv.innerHTML = template.innerHTML;
                        document.body.appendChild(blockSelectorDiv);
                    }

                    function closeBlockSelector() {
                        if (blockSelectorDiv) {
                            blockSelectorDiv.remove();
                            blockSelectorDiv = null;
                        }
                    }

                    function addBlock(identifier) {
                        closeBlockSelector();
                        const blockType = blockTypes.find(type => type.identifier === identifier);

                        if (!blockType) return;

                        const templateId = `${identifier}-block-template`;
                        const template = document.getElementById(templateId);
                        const blocksContainer = document.getElementById('content-blocks');

                        const blockHtml = template.innerHTML.replace(/{index}/g, blockIndex);
                        const tempDiv = document.createElement('div');
                        tempDiv.innerHTML = blockHtml;

                        // Update the hidden type field with the full class name
                        const typeInput = tempDiv.querySelector(`input[name="content[${blockIndex}][type]"]`);
                        if (typeInput) {
                            typeInput.value = blockType.class;
                        }

                        blocksContainer.appendChild(tempDiv.firstElementChild);
                        blockIndex++;
                    }

                    function removeBlock(index) {
                        const block = document.querySelector(`[data-block-index="${index}"]`);
                        if (block) {
                            block.remove();
                        }
                    }
                </script>
            @endpush
        @endpush
    @endpush
@endsection
