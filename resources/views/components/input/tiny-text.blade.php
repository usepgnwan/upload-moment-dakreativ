

@props([
    'id' => 'editor',
    'content' => ''
    ])
<div class="w-full">
    <!-- <h2 class="text-2xl font-bold mb-4">Content</h2> -->
    <textarea id="{{ $id }}" class="w-full h-64 tiny-full-editor">{{ $content }}</textarea>
</div>
