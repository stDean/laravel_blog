@auth
  <x-panel>
    <form action="/posts/{{ $post->slug }}/comment" method="POST">
      @csrf

      <header class="flex space-x-4 items-center">
        <img src="https://i.pravatar.cc/40?u={{ auth()->id() }}" alt="user avatar" width="40" height="40" class="rounded-full">
        <p>Want to paticipate?</p>
      </header>

      <div class="mt-6">
        <textarea 
          name="body" 
          id="body" 
          class="w-full text-sm focus:outline-none focus:ring p-2" 
          placeholder="Quick, think of something to say"
          cols="10"
          rows="5"
          required
        ></textarea>

      </div>
      
      @error('body')
        <span class="text-xs text-red-500">{{ $message }}</span>
      @enderror

      <div class="flex justify-end pt-4 mt-4 border-t border-gray-200">
        <x-submit-button>Post</x-submit-button>
      </div>
    </form>
  </x-panel>

  @else

  <p>
    <a href="/register" class="hover:underline font-bold">Register</a> or <a href="/login" class="hover:underline font-bold">Login</a> to leave a comment
  </p>
@endauth