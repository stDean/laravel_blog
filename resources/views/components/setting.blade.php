@props(['heading'])
<section class="max-w-4xl mx-auto">
<h1 class="text-lg font-bold text-left mb-8 pb-2 border-b mb-4">
  {{ $heading }}
</h1>

<div class="flex border border-gray-200 rounded-xl p-4">
  <aside class="w-48 flex-shrink-0">
    <h2 class="font-semibold mb-4">Links</h2>

    <ul>
      <li>
        <a 
          href="/admin/posts" 
          class="{{ request()->is('admin/posts') ? 'text-blue-500' : '' }}"
        >
         All Posts
        </a>
      </li>
      <li>
        <a 
          href="/admin/posts/create" 
          class="{{ request()->is('admin/posts/create') ? 'text-blue-500' : '' }}"
        >
          New Post
        </a>
      </li>
    </ul>
  </aside>
  
  <main class="flex-1">
    <x-panel class="mx-auto">  
      {{ $slot }}
    </x-panel>
  </main>
</div>
</section>