<x-forum.layouts.app>
  <div class="flex items-center justify-center w-full my-10 px-4">
    <div class="w-full max-w-3xl bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 shadow-xl rounded-xl p-8 text-white">
      <h2 class="text-3xl font-bold text-center mb-6">Nueva Pregunta</h2>

      {{-- Errores globales --}}
      @if ($errors->any())
        <div class="mb-4 rounded-lg border border-red-400 bg-red-50 text-red-800 p-4">
          <ul class="list-disc ml-5 text-sm">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('questions.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Título --}}
        <div>
          <label for="title" class="block text-lg font-semibold">Título</label>
          <input id="title" name="title" type="text" required value="{{ old('title') }}"
                 placeholder="Ej.: ¿Cómo funciona la herencia en PHP?"
                 class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500">
          @error('title') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
        </div>

        {{-- Contenido --}}
        <div>
          <label for="content" class="block text-lg font-semibold">Contenido</label>
          <textarea id="content" name="content" rows="6" required placeholder="Describe tu duda aquí…" 
                    class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500">{{ old('content') }}</textarea>
          @error('content') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
        </div>

        {{-- Categoría --}}
        <div>
          <label for="category_id" class="block text-lg font-semibold">Categoría</label>
          <select id="category_id" name="category_id" required
                  class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500">
            <option value="">— Selecciona una categoría —</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
            @endforeach
          </select>
          @error('category_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
        </div>

        {{-- Acciones --}}
        <div class="flex items-center gap-6">
          <button type="submit"
                  class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            Publicar
          </button>
          <a href="{{ url()->previous() }}" class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500">
            Cancelar
          </a>
        </div>
      </form>
    </div>
  </div>
</x-forum.layouts.app>
