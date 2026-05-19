<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded-lg shadow">
            <h1 class="text-3xl font-bold mb-2">{{ $post->title }}</h1>
            <p class="text-gray-600 mb-6">{{ $post->content }}</p>

            <div class="mt-6 pt-4 border-t">
                <h5 class="font-bold mb-2">Archivos Adjuntos:</h5>
                @foreach($post->attachments as $file)
                    <div class="flex items-center space-x-2 p-2 bg-gray-50 rounded border mb-2">
                        <span>📁</span>
                        <a href="{{ asset('storage/' . $file->path) }}" target="_blank" class="text-blue-600 hover:underline font-bold">
                            {{ $file->original_name }}
                        </a>
                        <span class="text-gray-500 text-sm">({{ number_format($file->size / 1024, 2) }} KB)</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>