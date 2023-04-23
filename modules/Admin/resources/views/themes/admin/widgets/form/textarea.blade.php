<label class="form-control-label">{{ $label }}</label>
<div class="form-group">
    <textarea class="form-control @if ($errors->has($name)) is-invalid @endif" name="{{ $name }}"
              placeholder="{{ $placeholder ?? '' }}">{{ $value ?? '' }}</textarea>
    <div class="invalid-feedback">{{ $errors->first($name) }}</div>
</div>

