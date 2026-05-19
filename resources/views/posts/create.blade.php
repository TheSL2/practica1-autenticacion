<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-4">Crear Nueva Publicación</h2>

            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block font-medium text-sm text-gray-700">Título</label>
                    <input type="text" name="title" class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">Contenido</label>
                    <textarea name="content" rows="5" class="w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">Categoría (ID de prueba)</label>
                    <input type="number" name="category_id" value="1" class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">Archivos (máx 5):</label>
                    <input type="file" name="attachments[]" class="w-full" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                    @error('attachments.*')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow">Subir y Publicar</button>
            </form>
        </div>
    </div>
</x-app-layout>