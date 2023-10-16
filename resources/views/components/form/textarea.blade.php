@props(['name', 'msg' => 'Quick, think of something to say'])

<x-form.field>
  <x-form.label name="{{ $name }}" />

  <textarea 
    name="{{ $name }}" 
    id="{{ $name }}" 
    class="w-full p-2 border border-gray-200" 
    placeholder="{{ $msg }}"
    required
  >{{ $slot ?? old( $name) }}</textarea>

  <x-form.error name="{{ $name }}" />
</x-form.field>