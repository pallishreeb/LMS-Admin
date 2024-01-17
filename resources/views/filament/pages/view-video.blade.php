

<x-filament::page>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($this->record->chapters as $chapter)
            <div class="bg-white p-4 rounded-md shadow-md">
                <h2 class="text-lg font-bold mb-2">{{ $chapter['title'] }}</h2>
                <p class="text-gray-600 mb-4">{{ $chapter['description'] }}</p>
                <video width="100%" height="auto" controls class="mb-2">
                    <source src="{{ asset('storage/' . $chapter['video_file']) }}" type="video/{{ $chapter['video_type'] }}">
                    Your browser does not support the video tag.
                </video>
            </div>
        @endforeach
    </div>
</x-filament::page>
