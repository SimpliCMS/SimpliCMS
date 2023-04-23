<label class="form-control-label">{{ $label }}</label>
<div class="form-group">
    <select class="form-control @if ($errors->has($name)) is-invalid @endif" name="{{ $name }}">
        @foreach($options as $key => $label)
        <option value="{{ $label }}" @if($label == $value)selected="selected" @endif>{{ ucfirst($label) }}</option>
        @endforeach

    </select>
    <div class="invalid-feedback">{{ $errors->first($name) }}</div>
</div>