<x-forum.layouts.app>
  <div class="flex items-center gap-2 w-full my-8">
    <livewire:heart :heartable="$question" />
    <div class="w-full">
      <h2 class="text-2xl font-bold md:text-3xl">
        {{ $question->title }}
      </h2>
          
    @if (session('success'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 4000)"  
        x-show="show"
        x-transition.opacity.duration.300ms
        x-cloak
        role="alert" aria-live="polite"
        class="mt-3 mb-2 flex items-start gap-2 rounded-lg border border-green-300/70
            bg-green-50 dark:bg-green-900/20 text-green-800 dark:text-green-200 p-3"
    >
        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>

        <span class="text-sm">{{ session('success') }}</span>

        <button
        type="button"
        @click="show = false"
        class="ml-auto inline-flex items-center justify-center rounded-md px-2 py-1
                text-green-800 dark:text-green-200 hover:bg-green-100/60 dark:hover:bg-green-800/40"
        aria-label="Cerrar"
        >✕</button>
    </div>
    @endif
      <div class="flex justify-between">
        <p class="text-xs text-gray-500">
          <span class="font-semibold">{{ $question->user->name }}</span> |
          {{ $question->category->name }} |
          {{ $question->created_at->diffForHumans() }}
        </p>

        <div class="flex items-center gap-2">
          <a href="{{ route('questions.edit', $question) }}" class="text-xs font-semibold hover:underline">
            Edit
          </a>

          <form action="{{ route('questions.destroy', $question) }}" method="POST"
                onsubmit="return confirm('¿Estás seguro de eliminar esta pregunta?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="rounded-md bg-red-600 hover:bg-red-500 px-2 py-1 text-xs font-semibold text-white cursor-pointer">
              Eliminar
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="my-4">
    <p class="text-gray-200">
      {{ $question->content }}
    </p>

    <livewire:comment :commentable="$question" />
  </div>

  <ul class="space-y-4">
    @foreach($question->answers as $answer)
      <li>
        <div class="flex items-start gap-2">
          <livewire:heart :heartable="$answer" wire:key="answer-heart-{{ $answer->id }}" />

          <div>
            <p class="text-sm text-gray-300">
              {{ $answer->content }}
            </p>
            <p class="text-xs text-gray-500">
              {{ $answer->user->name }} |
              {{ $answer->created_at->diffForHumans() }}
            </p>

            {{-- clave única diferente para el componente de comentarios --}}
            <livewire:comment :commentable="$answer" wire:key="answer-comment-{{ $answer->id }}" />
          </div>
        </div>
      </li>
    @endforeach
  </ul>

  <div class="mt-8">
    <h3 class="text-lg font-semibold mb-2">Tu Respuesta...</h3>

    <form action="{{ route('answers.store', $question) }}" method="POST">
      @csrf

      <div class="mb-2">
        <textarea name="content" rows="6"
                  class="w-full p-2 border rounded-md text-xs text-black"
                  required>{{ old('content') }}</textarea>
        @error('content')
          <span class="block text-red-500 text-xs">{{ $message }}</span>
        @enderror
      </div>

      <button type="submit"
              class="rounded-md bg-blue-600 hover:bg-blue-500 px-4 py-2 text-white cursor-pointer">
        Enviar Respuesta
      </button>
    </form>
  </div>
</x-forum.layouts.app>
