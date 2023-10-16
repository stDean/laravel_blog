<x-layout>

  <main class="max-w-lg mx-auto mt-10 bg-gray-100">
    <x-panel>
      <h1 class="text-center font-bold text-xl">Register</h1>
  
      <form action="/register" method="POST" class="mt-5">
        @csrf
  
        <x-form.input name="name" required />
        <x-form.input name="username" required />
        <x-form.input name="email" typs="email" required />
        <x-form.input name="password" type="password" auto="new-password" required />
  
        <div class="mb-6">
          <button 
            type="submit"
            class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
          >
            Register
          </button>
        </div>
  
      </form>
    </x-panel>
  </main>

</x-layout>