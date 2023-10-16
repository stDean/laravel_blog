<x-layout>
  <x-setting heading="Publish New Post">

    <form action="/admin/posts" method="POST" enctype="multipart/form-data">
      @csrf
  
      <x-form.input name="title" required />
  
      <x-form.input name="slug" required />
  
      <x-form.input name="thumbnail" type='file' />
  
      <x-form.textarea name="excerpt" msg='excerpt for the post' required />
  
      <x-form.textarea name="body" required />
  
      <x-form.field>
        <x-form.label name="category" required />
        
        <select name="category_id" id="category_id">
          @foreach (\App\Models\Category::all() as $category)
            <option 
              value="{{ $category->id }}" 
              {{ old('category_id') == $category->id ? 'selected' : '' }}
            >
              {{ ucwords($category->name) }}
            </option>
          @endforeach
        </select>
  
        <x-form.error name="category_id" />
      </x-form.field>
  
      <x-form.button>Publish</x-form.button>
    </form>

  </x-setting>  
</x-layout>