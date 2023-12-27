@props(['name'])
 
<input type="text" name="{{ $name }}" {{ $attributes }}>
{{--  
<div>
    @error($name) <span class="error">{{ $message }}</span> @enderror
</div> --}}