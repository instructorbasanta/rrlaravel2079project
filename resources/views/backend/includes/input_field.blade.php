<div class="form-group">
    <label for="{{ $name }}">{{ $title }}</label>
    <input id="{{ $name }}" type="text" name="{{ $name }}"
        class="form-control" placeholder="Enter {{ $title }}" 
        value="{{ old($name) }}" />
    @error($name)
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>