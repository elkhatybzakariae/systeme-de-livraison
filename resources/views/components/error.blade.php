@props(['field'])
@error($field)
<div class="text-danger my-2">
  {{ $message }}
</div>
@enderror