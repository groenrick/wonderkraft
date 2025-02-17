
<template id="block-selector-template">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity backdrop" onclick="closeBlockSelector()"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0" onclick="event.stopPropagation()">
            <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                <div class="absolute right-0 top-0 pr-4 pt-4">
                    <button type="button" onclick="closeBlockSelector()" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

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
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h17.25c.621 0 1.125-.504 1.125-1.125V4.875c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125Z" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium">Hero Section</div>
                                <div class="text-sm text-gray-500">Add a hero section with title, subtitle and background image</div>
                            </div>
                        </div>
                    </button>

                    <button onclick="addBlock('features-grid')" class="w-full text-left px-4 py-3 border rounded-lg hover:bg-gray-50">
                        <div class="flex gap-3">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium">Features Grid</div>
                                <div class="text-sm text-gray-500">Display a grid of features or services</div>
                            </div>
                        </div>
                    </button>

                    <button onclick="addBlock('cta')" class="w-full text-left px-4 py-3 border rounded-lg hover:bg-gray-50">
                        <div class="flex gap-3">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium">Call to Action</div>
                                <div class="text-sm text-gray-500">Add a compelling call-to-action section</div>
                            </div>
                        </div>
                    </button>

                    <button onclick="addBlock('testimonials')" class="w-full text-left px-4 py-3 border rounded-lg hover:bg-gray-50">
                        <div class="flex gap-3">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium">Testimonials</div>
                                <div class="text-sm text-gray-500">Showcase customer testimonials in a grid or slider</div>
                            </div>
                        </div>
                    </button>

                    <button onclick="addBlock('stats')" class="w-full text-left px-4 py-3 border rounded-lg hover:bg-gray-50">
                        <div class="flex gap-3">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium">Statistics</div>
                                <div class="text-sm text-gray-500">Display important numbers and statistics</div>
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

        <input type="hidden" name="content[{index}][type]" value="">

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

        <input type="hidden" name="content[{index}][type]" value="">

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

<template id="features-grid-block-template">
    <div class="content-block bg-white rounded-lg shadow-sm p-6" data-block-index="{index}">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-800">Features Grid</h3>
            <button type="button" class="text-red-600 hover:text-red-700" onclick="removeBlock({index})">
                Remove Block
            </button>
        </div>

        <input type="hidden" name="content[{index}][type]" value="">

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Section Title</label>
                <input
                    type="text"
                    name="content[{index}][data][title]"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <div class="border-t pt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Features</label>
                <div class="repeater-items space-y-4">
                    <!-- Items will be added here -->
                </div>
                <button
                    type="button"
                    class="add-item-button mt-4 w-full py-2 border-2 border-dashed border-gray-300 rounded-lg text-gray-600 hover:border-gray-400 hover:text-gray-700"
                >
                    Add Feature
                </button>
            </div>
        </div>

        <!-- Template for repeater items -->
        <template class="repeater-template">
            <div class="repeater-item relative border rounded-lg p-4">
                <button type="button" onclick="removeRepeaterItem(this)" class="absolute top-2 right-2 text-red-600 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="grid gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Icon Name</label>
                        <input
                            type="text"
                            name="content[{blockIndex}][data][features][{itemIndex}][icon]"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Feature Title</label>
                        <input
                            type="text"
                            name="content[{blockIndex}][data][features][{itemIndex}][title]"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea
                            name="content[{blockIndex}][data][features][{itemIndex}][description]"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            rows="2"
                        ></textarea>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>
