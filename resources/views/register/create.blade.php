<x-layout>

  <main class="max-w-lg mx-auto mt-10 bg-gray-100 p-6 rounded-xl border border-gray-300">
    <h1 class="text-center font-bold text-xl">Register</h1>

    <form action="/register" method="POST" class="mt-5">
      @csrf

      <div class="mb-6">
        <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">
          Name
        </label>
        <input 
          type="text" 
          name="name" 
          id="name" 
          class="border border-gray-500 p-2 w-full"
          value="{{ old('name') }}"
        >

        @error('name')
          <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="username" class="block mb-2 uppercase font-bold text-xs text-gray-700">
          Username
        </label>
        <input 
          type="text" 
          name="username" 
          id="username" 
          class="border border-gray-500 p-2 w-full"
          value="{{ old('username') }}"
        >

        @error('username')
          <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">
          E-mail
        </label>
        <input 
          type="email" 
          name="email" 
          id="email" 
          class="border border-gray-500 p-2 w-full"
          value="{{ old('email') }}"
        >

        @error('email')
          <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="password" class="block mb-2 uppercase font-bold text-xs text-gray-700">
          Password
        </label>
        <input 
          type="password" 
          name="password" 
          id="password" 
          class="border border-gray-500 p-2 w-full"
        >

        @error('password')
          <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6">
        <button 
          type="submit"
          class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
        >Register</button>
      </div>

    </form>

    {{-- @if ($errors->any())
      <ul>
        @foreach ($errors->all() as $error)
          <li class="text-red-500 text-xs mt-2">{{ $error }}</li>
        @endforeach
      </ul>
    @endif --}}
  </main>

</x-layout>