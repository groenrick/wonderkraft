// resources/views/app/pages/partials/block-scripts.blade.php
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

            // Get template ID based on identifier
            const templateId = `${identifier}-block-template`;
            const template = document.getElementById(templateId);

            if (!template) {
                console.error(`Template not found: ${templateId}`);
                return;
            }

            const blocksContainer = document.getElementById('content-blocks');
            if (!blocksContainer) {
                console.error('Blocks container not found');
                return;
            }

            // Get corresponding block type
            const blockType = blockTypes.find(type => type.identifier === identifier);
            if (!blockType) {
                console.error(`Block type not found: ${identifier}`);
                return;
            }

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

            console.log('Block added:', identifier, blockIndex - 1);
        }

        function removeBlock(index) {
            const block = document.querySelector(`[data-block-index="${index}"]`);
            if (block) {
                block.remove();
            }
        }
    </script>
@endpush
